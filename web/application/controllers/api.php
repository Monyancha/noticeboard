<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : api.php
 *  Date : 2/2/15 3:39 PM
 *  Description : USIU Board HTTP API
 *  
 */

class Api extends CI_Controller {


    var $EMPTY_RESPONSE = array();

    function __construct() {
        parent::__construct();

        $this->load->driver('cache', array('adapter' => 'file'));

        $this->load->helper( array('content', 'syndication', 'notification') );

        $this->load->model('DeviceModel');
        $this->load->model('FeedModel');
        $this->load->model('SettingsModel');
        $this->load->model('ItemModel');
        $this->load->model('LogModel');

        $this->load->helper('settings');
    }

    /**
     * Get registered feeds URLs
     */
    public function feeds() {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->FeedModel->getFeeds()));
    }

    /**
     * Send xml feed
     * @param $slug
     */
    public function feed($slug) {

        if(isset($slug)) {
            $feed = $this->FeedModel->getFeedBySlug($slug);

            if($feed) {
                $items = $this->ItemModel->getFeedItems($feed->id);

                $this->output
                    ->set_content_type('application/rss+xml')
                    ->set_output(makeRSSXML($feed, $items));
            }  else {

                $this->output
                    ->set_content_type('application/rss+xml')
                    ->set_status_header(404, 'Feed Not Found');
            }

        } else {

            $this->output
                ->set_content_type('application/rss+xml')
                ->set_status_header(400, 'Bad Request');
        }
    }

    /**
     * Sync all feeds and send notifications. Called every minute by a job scheduler like cron.
     */
    public function sync() {

        // TODO: Restrict origin

        $devices = $this->DeviceModel->getDevices();

        $notificationSettings = getNotificationsSettings();
        $smsSettings = getSMSSettings();
        $pushSettings = getPushSettings();

        $settings = array(
            "type" => $notificationSettings,
            "sms" => $smsSettings,
            "push" => $pushSettings
        );

        $registeredFeeds = $this->FeedModel->getFeeds();
        foreach($registeredFeeds as $registeredFeed) {
            // Fetch content
            $feed = readRSS($registeredFeed->url);

            if($feed) {
                if($message = getNewContent($registeredFeed->id, $feed)) { // Notify students
                    $payload = array(
                        "id" => $message->getId(),
                        "title" =>$message->getTitle(), //$registeredFeed->title,
                        "content" => trim(strip_tags($message->getContent()))
                    );
                    sendNotifications($devices, $settings, $payload);
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->EMPTY_RESPONSE));
    }

    /**
     * Register student device and phone number.
     */
    public function register() {
        $uuid = $this->input->post('uuid');
        $phone = $this->input->post('phone');

        if($uuid && $phone) {
            if ($this->DeviceModel->addDevice($uuid, $phone) >= 1) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($this->EMPTY_RESPONSE));
                exit(0);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_status_header(500, 'Failed to register device')
            ->set_output(json_encode($this->EMPTY_RESPONSE));
    }

    /**
     * To remove a student’s phone and device.
     */
    public function unregister() {
        $uuid = $this->input->post('uuid');

        if($this->DeviceModel->removeDevice($uuid)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->EMPTY_RESPONSE));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500, 'Failed to unregister device')
                ->set_output(json_encode($this->EMPTY_RESPONSE));
        }
    }

}
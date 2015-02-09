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

    var $DEFAULT_NOTIFICATION_TYPES_SETTINGS = array(
        "sms" => false,
        "push" => false
    );

    var $DEFAULT_PUSH_NOTIFICATIONS_SETTINGS = array(
        "GCM" => array( // Google Cloud Messaging
            "API_KEY" => null
        ),
        "APNS" => array( // Apple Push Notification Service
            "TOKEN" => null
        )
    );

    var $DEFAULT_SMS_SETTINGS = array(
        "twilio" => array( // Twilio
            "sid" => null,
            "token" => null,
            "sender" => null
        )
    );

    function __construct() {
        parent::__construct();

        $this->load->driver('cache', array('adapter' => 'file'));

        $this->load->model('DeviceModel');
        $this->load->model('FeedModel');
        $this->load->model('SettingsModel');
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
     * Sync all feeds and send notifications. Called every minute by a job scheduler like cron.
     */
    public function sync() {

        $this->load->helper( array('content', 'syndication', 'notification') );

        $devices = $this->DeviceModel->getDevices();

        $notificationSettings = $this->SettingsModel->getSettings('notification');
        $smsSettings = $this->SettingsModel->getSettings('sms');
        $pushSettings = $this->SettingsModel->getSettings('push');

        if(!$notificationSettings){ $notificationSettings = $this->$DEFAULT_NOTIFICATION_TYPES_SETTINGS; }
        if(!$smsSettings) { $smsSettings = $this->DEFAULT_SMS_SETTINGS; }
        if(!$pushSettings) { $pushSettings = $this->DEFAULT_PUSH_NOTIFICATIONS_SETTINGS; }

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
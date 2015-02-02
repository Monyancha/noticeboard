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
        $feeds = $this->FeedModel->getFeeds();
        foreach($feeds as $feed) {
            // Fetch content
            // Fetch previous latest content from cache
            // If new content, alert users
            // Set latest content to cache
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

        if($this->DeviceModel->addDevice($uuid, $phone) >= 1) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->EMPTY_RESPONSE));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500, 'Failed to register device')
                ->set_output(json_encode($this->EMPTY_RESPONSE));
        }
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
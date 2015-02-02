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



    function __construct() {
        parent::__construct();
    }

    /**
     * Get registered feeds URLs
     */
    public function feeds() {

    }

    /**
     * Sync all feeds and send notifications. Called every minute by a job scheduler like cron.
     */
    public function sync() {

    }

    /**
     * Register student device and phone number.
     */
    public function register() {

    }

    /**
     * To remove a student’s phone and device.
     */
    public function unregister() {

    }


}
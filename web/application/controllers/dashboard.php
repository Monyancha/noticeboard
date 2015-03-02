<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : dashboard.php
 *  Date : 2/2/15 3:40 PM
 *  Description :
 *  
 */

class Dashboard extends CI_Controller {

    var $User = null;

    function __construct(){
        parent::__construct();

        $this->load->library('session');

        $this->User = $this->session->userdata('user');
        if($this->User == null) {
            $this->session->set_userdata('login_callback', '/dashboard');
            redirect('/auth/login');
        }

        $this->load->model('DeviceModel');
        $this->load->model('FeedModel');
        $this->load->model('ItemModel');
        $this->load->model('SettingsModel');

        $this->load->helper( array('settings', 'content', 'notification') );
    }

    public function index() {
        $context = array(
            "user" => $this->User
        );
        $this->load->view("dashboard/index", $context);
    }

    public function partial($name) {
        $view = "dashboard/partials/".$name;
        $this->load->view($view, array("user" => $this->User));
    }


    /**
     * @param $action
     */
    public function feed($action) {
        $status = 500;
        $data = $this->input->post(); // TODO: Validate data
        if($data && count($data) > 0) {
            // add, update, remove
            switch ($action) {
                case 'add':
                    $id = $this->FeedModel->addFeed($data['title'], $data['description'], $data['slug']);
                    if ($id) $status = 200;
                    break;
                case 'update':
                    $res = $this->FeedModel->updateFeed($data['id'], $data['title'], $data['description'], $data['slug']);
                    if ($res) $status = 200;
                    break;
                case 'remove':
                    $res = $this->FeedModel->removeFeed($data['id']);
                    if ($res) $status = 200;
                    break;
            }
        } else {
            $status = 400;
        }
        $this->output->set_status_header($status);
    }

    /**
     * @param $param
     */
    public function notifications($param) {
        $status = 500;
        $data = $this->input->post(); // TODO: Validate data
        if($data && count($data) > 0) {

            // TODO: Save notifications params

            switch ($param) { // type | push | sms
                case "type":
                    $type = $data['notificationsSettings'];
                    $notifSettings = array(
                        "sms" => $type === 'both' || $type === 'sms',
                        "push" => $type === 'both' || $type === 'push');
                    if($this->SettingsModel->updateSettings('notification', $notifSettings)){
                        $status = 200;
                    }
                    break;
                case "push":
                    $data['APNS'] = array('token' => null); // FIXME: Delete me
                    // fall through
                case "sms":
                    if($this->SettingsModel->updateSettings($param, $data)){
                        $status = 200;
                    }
                    break;
            }
        }
        $this->output->set_status_header($status);
    }

    /**
     * @param $action
     */
    public function content($action) {
        $status = 500;
        $data = $this->input->post(); // TODO: Validate data
        if($data && count($data) > 0) {
            switch ($action) { // notify | remove | add | update
                case "notify": // Send notifications

                    $devices = $this->DeviceModel->getDevices();

                    $notificationSettings = getNotificationsSettings();
                    $smsSettings = getSMSSettings();
                    $pushSettings = getPushSettings();

                    $settings = array(
                        "type" => $notificationSettings,
                        "sms" => $smsSettings,
                        "push" => $pushSettings
                    );

                    $res = true;
                    foreach($data['ids'] as $id) {
                        $item = $this->ItemModel->getItem($id);
                        $payload = array(
                            "id" => $id,
                            "title" =>$item->title,
                            "content" => trim(strip_tags($item->description))
                        );
                        $res &= sendNotifications($devices, $settings, $payload);
                        if($res) {
                            $this->ItemModel->updateNotificationStatus($id, true);
                        }
                    }
                    if ($res) $status = 200;

                    break;
                case "remove":
                    $res = true;
                    foreach($data['ids'] as $id) {
                        $res &= $this->ItemModel->removeItem($id);
                    }
                    if ($res) $status = 200;
                    break;
                case "add":
                    // TODO: image upload !?
                    $id = $this->ItemModel->addItem(
                        $data['feed'], $data['title'], $data['description'], $data['content'],
                        $data['image'], $data['author'], $data['link']
                    );
                    if ($id) $status = 200;
                    break;
                case "update":
                    // TODO: image upload !?
                    $res = $this->ItemModel->updateItem(
                        $data['id'], $data['feed'], $data['title'], $data['description'],
                        $data['content'], $data['image'], $data['author'], $data['link']
                    );
                    if ($res) $status = 200;
                    break;
            }
        }
        $this->output->set_status_header($status);
    }


}
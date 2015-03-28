<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : notification_helper.php
 *  Date : 2/2/15 6:02 PM
 *  Description :
 *
 */

const SMS_MAX_CHARACTERS = 160;
const PUSH_MAX_CHARACTERS = 4096; // Up to 4KB UTF Characters  for GCM


function _limitCharacters($text, $max)
{

    if ($max < 5) {
        return $text;
    }

    if (strlen($text) > $max) {
        $text = substr($text, 0, (SMS_MAX_CHARACTERS - 5)) . '...';
    }

    return $text;
}


/**
 * Tell devices to reset and re-register for push notifications
 * @param $devices
 * @return bool
 */
function sendResetNotifications($devices) {

    return true;
}

/**
 * Send notifications to students
 *
 * @param $devices
 * @param $settings
 * @param $payload
 * @return bool
 */
function sendNotifications($devices, $settings, $payload)
{

    $phones = array();
    $pushDevices = array();
    foreach ($devices as $device) {
        if(!empty($device->phone) && $device->phone !== "null") {
            array_push($phones, $device->phone);
        }

        if(!empty($device->uuid) && $device->uuid !== "null") {
            array_push($pushDevices, array("uuid" => $device->uuid, "type" => $device->type));
        }
    }

    $result = true;

    if ($settings['type']->push == true) {
        $result &= pushNotification($pushDevices, $payload, $settings['push']);
    }

    if ($settings['type']->sms == true) {
        $result &= sendSMS($phones, $payload['title'] . ": " . $payload['content'], $settings['sms']);
    }

    return $result;
}


/**
 * Send SMS. Hardcoded to use twilio!
 * @param $receivers
 * @param $content
 * @param $settings array SMS Provider settings
 * @return bool
 */
function sendSMS($receivers, $content, $settings)
{
    $CI =& get_instance();

    // Load SMS Provider library
    $twilio = $settings->twilio;
    $CI->load->library('twilio', array("sid"=>$twilio->sid, "token"=>$twilio->token, "sender"=>$twilio->sender));


    // Prep sms body
    $content = _limitCharacters($content, SMS_MAX_CHARACTERS);

    // Send SMS
    $res = false;
    foreach($receivers as $receiver) {
        $res = $CI->twilio->sendSMS($receiver, $content);
    }

    return $res;
}

/**
 * Send app notification. Supports GCM and APNS.
 * @param $registrationIds
 * @param $payload
 * @param $settings
 * @return bool
 */
function pushNotification($registrationIds, $payload, $settings)
{
    $CI =& get_instance();

    // id, title, content
    $payload['content'] = _limitCharacters($payload['content'], PUSH_MAX_CHARACTERS / 3);

    $gcmIds = array();
    $apnsTokens = array();
    foreach($registrationIds as $device) {
        switch($device['type']) {
            case "gcm":
                array_push($gcmIds, $device['uuid']);
                break;
            case "apns":
                array_push($apnsTokens, $device['uuid']);
                break;
        }
    }

    $res = true;

    if(count($gcmIds) > 0) { // Send GCMs
        $gcm = new Endroid\Gcm\Gcm($settings->GCM->API_KEY);
        $res &= $gcm->send($payload, $gcmIds);
    }

    if(count($apnsTokens) > 0) { // Send APNS
        $res &= false;
    }

    return $res;
}
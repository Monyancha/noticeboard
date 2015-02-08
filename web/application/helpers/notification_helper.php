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
    $uuids = array();
    foreach ($devices as $device) {
        array_push($phones, $device->phone);
        array_push($uuids, $device->uuid);
    }

    $result = false;

    if ($settings['type']['push'] == true) {
        $result &= pushNotification($uuids, $payload, $settings['push']);
    }

    if ($settings['type']['sms'] == true) {
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
    $CI->load->library('Twilio', $settings['twilio']);


    // Prep sms body
    $content = _limitCharacters($content, SMS_MAX_CHARACTERS);

    // Send SMS
    $res = false;
    foreach($receivers as $receiver) {
        $res &= $CI->Twilio->sendSMS($receiver, $content);
    }

    return $res;
}

/**
 * Send app notification. Hardcoded to use GCM!
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

    // Push Notification Message (Assume GCM for now)
    $gcm = new Endroid\Gcm\Gcm($settings['GCM']['API_KEY']);
    $res = $gcm->send($payload, $registrationIds);

    if(defined('ENVIRONMENT') && (ENVIRONMENT == "development" || ENVIRONMENT == "testing")) { // Debug only;
        clearContentCache();
    }

    return $res;
}
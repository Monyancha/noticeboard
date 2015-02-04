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
 * @param $title
 * @param $message
 * @return bool
 */
function sendNotifications($devices, $settings, $title, $message)
{

    $phones = array();
    $uuids = array();
    foreach ($devices as $device) {
        array_push($phones, $device->phone);
        array_push($uuids, $device->uuid);
    }

    $result = false;

    if ($settings['type']['push'] == true) {
        $result &= pushNotification($uuids, $title, $message, $settings['push']);
    }

    if ($settings['type']['sms'] == true) {
        $result &= sendSMS($phones, $title . ": " . $message, $settings['sms']);
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
    $content = _limitCharacters(strip_tags($content), SMS_MAX_CHARACTERS);

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
 * @param $title
 * @param $content
 * @param $settings
 * @return bool
 */
function pushNotification($registrationIds, $title, $content, $settings)
{
    $CI =& get_instance();

    $message = array(
        "title" => $title,
        "content" => _limitCharacters(strip_tags($content), PUSH_MAX_CHARACTERS)
    );

    // Push Notification Message (Assume GCM for now)
    $gcm = new Endroid\Gcm\Gcm($settings['GCM']['API_KEY']);
    return $gcm->send($message, $registrationIds);
}
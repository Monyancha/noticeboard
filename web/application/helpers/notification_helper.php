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



function _limitCharacters($text, $max) {

    if($max < 5) {
        return $text;
    }

    if (strlen($text) > $max) {
        $text = substr($text, 0, (SMS_MAX_CHARACTERS - 5)).'...';
    }

    return $text;
}

/**
 * Send SMS
 * @param $to
 * @param $content
 */
function sendSMS($to, $content) {
    $content = _limitCharacters(strip_tags($content), SMS_MAX_CHARACTERS);

    // Send SMS
    //echo $to.": ".$content."\n";
}

/**
 * Send app notification
 * @param $registrationIds
 * @param $title
 * @param $content
 * @return bool
 */
function pushNotification($registrationIds, $title, $content) {
    $CI=&get_instance();

    $PushSettings = array( // //$CI->SettingsModel->getSettings('push_notification');
        "GCM" => array( // Google Cloud Messaging
            "API_KEY" => null
        ),
        "APNS" => array( // Apple Push Notification Service
            "TOKEN" => null
        )
    );

    $message = array(
        "title" => $title,
        "content" => _limitCharacters(strip_tags($content), PUSH_MAX_CHARACTERS)
    );

    // Push Notification Message (Assume GCM for now)
    $gcm = new Endroid\Gcm\Gcm($PushSettings['GCM']['API_KEY']);
    return $gcm->send($message, $registrationIds);

}
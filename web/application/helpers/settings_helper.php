<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : settings_helper.php
 *  Date : 2/26/15 11:55 AM
 *  Description :
 *  
 */

/**
 *
 * @return mixed
 */
function getNotificationsSettings() {
    $CI =& get_instance();
    $notificationSettings = $CI->SettingsModel->getSettings('notification');
    if(!$notificationSettings){
        $notificationSettings = array( "sms" => false, "push" => false);
        // Save default.
        $CI->SettingsModel->setSettings('notification', $notificationSettings);
        $notificationSettings = arrayToStdObject($notificationSettings);
    }
    return $notificationSettings;
}

/**
 * @return mixed
 */
function getSMSSettings() {
    $CI =& get_instance();
    $smsSettings = $CI->SettingsModel->getSettings('sms');
    if(!$smsSettings) {
        $smsSettings = array(
            "twilio" => array( // Twilio
                "sid" => null,
                "token" => null,
                "sender" => null
            )
        );
        // Save default.
        $CI->SettingsModel->setSettings('sms', $smsSettings);
        $smsSettings = arrayToStdObject($smsSettings);
    }
    return $smsSettings;
}

/**
 * @return mixed
 */
function getPushSettings() {
    $CI =& get_instance();
    $pushSettings = $CI->SettingsModel->getSettings('push');
    if(!$pushSettings) {
        $pushSettings = array(
            "GCM" => array( // Google Cloud Messaging
                "API_KEY" => null
            ),
            "APNS" => array( // Apple Push Notification Service
                "token" => null
            )
        );
        // Save default.
        $CI->SettingsModel->setSettings('push', $pushSettings);
        $pushSettings = arrayToStdObject($pushSettings);
    }
    return $pushSettings;
}
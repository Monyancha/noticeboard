<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : util_helper.php
 *  Date : 2/26/15 12:11 PM
 *  Description :
 *  
 */

/**
 * Convert an array to an Std::Object
 * @param $array
 * @return mixed
 */
function arrayToStdObject($array) {
    return json_decode(json_encode($array), FALSE);
}

/**
 * @param $value
 * @return bool
 */
function isNullOrEmpty($value) {
    return !isset($value) || empty($value);
}

/**
 * @param $text
 * @param int $limit
 * @param string $append
 * @return string
 */
function limitCharacters($text, $limit = 144, $append = '...') {
    if (strlen($text) > $limit) {
        $text = substr($text, 0, strrpos(substr($text, 0, $limit), ' ')) . $append;
    }
    return $text;
}
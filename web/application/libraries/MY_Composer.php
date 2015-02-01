<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : MY_Composer.php
 *  Date : 2/1/15 3:36 PM
 *  Description : Composer loader.
 *  See http://codesamplez.com/development/composer-with-codeigniter
 *  
 */

class MY_Composer {

    function __construct() {
        include("./vendor/autoload.php");
    }

}
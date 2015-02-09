<?php

/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : MY_Twilio.php
 *  Date : 2/4/15 9:53 AM
 *  Description :
 *
 */
class Twilio
{

    var $AccountSID = null;
    var $AuthToken = null;
    var $Sender = null;

    var $Client = null;

    /**
     *
     * @param $params array Contains twilio account 'sid' and 'token'
     */
    function __construct($params)
    {
        $this->AccountSID = $params['sid'];
        $this->AuthToken = $params['token'];
        $this->Sender = $params['sender'];

        $this->Client = new Services_Twilio($this->AccountSID, $this->AuthToken);
    }


    /**
     * Send a text message
     * @param $from string A Twilio phone number enabled for the type of message you wish to send. Only phone numbers or short codes purchased from Twilio work here; you cannot (for example) spoof messages from your own cell phone number.
     * @param $to string The destination phone number. Format with a '+' and country code e.g., +16175551212 (E.164 format). For 'To' numbers without a '+', Twilio will use the same country code as the 'From' number. Twilio will also attempt to handle locally formatted numbers for that country code (e.g. (415) 555-1212 for US, 07400123456 for GB). If you are sending to a different country than the 'From' number, you must include a '+' and the country code to ensure proper delivery.
     * @param $text string The text of the message you want to send, limited to 1600 characters.
     * @return bool
     */
    public function sendSMS($to, $text, $from = null)
    {
        try {
            $msg = array(
                "From" => ($from == null) ? $this->Sender: $from,
                "To" => $to,
                "Body" => $text
            );

            $result = $this->Client->account->messages->create($msg);

            $sent = $result->sid;

            return isset($sent);

        } catch (Services_Twilio_RestException $e) {
            // Log error?
            echo $e->getMessage();
        }

        return false;
    }


}
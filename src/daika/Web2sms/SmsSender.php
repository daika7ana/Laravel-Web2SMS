<?php

namespace Daika\Web2sms;

use App, Response;

class SmsSender
{
    public $recipient, $message, $sender, $scheduleDate, $validity, $callbackUrl;
    
    public function __construct()
    {
        $this->curlurl = 'https://www.web2sms.ro/prepaid/message';
        
        $this->username = config("web2sms.username");
        $this->apiKey   = config("web2sms.apiKey");
        $this->secret   = config("web2sms.secretKey");
        
        $this->recipient = config("web2sms.recipient");
        $this->message   = config("web2sms.message");
        
        $this->scheduleDate   = null;
        $this->visibleMessage = null;
        $this->sender         = config("web2sms.sender");
        $this->validityDate   = config("web2sms.validity");
        $this->callbackUrl    = config("web2sms.callbackUrl");
    }
    
    public function recipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }
    
    public function message($message)
    {
        $this->message = $message;
        return $this;
    }
    
    public function visible_Message($visible_message)
    {
        $this->visibleMessage = $visible_message;
        return $this;
    }
    
    public function sender($sender)
    {
        $this->sender = $sender;
        return $this;
    }
    
    public function scheduleDate($scheduleDate)
    {
        $this->scheduleDate = $scheduleDate;
        return $this;
    }
    
    public function validityDate($validityDate)
    {
        $this->validityDate = $validityDate;
        return $this;
    }
    
    public function callbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }
    
    public function send()
    {
        $nonce  = time();
        $method = "POST";
        $url    = "/prepaid/message";
        
        $string = $this->apiKey . $nonce . $method . $url . $this->sender . $this->recipient . $this->message . $this->visibleMessage . $this->scheduleDate . $this->validityDate . $this->callbackUrl . $this->secret;
        
        $signature = hash('sha512', $string);
        
        $data = array(
            "apiKey" => $this->apiKey,
            "sender" => $this->sender,
            "recipient" => $this->recipient,
            "message" => $this->message,
            "scheduleDatetime" => $this->scheduleDate,
            "validityDatetime" => $this->validityDate,
            "callbackUrl" => $this->callbackUrl,
            "userData" => "",
            "visibleMessage" => $this->visibleMessage,
            "nonce" => $nonce
        );
        
        $ch = curl_init($this->curlurl);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->apiKey . ":" . $signature);
        $header   = array();
        $header[] = 'Content-type: application/json';
        $header[] = 'Content-length: ' . strlen(json_encode($data));
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        
        $postResult = curl_exec($ch);
        
        if ($postResult === false) {
            echo "<br/>";
            echo ('Curl error: ' . curl_error($ch) . "<br/>");
            echo ('Curl error nr: ' . curl_errno($ch) . "<br/>");
        }
        
        curl_close($ch);
        
        $response = array_filter(explode("\n", $postResult));
        $response = end($response);
        
        return $response;
    }
}
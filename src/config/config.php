<?php

return [
    'username'  	=> 	'your-username',
    'apiKey'    	=> 	'your-apikey',
    'secretKey' 	=> 	'your-secretkey',

    'recipient' 	=> 	null,
    'message'   	=> 	null,
    
    // default-sender-for-the-sms max:11 chars, format string setting is OPTIONAL
    'sender'        =>  null, 
    // send a sms at a specific date and time if null will send NOW, format YYYY-MM-DD HH:MM:SS, setting is OPTIONAL
    'scheduleDate'  =>  null, 
    // if the sms fails set this is the number of minutes left to retry to send it before is considered failed , format number, setting is OPTIONAL
    'validity'      =>  null, 
    // send the sms reponse to this url and do stuff with it, setting is OPTIONAL
    'callbackUrl'   =>  null 
];

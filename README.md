# Laravel-Web2SMS

---------------

Laravel 5.4 integration package for Web2SMS.ro 

```
composer require daika7ana/laravel-web2sms
```

In config/app.php :

```
Under Package Service providers:
	Daika\Web2sms\Web2smsServiceProvider::class
Under Aliases:
    'Web2sms' => Daika\Web2sms\SmsSender::class
```

```
php artisan vendor:publish --provider="Daika\Web2sms\Web2smsServiceProvider" --tag=config
```

Edit credentials and default values in config/web2sms.php.

```
Usage example:
		>>> $w2sms = new Web2sms;
        >>> $w2sms->recipient('407XXXXXXXX');
        >>> $w2sms->message('Another test');
        >>> $w2sms->send();
```
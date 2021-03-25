<?php

namespace Daika\Web2sms\Facades;

use Illuminate\Support\Facades\Facade;

class Web2smsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Daika\Web2sms\SmsSender';
    }
}

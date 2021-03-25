<?php

namespace Daika\Web2sms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class Web2smsServiceProvider extends ServiceProvider
{
  /**
   * Register the service provider.
   *
   * @return void
   */
  public function boot()
  {
    $this->publishes([
      __DIR__ . '/config/config.php' => config_path('web2sms.php'),
    ], 'config');
    AliasLoader::getInstance()->alias('Web2sms', 'Daika\Web2sms\SmsSender');
  }

  public function register()
  {
    $this->app->singleton(SmsSender::class);
  }
}

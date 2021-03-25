<?php

namespace Daika\Web2sms;

use Illuminate\Support\ServiceProvider;

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
  }

  public function register()
  {
    $this->app->make(SmsSender::class);
  }
}

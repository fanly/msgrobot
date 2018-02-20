<?php

namespace Fanly\Msgrobot;

use Fanly\Msgrobot\Dingtalk\Messager;
use Fanly\Msgrobot\Support\Client;
use Illuminate\Support\ServiceProvider;

class FanlyMsgrobotServiceProvider extends ServiceProvider
{
    protected function publishConfig()
    {
//        $this->publishes([
//            __DIR__.'/../../config/slack.php' => config_path('slack.php'),
//        ]);
    }

    protected function registerFacade()
    {
        $this->app->bind('msgrobot', function ($app) {
            return new Messager(new Client());
        });
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishConfig();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerFacade();
    }
}

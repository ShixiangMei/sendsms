<?php

namespace Yzxsms\Sendsms;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Yzxsms\Sendsms\Ucpass;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $source = realpath(__DIR__ . '/config.php');

        if ($this->app instanceof LaravelApplication) {
            $this->publishes([
                $source => config_path('yzxsms.php'),
            ]);
        }
    }

    public function register()
    {
        // 可以通过App::make('ucpass')调用
        $this->app->singleton('ucpass', function () {
            return Ucpass(config('yzxsms'));
        });

        // 方便依赖注入
        $this->app->bind('Yzxsms\Sendsms\Ucpass', function ($app) {
            return new Ucpass(config('yzxsms'));
        });
    }
}

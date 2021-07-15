<?php
/**
 * 2021-07-15 6:49 下午
 */

namespace Walkerdistance\Weather;

use Walkerdistance\Weather\Weather;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;
    
    /**
     * 配置文件发布
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('weather.php'),
        ]);
    }

    public function register()
    {
        //单例绑定服务
        $this->app->singleton(Weather::class, function ($app) {
            return new Weather(config('weather.key'),config('weather.url'));
        });
        $this->app->alias(Weather::class,'weather');
    }

    public function provides()
    {
        return [Weather::class,'weather'];
    }
}
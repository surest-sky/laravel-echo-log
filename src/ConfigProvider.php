<?php
/**
 * Created by PhpStorm.
 * User: surestdeng
 * Date: 2020/3/15
 * Time: 21:34:20
 */
namespace Surest\SimpleLog;

use Illuminate\Support\ServiceProvider;

class ConfigProvider  extends ServiceProvider
{
    public function boot()
    {
        $path = realpath(__DIR__.'/zlog.php');
        $this->publishes([$path => config_path('zlog.php')], 'zlog');
        $this->mergeConfigFrom($path, 'zlog');
    }
}

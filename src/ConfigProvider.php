<?php
/**
 * Created by PhpStorm.
 * User: surestdeng
 * Date: 2020/3/15
 * Time: 21:34:20
 */
namespace Surest\SimpleLog;

use Illuminate\Support\ServiceProvider;

class ConfigProvider extends ServiceProvider
{
    public function boot()
    {
        $path = realpath(__DIR__.'/clog.php');
        $this->publishes([$path => config_path('clog.php')], 'clog');
        $this->mergeConfigFrom($path, 'clog');
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: surestdeng
 * Date: 2020/3/15
 * Time: 21:34:20
 */
namespace Surest\SimpleLog;

use Tymon\JWTAuth\Providers\AbstractServiceProvider;

class ConfigProvider  extends AbstractServiceProvider
{
    public function boot()
    {
        $path = realpath(__DIR__.'/zlog.php');
        $this->publishes([$path => config_path('zlog.php')], 'zlog');
        $this->mergeConfigFrom($path, 'zlog');
    }
}

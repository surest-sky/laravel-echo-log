<?php
/**
 * Created by PhpStorm.
 * User: surestdeng
 * Date: 2020/3/15
 * Time: 15:14:29
 */

namespace Surest\SimpleLog\Middlewares;

use Surest\SimpleLog\Logging;

class SimpleMiddleware
{

    public function handle($request, \Closure $next)
    {
        // 记录接口日志
        config('zlog.request_on') === "enable" &&
        (new Logging())->getRequestLogger()->zreport($request);
        return $next($request);
    }
}

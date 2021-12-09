## laravel-echo-log

这是一个 Laravel 的简单日志输出包，可支简单支持配置日志信息等等

## 安装

    composer require 'surest/laravel-echo-log' -vvv --ignore-platform-reqs

## 配置

    cp vendor/surest/laravel-echo-log/src/clog.php ./config/clog.php

注释可见 `config/clog.php`

**env 配置**

    CLOG_ENABLE = true
    CLOG_PATH = storage_path('logs')
    CLOG_PREFIX = ''
    CLOG_REQUEST_ON = true

## 请求日志记录

1、进入`app/Http/Kernel.php`, 新增全局路由

    Surest\SimpleLog\Middlewares\SimpleMiddleware::class

    example：

        use Surest\SimpleLog\Middlewares\SimpleMiddleware;
        return [
            protected $middleware = [
                SimpleMiddleware::class
            ]
        ];

## 使用例

1、默认记录所有请求日志

    # 关闭请求日志输出
    CLOG_REQUEST_ON=disable

2、日志输出

    $msg = 'dcf';
    $path = __DIR__;
    $logger = Logging::getCLogger('path-info');
    $logger->info('path', compact('path', 'msg'));

输出结果:

    > request_2020-03-15.log
    {"message":"request-all","context":{"log_at":"2020-03-15T22:11:09.576Z","target_url":"http://blog/test","method":"GET","params":{"a":"1","argv":["bin/hyperf.php","start"]},"agent":"PostmanRuntime/7.23.0","module_name":"blog","server_ip":"127.0.0.1","server_port":null,"client_ip":"127.0.0.1","extra":[]},"level":200,"level_name":"INFO","channel":"request","datetime":{"date":"2020-03-15 22:11:09.576636","timezone_type":3,"timezone":"Asia/Shanghai"},"extra":[]}

    > biz-path-info_2020-03-15.log
    {"message":"path","context":{"path":"/var/www/html/xiaoe/hyperf-skeleton/app/Controller","msg":"dcf"},"level":200,"level_name":"INFO","channel":"path-info","datetime":{"date":"2020-03-15 22:11:09.665802","timezone_type":3,"timezone":"Asia/Shanghai"},"extra":[]}

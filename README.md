## laravel-echo-log

这是一个Laravel的简单日志输出包，可支简单支持配置日志信息等等

超级简单到日志输出

## 安装

    composer require 'surest/laravel-echo-log' -vvv   

## 目前支持

> 默认使用 JsonFormatter 输出

1、自定义日志配置

2、文件流输出(目前只支持)

3、请求日志输出


## 新增配置项目

备注：暂定

项目新增env配置

    # 项目信息配置
    SERVICE_NAME=blog
    # ZLOG 日志配置
    ZLOG_ENABLE=true                 # 是否开启 zlog：true、false
    ZLOG_MAX_FILES=3                 # 日志文件按天轮转，指定保留多少天的业务日志
    ZLOG_REQUEST_ON=enable           # 是否打开请求日志输出：enable（启用）、disable（禁用）
    ZLOG_PATH=false                  # 日志输出位置 false 代表 输出到laravel默认目录
    
发布配置文件

    php artisan vendor:publish --tag zlog

发布失败情况下

    cp vendor/surest/laravel-echo-log/src/zlog.php ./config/zlog.php
    
## 新增全局中间件

1、进入`app/Http/Kernel.php`, 新增全局路由

    Surest\SimpleLog\Middlewares\SimpleMiddleware::class
    
---

    例子：
    
        use Surest\SimpleLog\Middlewares\SimpleMiddleware;
        
        return [
            protected $middleware = [
                SimpleMiddleware::class
            ]
        ];

## 使用例

1、默认记录所有请求日志
    
    # 关闭请求日志输出
    ZLOG_REQUEST_ON=disable
    
2、日志输出

    $msg = 'dcf';
    $path = __DIR__;
    $logger = Logging::getZLogger('path-info');
    $logger->info('path', compact('path', 'msg'));
    
输出结果:
    
    > request_2020-03-15.log
    {"message":"request-all","context":{"log_at":"2020-03-15T22:11:09.576Z","target_url":"http://blog/test","method":"GET","params":{"a":"1","argv":["bin/hyperf.php","start"]},"agent":"PostmanRuntime/7.23.0","module_name":"blog","server_ip":"127.0.0.1","server_port":null,"client_ip":"127.0.0.1","extra":[]},"level":200,"level_name":"INFO","channel":"request","datetime":{"date":"2020-03-15 22:11:09.576636","timezone_type":3,"timezone":"Asia/Shanghai"},"extra":[]}
    
    > biz-path-info_2020-03-15.log
    {"message":"path","context":{"path":"/var/www/html/xiaoe/hyperf-skeleton/app/Controller","msg":"dcf"},"level":200,"level_name":"INFO","channel":"path-info","datetime":{"date":"2020-03-15 22:11:09.665802","timezone_type":3,"timezone":"Asia/Shanghai"},"extra":[]}
    
## 日志查看截图

![图片描述...](https://cdn.surest.cn/FnNs0xEu7mBBsFU4CPk7MaO9i0MX)


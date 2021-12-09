<?php
/**
 * Surest
 */
return [
    'enable' => env('CLOG_ENABLE', true), // 是否开启日志
    'path' => env('CLOG_PATH', storage_path('logs')), // 日志输出目录
    'prefix' => env('CLOG_PREFIX', ''), // 日志文件前缀
    'request_on' => env('CLOG_REQUEST_ON', true), // 是否开启请求日志
];

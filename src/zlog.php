<?php
/**
 * Created by PhpStorm.
 * User: surestdeng
 * Date: 2020/3/15
 * Time: 21:58:42
 */
return  [
    'enable'     => env('ZLOG_ENABLE', true),
    'moduleName' => env('SERVICE_NAME', 'tutor'),
    'path'       => (env('ZLOG_PATH') == false) ? storage_path('logs') : env('ZLOG_PATH'),
    'request'    => [
        'maxFiles'   => env('ZLOG_REQUEST_MAX_FILES', 3),
        'samplingPr' => env('ZLOG_REQUEST_SAMPLING_PR', 1),
    ],
    'request_on' => env('ZLOG_REQUEST_ON', 'enable')
];

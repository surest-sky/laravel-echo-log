<?php
/**
 * Created by PhpStorm.
 * User: surestdeng
 * Date: 2020/3/15
 * Time: 15:28:46
 */
namespace Surest\SimpleLog;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Logger as MLogger;
use Monolog\Processor\PsrLogMessageProcessor;
use Surest\SimpleLog\Logger\RequestLogger;


class Logging
{
    static $instance = null;

    public function getRequestLogger()
    {
        $logger = new RequestLogger(getClogConfig());
        return $logger;
    }

    /**
     * 获取写指定路径的 MLogger 对象
     *
     * @param string $filename
     * @param string $dirname
     * @param int    $maxFiles
     * @param string $filenameFormat
     * @param int    $level
     * @param string $dataFormat
     *
     * @return MLogger
     * @throws InvalidArgumentException
     */
    public static function getMLogger($filename, $dirname, $maxFiles = 3, $filenameFormat = '{filename}-{date}', $level = Mlogger::INFO, $dataFormat = 'Y-m-d')
    {
        if ((!is_string($filename)) || (strlen($filename) <= 0)) {
            throw new InvalidArgumentException('\$filename cannot be empty');
        }

        // 非绝对路径则是以默认路径为相对路径
        if (empty($dirname) || (0 == strcmp($dirname, "."))) {
            $dirname = clogPath();
        } else {
            if (!Str::startsWith($dirname, "/")) {
                $dirname = clogPath() . "/$dirname";
            }
        }
        $realpath = "{$dirname}/{$filename}.log";
        $handler = new RotatingFileHandler($realpath, $maxFiles, $level);
        $handler->setFilenameFormat($filenameFormat, $dataFormat);
        $handler->setFormatter(new JsonFormatter());
        $handler->pushProcessor(new PsrLogMessageProcessor());

        $logger = new Mlogger($filename);
        $logger->pushHandler($handler);

        return $logger;
    }

    /**
     * @param string $name
     *
     * @throws InvalidArgumentException
     */
    public static function getCLogger($name = 'default') :Logger
    {
        $clog = config('clog');
        $name = is_cli() ? "cli-{$name}" : $name;
        $prefix = Arr::get($clog, 'prefix', 'z-');
        $logger = self::getMlogger($name,
            null,
            Arr::get($clog, 'maxFiles'),
            "$prefix{filename}-{date}",
            Arr::get($clog, 'maxFiles')
        );
        return $logger;
    }
}





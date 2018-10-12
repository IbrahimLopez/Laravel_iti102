<?php

namespace Core;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{

    public static function warning(string $name, string $messager){
        self::put($name,$messager,
            Logger::WARNING,'warning');
    }
    public static function error(string $name, string $messager){
        self::put($name,$messager,
            Logger::ERROR,'error');
    }
    public static function info(string $name, string $messager){
        self::put($name,$messager,
            Logger::INFO,'info');
    }
    public static function critical(string $name, string $messager){
        self::put($name,$messager,
            Logger::CRITICAL,'critical');
    }
    public static function debug(string $name, string $messager){
        self::put($name,$messager,
            Logger::DEBUG,'debug');
    }

    private static function put(string $name, string $message, int $type, string $typeName){
        $file = sprintf('%s'.date('Ymd').'.log', $typeName);

        $log = new Logger($name);
        $log->pushHandler(
            new StreamHandler(_LOG_PATH_.'/'.$file,$type)
        );

        switch ($type){
            case 100:
                $log->debug($message);
                break;
            case 200:
                $log->info($message);
                break;
            case 300:
                $log->warning($message);
                break;
            case 400:
                $log->error($message);
                break;
            case 500:
                $log->critical($message);
                break;
            case 550:
                $log->alert($message);
                break;
            case 600:
                $log->emergency($message);
                break;
        }
    }
}
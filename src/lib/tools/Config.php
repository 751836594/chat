<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/3/5
 * Time: 上午11:01
 */

namespace tools;
use Phalcon\Config\Adapter\Php as ConfigPhp;


class Config
{

    public static function getConfig($key='')
    {
        $path = BASE_PATH.'/config/config.php';
        $config = new ConfigPhp($path);
        if(empty($key)){
            return $config;
        }
        if(key_exists($key,$config)){
            return $config[$key];
        }else{
            return new \StdClass();
        }

    }

}
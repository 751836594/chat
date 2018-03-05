<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/3/5
 * Time: 上午10:53
 */

namespace tools;


class RedisTools
{

    /**
     * @param $config
     * @return \Redis
     */
    public static function create($config){

        ini_set('default_socket_timeout', -1);
        $redis = new \Redis();
        $redis->connect($config->host, $config->port,$config->timeout);
        return $redis;
    }


    public static function get($config){
        $name = $config->host.':'.$config->port;
        static $cache=array();
        if(!isset($cache[$name])){
            $cache[$name]=self::create($config);
        }
        return $cache[$name];

    }
}
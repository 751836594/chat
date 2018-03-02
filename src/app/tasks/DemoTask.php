<?php

namespace app\tasks;

use \Phalcon\CLI\Task;

/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/3/1
 * Time: 下午4:35
 */
class DemoTask extends Task
{
    public function testAction()
    {
        $http = new \swoole_http_server("0.0.0.0", 9501);

        $http->on("start", function ($server) {
            echo "Swoole http server is started at http://127.0.0.1:9501\n";
        });

        $http->on("request", function ($request, $response) {
            $response->header("Content-Type", "text/plain");
            $response->end("Hello World\n");
        });

        $http->start();
    }


    public function demoAction()
    {
        $code =['270540063','270540064','270540065','270540065'];
        $a = array_count_values($code);
        print_r($a);
    }

}
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
        echo 1 . "\n";
        exit();
    }

}
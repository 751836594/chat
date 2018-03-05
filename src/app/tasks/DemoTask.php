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
        $redisConfig = \tools\Config::getConfig('redis');
        $redis = \tools\RedisTools::create($redisConfig);

        $server = new \swoole_websocket_server("0.0.0.0", 9501);

        $server->on('open', function ($server, $req) use ($redis) {
            $this->_open($server, $req, $redis);

        });

        $server->on('message', function ($server, $frame) use ($redis) {
            $this->_message($server, $frame, $redis);

        });

        $server->on('close', function ($server, $fd) use ($redis) {
            $this->_close($server, $fd, $redis);

        });

        $server->start();
    }


    private function _open($server, $req, $redis)
    {
        $msg = "游客: {$req->fd}连接\n";
        echo $msg;
        $redis->sAdd('live_list', $req->fd);
        $liveList = $redis->sMembers('live_list');
        foreach ($liveList as $item) {
            if ($item != $req->fd) {
                $server->push($item, $msg);
            }
        }
    }

    private function _message($server, $frame, $redis)
    {
        echo "received message: {$frame->data}\n";
        $liveList = $redis->sMembers('live_list');
        foreach ($liveList as $item) {
            if ($item != $frame->fd) {
                $server->push($item, $frame->data);
            }
        }
    }

    private function _close($server, $fd, $redis)
    {
        $exist = $redis->sIsMember('live_list', $fd);
        if ($exist) {
            $redis->sRem('live_list', $fd);
        }
        $msg = "游客: {$fd}退出直播间\n";
        echo $msg;
        $liveList = $redis->sMembers('live_list');
        foreach ($liveList as $item) {
            $server->push($item, $msg);
        }

    }
}
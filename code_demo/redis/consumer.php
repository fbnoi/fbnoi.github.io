<?php

class Consumer
{
    protected $redis;

    public function __construct($dsn, $port = 6379, $auth = null, $option = [])
    {
        $this->redis = new \Redis();
        if($auth) {
            $authable = $this->redis->auth($auth);
            if (!$authable) {
                throw new Exception("redis[{$dsn}:{$port}] auth failed!", 1);
            }
        }
        $this->redis->connect($dsn, $port);
    }


    public function subscribe(string $channel, callable $callback)
    {
        print_r('已订阅频道：' . $channel . ' 等待接收信息...' . PHP_EOL);
        $this->redis->subscribe([$channel], $callback);
    }
}


function receive($redis, $channel, $msg)
{
    print_r('收到来自：' . $channel . ' 的消息：'. $msg . PHP_EOL);
}

$consumer = new Consumer('127.0.0.1');
$consumer->subscribe('chatroom', 'receive');
<?php

class Publisher
{
    protected $redis;

    public function __construct($dsn, $port = 6379)
    {
        $this->redis = new \Redis();
        $this->redis->connect($dsn, $port);
    }

    public function pulish(string $channel, string $message) 
    {
        $ret = $this->redis->publish($channel, $message);
        print_r('向频道：' .  $channel . ' 发送消息： ' . $message . ' 接收者: ' . $ret . PHP_EOL);
        return $ret;
    }
}

$publisher = new Publisher('127.0.0.1');
$publisher->pulish('chatroom', 'hello everyone!');
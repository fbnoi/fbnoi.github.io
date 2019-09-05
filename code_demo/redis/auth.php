<?php

$redis = new \Redis();
$redis->connet('127.0.0.1');
$redis->auth('123456');
var_dump($redis->ping());

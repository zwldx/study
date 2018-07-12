<?php
// phpinfo();
// exit;
//注：php官方的memcache扩展，目前(2018年7月12日12:24:21)只支持到php5.6版本，php7虽然也可以使用，但兼容性不好
//所以只先切换PHP版本到5.6
session_start();

// $_SESSION['user'] = 'haha';
$sid = session_id();

$mem = new Memcache;
$mem->connect("127.0.0.1",11211);


$str = $mem->get('p277fl70qr7bt3v91e1d73sq51');
// $str2 = $mem->get('user');//这样是取不到的，因为你是把session存入memcache，而不是把session数据存入memcache
echo "$sid<hr>".$str."<hr>";
<?php
//应用Id
$appid = $_GET['appid'];
//获取用户激活最后时间
$usr_time = $_GET['time'];
//用户签名
$sign = $_GET['sign'];

//用户密钥，需要根据appid从数据库查询
$secret = 'zwldx';
//获取当前时间戳
$time = time();
// echo "<br>";
// echo $usr_time;
// var_dump(is_string($time));
// echo "<br>";
//生成服务器校验签名
$sev_sign = md5($appid.$secret.$usr_time);

if($sign == $sev_sign){
    if($time< (int)$usr_time){
        echo "跳转至重置页面";
        return;
    }else{
        echo "重置链接已失效，请重新申请重置";
        return;
    }
}else{
    echo "签名错误";
    return;
}



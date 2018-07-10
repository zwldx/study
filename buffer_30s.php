<?php
//如果id参数为空，就停止执行
$id = isset($_GET['id'])?$_GET['id']:die;

//检查相应静态文件(html文件)否已存在，如果已存在跳转，否则创建
//静态(缓存)有效期30秒
if(file_exists("buffer/{$id}.html")&&filemtime("buffer/{$id}.html")+30>time()){
    header("location:buffer/{$id}.html");
}else{
    $str = file_get_contents('buffer/tpl.html');
    $str = str_replace('{$title}',"{$id}'s title",$str);
    $str = str_replace('{$content}',"{$id}'s content",$str);
    file_put_contents("buffer/{$id}.html",$str);
    echo $str;
}
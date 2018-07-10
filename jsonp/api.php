<?php

// header("Content-type:application/x-javascript");//如果返回js代码，好像需要此设置
session_start();
$uid = isset($_GET['uid'])?$_GET['uid']:die;

$_SESSION['uid'] = $uid;
// echo "登录成功，3秒后跳转到个人中心页面";
?>
document.write('B站登录成功，3秒后跳转到个人中心页面');
document.write('<meta http-equiv="refresh" content="3; url=http://s.cn/jsonp/user.php" />');
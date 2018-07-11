<?php
// header("Content-type:application/x-javascript");//如果返回js代码，好像需要此设置
session_start();
$sid = isset($_GET['sid'])?$_GET['sid']:die;
$sname = isset($_GET['sname'])?$_GET['sname']:die;

setcookie($sname,$sid);
// echo "登录成功，3秒后跳转到个人中心页面";
?>
var meta = document.createElement('meta');
var span = document.createElement('span');
//var span = document.getElementById('span');
span.innerHTML = "B站登录成功，3秒后跳转到个人中心页面";
meta.httpEquiv = "refresh";
meta.content = "3; url=http://s.cn/sso_onclick/user.php";

document.head.appendChild(meta);
document.body.appendChild(span);

//前面的之所以那样写，因为下面的代码,即document.write异步加载时不能写在页面里
//document.write('B站登录成功，3秒后跳转到个人中心页面');
//document.write('<meta http-equiv="refresh" content="3; url=http://s.cn/sso_onclick/user.php" />');
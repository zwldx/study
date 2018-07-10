<?php
//个人中心
session_start();
if(isset($_SESSION['uid'])){
    echo "B站欢迎{$_SESSION['uid']}";
}else{
    echo 'B站尚未登录';
}
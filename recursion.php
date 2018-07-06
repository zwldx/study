<?php

$link = mysqli_connect('localhost','root','root','novel');
$sql = 'set names utf8';
mysqli_query($link,$sql);

$sql = "select * from address";
$res = mysqli_query($link,$sql);

$arr = mysqli_fetch_all($res,MYSQLI_ASSOC);

// print_r($arr);

//输出树结构数组，感觉这个适合数据较少的情况
// function getTree($arr,$pid){
//     $tree = [];
//     foreach($arr as $v){
//         if($v['pid']==$pid){
//             $v['pid'] = getTree($arr,$v['code']);
//             $tree[] =$v;
//         }
//     }
//     return $tree;
// }
// print_r(getTree($arr,0));
// print_r(getTree($arr,110100));
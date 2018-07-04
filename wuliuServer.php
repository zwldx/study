<?php

$arr = $_GET;
// print_r($arr);
$user_appid = $arr['showapi_appid'];
$user_sign =$arr['showapi_sign'];
$user_com = $arr['com'];
$user_nu = $arr['nu'];

//模拟数据库中的用户密钥和appid
$appid = '68704';
$secret = '05f00d15568446eabdc52c39161902c2';

    //生成签名所需要的参数
    $user_paramArr = array(
        'showapi_appid'=> $user_appid,
            'com'=> $user_com,
            'nu'=> $user_nu
        );
    //模拟数据库查询，即appid在数据库中不存在的时候
    if($appid!=$user_appid){
         echo "appid有误！";
         return;
    }
    
    //服务器运算的签名
    $sign = createParam($user_paramArr,$secret);

    if($sign != $user_sign){
        echo '签名有误';
        return;
    }


//用于创建物流查询接口的参数
//创建参数(包括签名的处理)
function createParam($paramArr, $showapi_secret)
{
    // $paraStr = "";
    $signStr = "";
    ksort($paramArr);
    foreach ($paramArr as $key => $val) {
        if ($key != '' && $val != '') {
            $signStr .= $key.$val;
            // $paraStr .= $key.'='.urlencode($val).'&';
        }
    }
    $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
    $sign = strtolower(md5($signStr));
    // $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
    // echo "排好序的参数:".$signStr."\r\n";
    // print_r($paraStr);
    return $sign;
}

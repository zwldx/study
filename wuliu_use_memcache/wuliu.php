<?php
//获取物流单号
$logNum = isset($_GET['logNum'])?$_GET['logNum']:die;

//模拟物流单号,测试用
// $logNum = 'DD2020290874';
//创建memcache对象
$mem = new Memcache;
//连接本地memcache
$mem->connect('127.0.0.1',11211);

// $info = '';

//如果memcache中不存在物流信息，则请求接口数据,然后存入memcache
if(!$info = $mem->get($logNum)){
    // echo "请求接口获得的数据<hr>";
    $info = getLogMsg($logNum);
    //存入memcache,flag参数使用0,值没有经过压缩,15表示15秒
    $mem->set($logNum,$info,0,15);
}


print_r($info);



//获取物流信息
function getLogMsg($logNum){
    // //玉石的
    // $showapi_appid = '68718';
    // //获取物流单号
    // $nu = $logNum;
    // //物流公司
    // $com = 'yuantong';
    // //生成密钥用的参数
    // $showapi_secret = "61430ae2b9bf44d3a6aa377906158ec5";

    //老师的
    $showapi_appid = '68704';
    //获取物流单号
    $nu = $logNum;
    //物流公司
    $com = 'yuantong';
    //生成密钥用的参数
    $showapi_secret = "05f00d15568446eabdc52c39161902c2";

    $paramArr = array(
    'showapi_appid'=> $showapi_appid,
        'com'=> $com,
        'nu'=> $nu
    );
    $param = createParam($paramArr,$showapi_secret); 
    $url = 'http://route.showapi.com/64-19?'.$param;
    $data = file_get_contents($url);

    return $data;
}

//用于创建物流查询接口的参数
//创建参数(包括签名的处理)
function createParam($paramArr, $showapi_secret)
{
    $paraStr = "";
    $signStr = "";
    ksort($paramArr);
    foreach ($paramArr as $key => $val) {
        if ($key != '' && $val != '') {
            $signStr .= $key.$val;
            $paraStr .= $key.'='.urlencode($val).'&';
        }
    }
    $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
    $sign = strtolower(md5($signStr));
    $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
    // echo "排好序的参数:".$signStr."\r\n";
    // print_r($paraStr);
    return $paraStr;
}
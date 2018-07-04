<?php
function getLogMsg(){
    header("Content-Type:text/html;charset=UTF-8");
    date_default_timezone_set("PRC");
    //物流接口相关数据
    //应用id
    // $showapi_appid = '68704';
    // //获取物流单号
    // // $nu = request()->param('logNum');
    // $nu = 'DD1976669624';
    // //物流公司
    // $com = 'yuantong';
    // //生成密钥用的参数
    // $showapi_secret = "05f00d15568446eabdc52c39161902c2";

    $showapi_appid = '68720';
    //获取物流单号
    // $nu = request()->param('logNum');
    $nu = '634165909513';
    //物流公司
    $com = 'zhongtong';
    //生成密钥用的参数
    $showapi_secret = "7b61c16de8df405ab3eb6e6f4af8b52f";

    //时间戳参数,用于设置链接有效时间
    // $time = time()+30;
    $paramArr = array(
        'showapi_appid'=> $showapi_appid,
            'com'=> $com,
            'nu'=> $nu
        );
   
    //接口地址及参数
    $param = createParam($paramArr,$showapi_secret); 
    $url = 'http://192.168.31.119/mima.php?'.$param;
    // $data = curlRequest($url);
    $data = file_get_contents($url);
    echo $data;
    
    // $data = file_get_contents($url);

    // return json_decode($data);
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
function curlRequest($url,$data = ''){
    $ch = curl_init();
    $params[CURLOPT_URL] = $url;    //请求url地址
    $params[CURLOPT_HEADER] = false; //是否返回响应头信息
    $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
    $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
    $params[CURLOPT_TIMEOUT] = 30; //超时时间
    if(!empty($data)){
        $params[CURLOPT_POST] = true;
        $params[CURLOPT_POSTFIELDS] = $data;
    }
    $params[CURLOPT_SSL_VERIFYPEER] = false;//请求https时设置,还有其他解决方案
    $params[CURLOPT_SSL_VERIFYHOST] = false;//请求https时,其他方案查看其他博文
    curl_setopt_array($ch, $params); //传入curl参数
    $content = curl_exec($ch); //执行
    curl_close($ch); //关闭连接
    return $content;
}
getLogMsg();
<?php
/**
  使用curl方式实现get或post请求
  @param $url 请求的url地址
  @param $data 发送的post数据 如果为空则为get方式请求
  return 请求后获取到的数据
*/
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

//对于某些服务器可能会遇到不兼容的情况，需要将数据拼装成字符串进行发送，可以使用如下函数：
function getPost($url,$vars){

    $ch = curl_init();
    $params[CURLOPT_URL] = $url;    //请求url地址
    $params[CURLOPT_HEADER] = false; //是否返回响应头信息
    $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
    $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
    $params[CURLOPT_USERAGENT] = 'Mozilla/5.0 (Windows NT 5.1; rv:9.0.1) Gecko/20100101 Firefox/9.0.1';

    $postfields = '';
    foreach ($vars as $key => $value){
        $postfields .= urlencode($key) . '=' . urlencode($value) . '&';  
    } 
    $params[CURLOPT_POST] = true;
    $params[CURLOPT_POSTFIELDS] = $postfields;

    //解决方案一 禁用证书验证
    $params[CURLOPT_SSL_VERIFYPEER] = false;
    $params[CURLOPT_SSL_VERIFYHOST] = false;

    curl_setopt_array($ch, $params); //传入curl参数
    return  curl_exec($ch); //执行
}
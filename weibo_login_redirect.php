<?php
include 'public/utils.php';
$code = isset($_GET['code'])?$_GET['code']:'error';
// echo $code;

$client_id = '340575609';
$client_secret = 'd204364d8d20ecef613c4f8c44bd1158';
$grant_type = 'authorization_code';
$redirect_uri = 'http://s.cn/weibo_login_redirect.php';

$data = [
    'client_id' =>$client_id,
    'client_secret' =>$client_secret,
    'grant_type' =>$grant_type,
    'code' =>$code,
    'redirect_uri' =>$redirect_uri
];

$url = "https://api.weibo.com/oauth2/access_token";
// $url = "https://api.weibo.com/oauth2/access_token?client_id={$client_id}&client_secret={$client_secret}&grant_type={$grant_type}&code={$code}&redirect_uri={$redirect_uri}";
// echo "<pre>";
// print_r(json_decode(getPost($url,$data),true));
// print_r(curlRequest($url));
$res = json_decode(getPost($url,$data),true);
$access_token = $res['access_token'];

$url = "https://api.weibo.com/2/statuses/mentions.json?access_token={$access_token}";

print_r(curlRequest($url));

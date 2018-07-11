<?php
include 'public/utils.php';
$client_id = '340575609';
$redirect_uri ="http://s.cn/weibo_login_redirect.php";
$data =[
    'client_id'=>$client_id,
    'redirect_uri'=>$redirect_uri
];
$url = "https://api.weibo.com/oauth2/authorize?client_id={$client_id}&redirect_uri={$redirect_uri}";
// curlRequest($url);
// $url = "https://api.weibo.com/oauth2/authorize";
// print_r(getPost($url,$data));

?>
<a href="<?php echo $url ?>">登录微博</a>

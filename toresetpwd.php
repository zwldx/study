<?php
    $appid = '707';
    $secret = 'zwldx';
    $time = time()+20;
    $sign = md5($appid.$secret.$time);
    $params = "appid={$appid}&sign={$sign}&time={$time}";
?>
<a href="resetpwd.php?<?php echo $params?>">点击重置密码</a>
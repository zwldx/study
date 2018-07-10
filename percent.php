<?php

//打开ob缓冲区，打开输出控制缓冲,ob的不打开也行
// ob_start();
$str = <<<EOT
<script>
function show(i){
    var span = document.getElementById('span');
    span.innerHTML = i+'0%';
}
</script>
<span id='span'></span>
EOT;
echo $str;
for($i =0;$i<10;$i++){
    
    //输出要大于64K，因为nginx有个配置是缓冲区大小为64K，配置是  fastcgi_buffer_size			64k;
    echo '<script>show('.($i+1).')</script>'.str_repeat(' ',64*4096);
    //ob_flush()：把数据从PHP的缓冲（buffer）中释放出来。 
    //flush()：把不在缓冲（buffer）中的或者说是被释放出来的数据发送到浏览器。
    flush();
    // ob_flush();
    sleep(1);
    
}
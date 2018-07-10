<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>倒计时</title>
    <style>
        span {
            color:red;
        }
    </style>
</head>
<body>
    <h1>距2019年春节还有</h1>
    <span id='day'></span>
    <span id='hour'></span>
    <span id='min'></span>
    <span id='sec'></span>
</body>
<!-- 脚本要写在HTML元素的后面，否则会提示元素为null -->
<script>
        var holiday = Date.parse(new Date('2019-02-05 00:00:00'));
        function getDateTime(holiday){
            //Date.parse()返回的时间戳毫秒位为000
            var now = Date.parse(new Date());
            var timediff = (holiday - now)/1000; 
            if(timediff<=0){
                clearInterval(timer);
            }
            // 除以60*60*24是多少天
            var day = Math.floor(timediff/(60*60*24));
            // 除以60*60是多少小时，再对24取余获得，剩余的(不足一天，即24小时)小时数
            var hour = Math.floor(timediff/60/60%24);
            // 除以60是总共多少分钟，再对60取余获得剩余的(不足一小时，即60分钟)分钟数
            var min = Math.floor(timediff/60%60);
            // 总秒数，对60取余，获得不足1分钟的秒数
            var sec = Math.floor(timediff%60);

            //如果此脚本写在HTML中下列标签元素(即相关的span标签元素)的上面，将会报错，提示为null
            document.getElementById('day').innerHTML = day+'天';
            document.getElementById('hour').innerHTML = hour+'小时';
            document.getElementById('min').innerHTML = min+'分钟';
            document.getElementById('sec').innerHTML = sec+'秒';
        }
        // getDateTime(holiday);
        timer = setInterval("getDateTime(holiday)",1000);
    </script>
    
</html>
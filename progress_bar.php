<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>进度条</title>
    <script>
    function show_bar(i){
        var pb = document.getElementById('pb');
        pb.style.width = i+'%';
    }
    </script>
</head>
<style>
div{
    height : 100px;
    width:80%;
    border:1px black solid ;
}
div div#pb{
    background:black;
    width:0%;
    border:0px;
}
</style>
<body>
    <div>
        <div id='pb'></div>
    </div>
</body>
</html>
<?php
    for($i = 1;$i<=100;$i++){
        
        echo "<script>show_bar({$i});</script>".str_repeat(' ',64*1024);
        flush();
        sleep(1);
    }
?>
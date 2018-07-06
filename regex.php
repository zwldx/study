<?php
$str = isset($_GET['str'])?$_GET['str']:'';
if(!empty($str)){
    if(preg_match("/a/",$str)){
        echo 1;
    }
    echo 0;
}
?>

<?php
header("Content-Type:text/html;charset=gbk");
include 'public/utils.php';
// $url = 'http://bj.news.163.com/';
$url = 'http://bendi.news.163.com/beijing/special/04388GGG/bjxinxiliu.js?callback=data_callback&_=1530860994846';

$str = file_get_contents($url);

// echo($str);
// print_r($str);
// $reg = '/<div class="news_title">.+<\/div>/sU';
// preg_match($reg,$str,$arr);

// print_r($arr[0]);
?>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>


<?php 
    // $url = "http://bj.news.163.com/";
    // $str = file_get_contents($url);
    
    // $reg ='/<ul class="hotNews-list2">(.+)<\/ul>/sU';
    // preg_match($reg,$str,$arr);
    // // print_r($arr[0]);
    // $reg ='/href="(.+)" target="_blank">(.+)<\/a>/sU';
    // preg_match_all($reg,$arr[0],$arr2);
    // // print_r($arr2);
    // foreach($arr2[1] as $v){
    //     $data = file_get_contents($v);
    //     print_r($data);
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<span id='s'></span>
</body>
<script>
    function data_callback(arr){
        for(k in arr){
            document.write('<a href="'+arr[k].docurl+'">'+arr[k].title+'</a><br>');
            document.write('<img src="'+arr[k].imgurl+'"/>');
        }
    }

    //注意：下面两个GET方法无法取到值，因为这是跨域请求,得用jsonp，不能用ajax
    // $.get('http://bendi.news.163.com/beijing/special/04388GGG/bjxinxiliu.js',{callback:'data_callback',_:'1530860994846'},function(data){alert(data);});
    // $.get('http://bendi.news.163.com/beijing/special/04388GGG/bjxinxiliu.js?callback=data_callback&_=1530860994846',{},function(data){
    //     alert(data);
    // },'text');
    <?php //echo $str;?>
</script>
 <!-- 这个是跨域请求 -->
 <!-- <script type="text/javascript" src="http://bendi.news.163.com/beijing/special/04388GGG/bjxinxiliu.js?callback=data_callback&_=1530860994846"></script> -->



<script type="text/javascript"> 

//下面这个是可以的，经实验不管jsonp的值写成什么都可以成功执行，关键是下面的jsonpCallback写的正确就行了
// $(function () {
//     $.ajax(
//         {
//             type: 'get',
//             url: 'http://bendi.news.163.com/beijing/special/04388GGG/bjxinxiliu.js?callback=?&_=1530860994846',
//             dataType: 'jsonp',
//             jsonp: "callback",
//             jsonpCallback: "data_callback",
//             success: function (data) {
//                 alert(data);
//             },
//             error: function (msg) {
//                 alert(msg);
//             }
//         }
//     );
// });


//下面也是可以的，好像只要jsonpCallback写的正确，即本页面有相应的回调函数，就可以成功执行
// $(function () {
//     $.ajax(
//         {
//             type: 'get',
//             url: 'http://bendi.news.163.com/beijing/special/04388GGG/bjxinxiliu.js',
//             dataType: 'jsonp',
//             jsonpCallback: "data_callback",
//             success: function (data) {
//                 alert(data);
//                 //   alert("用户名："+ data.user +" 密码："+ data.pass); 
//             },
//             error: function (msg) {
//                 alert('error');
//                 // alert(msg);
//             }
//         }
//     );
// });





//下面这个网上说可以，我试了,能返回jsonp数据，但是提示"Failed to execute 'write' on 'Document': It isn't possible to write into a document from an asynchronously-loaded external script unless it is explicitly opened."
//不知道为什么不可以。注意这里要写成问号，写函数名不行，不知道为什么，要写成这种形式 callback=?
// $.getJSON("http://bendi.news.163.com/beijing/special/04388GGG/bjxinxiliu.js?callback=?", function(data) {
//     alert(data);

// });
</script>
</html>
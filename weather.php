<form action="weather.php" method="get">
请输入城市:<input type="text" name='city'>
<input type="submit" name="查询天气">
</form>

<?php
// $city = $_GET['city'];
if(!empty( $_GET['city'])){
    $city =$_GET['city'];
    $url = "https://www.sojson.com/open/api/weather/json.shtml?city=".urlencode($city);
    // echo $url;
    
    $res = file_get_contents($url);
    // print_r($res);
    // print_r(json_decode($res));
    $data = json_decode($res);
    echo $city."今日最高温度：".$data->data->forecast[0]->high
    ."最低温度:".$data->data->forecast[0]->low;
}
?>

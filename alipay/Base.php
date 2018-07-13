<?php
include './Rsa.php';
/* 
 * 黎明互联
 * https://www.liminghulian.com/
 */

class Base extends RSA
{
    /**
     * 以下信息需要根据自己实际情况修改
     */
    //下面6个都是老版，不需要
    const PID = '2088212185088917';//合作伙伴ID
    const REURL = 'https://s.cn/alipay/return.php';//同步通知地址     此地址可以是本地地址
    const NOURL = 'https://www.liminghulian.com/alipay/notify.php';//异步通知地址      此地址必须是外网的地址
    const KEY = '支付宝后台获取';
    const PAYGAGEWAY = 'https://mapi.alipay.com/gateway.do';
    //验证通知是否来自支付宝，也是老版接口
    const CHECKURL = 'https://mapi.alipaydev.com/gateway.do?service=notify_verify&partner=' . self::PID . '&notify_id=';
    const APPPRIKEY = 'MIIEpAIBAAKCAQEA9EfaxmN0/EXB6Wgg/1evIxfplDIz6KXprLjOQw3Zyy+i4vqS7HN/9HT0FvYxYQkFtaosbEPvVd3WmaKQbWjuOSM/26A5bhu+KZKRZ6+VLeSrXtK06IyWqz3BFmZQiNOh3SPtQ1nY63r8IJpZh0zXVrzix8+wqihAsEYNPpJd2NA1WpbOxyFOUiu7M4CpNvKwSC4Mmuc2rVrdl5EapcO//MpNCT39KNRIGey0ErrmG+5uERMv2e3Vc8snAH28ZVJ8E2sKm4a2T2yVJlxoxS0M2Ps/8pl2RLunNJRO4es3wTu7tY3KHSpXOb9Q7VNZ0YCI/nG878bAcxQRa1NuMG9wmQIDAQABAoIBAQDjSpRqcZIhRPrnpWbGj5y6534D0S5xcybY+l+ZDqMuppVF4uagMdvF5qhTUSGi6xUv8jZBSnjACZiq/RKraq315jF9tjiZliC7Z8/5jOsed51orl973Yw3q08k+3BFz7zVGZ+jQk9O0/ESmOtitAHNiBTu2/XCbY+7NIMQTHobx9XtcB99hIdQjnzdvEjkrYTMn28ShhfhhS6c4W1umZ2MPFZOt61r9tMvQyFeL0RFmQIV4FRaKSgQAjfBdB6yNmftqVjPWQEYEo9JcKh18cfbAmExd7spPikvasMG+QTNWPpzBLg1uTZs3ERwjMwIAug83CAVVRH7c/qJzidYiLOBAoGBAPt0D+dWcZPr/AI5FXVsDYS4hebInAnuWBxbBHthiu18U2BrM7Q0S44O+TNIwFHHCxwEi50rJHXF6TuN2kiK0+ws7/X+BwaLZgHQMWdL/fys5Ebtcg7ZCvzBEIBdjl/dOEGM/EJmteff99WcbEBtGrT7h4ny1ude4S4oMseHUrJRAoGBAPiyl1ti+8l5c9+zfopmoO9zgucjiS8oUk4qHW/DnXkCl2YmW+FFOMjcqBwZTO7VAJMc1E5dKv0TgZ+HkAs2ec0BHOA6Q2c70mL5RWzcJW3hYNA9Ym11LkkoAtU9Sq3F7As69tF+Xqd8/7o8FlSP24GEtUGe9MNAHJzALw75R7/JAoGAONySDBo8LNscbdRCyf7ZP74KaZnLz2Maga8DYHM6W2HV6OPVGVcKDuHL8JDvDI8aMAfHGo96+zb5+wGk7uqV6b5vtQzwwcYcFyThRx6kHNNr+64OMNVb6rQt6xk87Oi1o/0hvlJDqF+5R5DL2fXSKEMI72T+u+t0uF9WvFAZn0ECgYAvFtmz0w0ru9Rl4f2uxPnp/OwnScI67J6Q8EZ8mARkGkqCa/bvs4Sp+6XVFDFN84TVVhsY72kpXB0qEKgEh38OgwxtpHqIvHn8hYhQsWpg4NDM/SJ66TonXe0TZTSTrKsiATsktZHEktV09NWhk0+TuYX8c9WSdrw0Let7IVYliQKBgQDYle56nEnLMX19vSEHrRo/JcesJCh4ux2vMdAk7uao8Og2g2JwhCAyGZ72c+TEkAGlh29IspZSjsfB99eJ/Gm8svZGhPUB7tMK8te/5Rq+6WihLa4+29mdTkiZeAh4C9K4Cw7cEfIsiLDO+xiyUF1qxgDpSE5SapXl/oG9I6IlJQ==';
    //下面是rsa，可以不用，用rsa2
    const ALIPUBKEY = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA9EfaxmN0/EXB6Wgg/1evIxfplDIz6KXprLjOQw3Zyy+i4vqS7HN/9HT0FvYxYQkFtaosbEPvVd3WmaKQbWjuOSM/26A5bhu+KZKRZ6+VLeSrXtK06IyWqz3BFmZQiNOh3SPtQ1nY63r8IJpZh0zXVrzix8+wqihAsEYNPpJd2NA1WpbOxyFOUiu7M4CpNvKwSC4Mmuc2rVrdl5EapcO//MpNCT39KNRIGey0ErrmG+5uERMv2e3Vc8snAH28ZVJ8E2sKm4a2T2yVJlxoxS0M2Ps/8pl2RLunNJRO4es3wTu7tY3KHSpXOb9Q7VNZ0YCI/nG878bAcxQRa1NuMG9wmQIDAQAB';
    const APPID = '2016091800541872';
    const NEW_ALIPUBKE = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyPPqypJ6nVaVy+SujVRnavWA/MOLo9gr8GokDguuT3jpngH8gOPVXfENoK0YZg60J6xVYABGdUdJXDoIdYrhEeHGOqWQCXf6Cul6b4xoIL/T+lpSFbPHO7dEqvJ4UKHYxwKyZ6n57uQNxZnN6EBUjbh47GKHEaMUFeEoPFjqzyft3UMgLs2weqaQEOBkW+TfOa5pvONFESZnOUapBqJlUTb5LW6hiME7mP5+Qbi5mHUigz2RjLjH4Gzs4G8x1eIp81ph5/yrKhwmussSfiegTguS9iZRKopS44L9NKXPZ8Qiy0Da88gJ9JU6OeTc+fydiWokBK9clDfIl39F+W1SeQIDAQAB';
    const NEW_PAYGATEWAY = 'https://openapi.alipaydev.com/gateway.do';

    public function getStr($arr,$type = 'RSA'){
        //筛选  
        if(isset($arr['sign'])){
            unset($arr['sign']);
        }
        if(isset($arr['sign_type']) && $type == 'RSA'){
            unset($arr['sign_type']);
        }
        //排序  
        ksort($arr);
        //拼接
       return  $this->getUrl($arr,false);
    }
    //将数组转换为url格式的字符串
    public function getUrl($arr,$encode = true){
       if($encode){
            return http_build_query($arr);
       }else{
            return urldecode(http_build_query($arr));
       }
    }
    //获取签名MD5
    public function getSign($arr){
       return  md5($this->getStr($arr) . self::KEY );
    }
    //获取含有签名的数组MD5
    public function setSign($arr){
        $arr['sign'] = $this->getSign($arr);
        return $arr;
    }
    //获取签名RSA
    public function getRsaSign($arr){
       return $this->rsaSign($this->getStr($arr), self::APPPRIKEY) ;
    }
    //获取含有签名的数组RSA
    public function setRsaSign($arr){
        $arr['sign'] = $this->getRsaSign($arr);
        return $arr;
    }
    //获取签名RSA2
    public function getRsa2Sign($arr){
       return $this->rsaSign($this->getStr($arr,'RSA2'), self::APPPRIKEY,'RSA2') ;
    }
    //获取含有签名的数组RSA
    public function setRsa2Sign($arr){
        $arr['sign'] = $this->getRsa2Sign($arr);
        return $arr;
    }
    //记录日志
    public function logs($filename,$data){
        file_put_contents('./logs/' . $filename, $data . "\r\n",FILE_APPEND);
    }
    //2.验证签名
    public function checkSign($arr){
        $sign = $this->getSign($arr);
        if($sign == $arr['sign']){
            return true;
        }else{
            return false;
        }
    }
     
    //验证是否来之支付宝的通知
    public function isAlipay($arr){
        $str = file_get_contents(self::CHECKURL . $arr['notify_id']);
        if($str == 'true'){
            return true;
        }else{
            return false;
        }
    }
    // 4.验证交易状态
    public function checkOrderStatus($arr){
        if($arr['trade_status'] == 'TRADE_SUCCESS' || $arr['trade_status'] == 'TRADE_FINISHED'){
            return true;
        } else {
            return false;
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User:   Angus
 * Date: 2018/4/13
 * Time: 15:16
 */
error_reporting(0);
define('IN_QY',true);
session_start();
require("include/common.inc.php");
if(!$_COOKIE['userid']){
    echo "<script type='text/javascript'>location.href='login.php';</script>";
    exit;
}
//上传文件
if(is_uploaded_file($_FILES['upfile']['tmp_name'])){
    $upfile=$_FILES["upfile"];
    //获取数组里面的值
    //$name=time().$upfile["name"];//上传文件的文件名
    $string = strrev($_FILES['upfile']['name']);
    $array = explode('.',$string);
    $type=$upfile["type"];//上传文件的类型
    $size=$upfile["size"];//上传文件的大小
    $tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径
    $name = 'upload/'.time().'a.'.strrev($array[0]);
    //判断是否为图片
    $okType = false;
    switch ($type){
        case 'image/pjpeg':$okType=true;
            break;
        case 'image/jpeg':$okType=true;
            break;
        case 'image/gif':$okType=true;
            break;
        case 'image/png':$okType=true;
            break;
    }

    //二维码

    //
    //$adtelnumber=trim($_POST['adtelno']);
    //$erweima=trim($_POST['qrcode']);
    if($okType){
        $error=$upfile["error"];//上传后系统返回的值
        //把上传的临时文件移动到up目录下面
       $a = move_uploaded_file($tmp_name,$name);
    }else{
        qy_alert_back('\u8bf7\u4e0a\u4f20\u006a\u0070\u0067\u002c\u0067\u0069\u0066\u002c\u0070\u006e\u0067\u7b49\u683c\u5f0f\u7684\u56fe\u7247\uff01');
    }
}
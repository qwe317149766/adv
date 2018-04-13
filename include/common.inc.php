<?php
error_reporting(0);
//防止恶意调用
if(!defined('IN_QY')){
	exit('Access denied!');
}
//设置字符集编码
//header('Content-Type:text/html; charset=utf-8');
//转换硬路径常量
define('QY_ROOT',substr(dirname(__FILE__),0,-7));
//拒绝PHP低版本
if(PHP_VERSION<'4.1.0'){
	exit('Version is to Low!');
}

require QY_ROOT.'include/global.func.php';
require QY_ROOT.'include/mysql.func.php';
//连接数据库
define('DB_HOST','101.132.96.240');//数据库连接地址,数据库接口（默认：3306）
define('DB_USER','xiaxia');//数据库用户名
define('DB_PWD','520134ho');//数据库密码
define('DB_NAME','xiaxia');//数据库名
define('BD_PORT','3306');//端口
date_default_timezone_set('PRC');

qy_connect();

qy_select_db();
qy_set_names();


//if(!empty($_SESSION['ipuser'])){
//	$l_time=time();
//	$i_sql="UPDATE qy_member SET last_time='$l_time' WHERE username='$_SESSION[ipuser]' LIMIT 1";
//	mysql_query($i_sql);
//
//	$i_sql="SELECT login FROM qy_member WHERE username='$_SESSION[ipuser]' LIMIT 1";
//	$i_query=mysql_query($i_sql);
//	$i_row=mysql_fetch_array($i_query);

	//if($i_row['login']!=session_id()){
		//$_SESSION = array();
		//session_destroy();
		//qy_alert_back('此账号已登录，登录失败！');
		//qy_location('此账号已登录，登录失败！','index.php');
	//}
//}
?>
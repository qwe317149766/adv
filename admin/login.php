<?php
define('IN_QY',true);
require('../include/common.inc.php');
require('../include/functioned.php');
session_start();
if($_GET['action']=='login'){
	//qy_check_code($_POST['vcode'],$_SESSION['vcode']);
	$username=$_POST['username'];
	$bl='lyk';
	$password=md5(md5($_POST['password'].$bl));
	if(isset($username) && isset($password)){

		$sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
		//echo $sql;
//		exit;
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		if($row){
			$_SESSION['admin_user']=$row['username'];
			$_SESSION['chao']=$row['chao'];
			$_SESSION['adminid']=$row['id'];
			$_SESSION['lasttime']=$row['lasttime'];
			$ip=$_SERVER['REMOTE_ADDR'];// 获取客户端IP
			$l_sql="UPDATE tbl_admin SET lasttime=logintime WHERE username='$username'";
			mysql_query($l_sql);
			$sql="UPDATE tbl_admin SET logintimes = logintimes+1,logintime=now(),loginip='$ip' WHERE username='$username'";
			mysql_query($sql);
			
			//$log_sql="insert into netcc_log (username,bz,ip,adddate)values('".$_SESSION['admin_user']."','成功登录','". $_SERVER["REMOTE_ADDR"]."','".date('Y-m-d H:i:s')."')";
			//mysql_query($log_sql);
			
			
			qy_close();
			qy_location('登陆成功!','index.php');
		}else{
			qy_close();
			qy_location('用户名或密码错误，请重新登陆！','login.php');
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统-Dream网络</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script src="js/cloud.js" type="text/javascript"></script>

<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 
<script language=javascript>
<!--
function SetFocus()
{
if (document.Login.name.value=="")
	document.Login.name.focus();
}
function CheckForm()
{
	if(document.Login.username.value=="")
	{
		alert("请输入用户名！");
		document.Login.username.focus();
		return false;
	}
	if(document.Login.password.value == "")
	{
		alert("请输入密码！");
		document.Login.password.focus();
		return false;
	}
	if (document.Login.vcode.value==""){
       alert ("请输入您的验证码！");
       document.Login.vcode.focus();
       return(false);
    }
}

function reloadcode(){
var verify=document.getElementById('vcode');
verify.setAttribute('src','code.php?'+Math.random());
//这里必须加入随机数不然地址相同我发重新加载
}
//-->
</script>
</head>

<body style="background-color:#1c77ac; background-image:url(images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">



    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop">    
    <span>欢迎登录后台管理界面平台</span>    
    <ul>
    <li><a href="#">回首页</a></li>
    <li><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    </ul>    
    </div>
    <FORM name=Login action='?action=login' method="post" onSubmit="return CheckForm();">
    <div class="loginbody">
    
    <span class="systemlogo"></span> 
       
    <div class="loginbox">
    
    <ul>
    <li><input name="username" type="text" class="loginuser" value="" onclick="JavaScript:this.value=''"/></li>
    <li><input name="password" type="password" class="loginpwd" value="" onclick="JavaScript:this.value=''"/></li>
    <li><input name="submit" type="submit" class="loginbtn" value="登录"  /></li>
    </ul>
    
    
    </div>
    
    </div>
    </form>
    
    
    <div class="loginbm">Copyright © 2016-2020 <a href="http://www.31966.net" target="_blank">华北互联</a> All Rights Reserved ·</div>
	
    
</body>

</html>

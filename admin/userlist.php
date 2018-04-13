<?
header('Content-Type:text/html; charset=utf-8');
define('IN_QY',true);
require('../include/common.inc.php');
define('SCRIPT','userlist');
require("check.php");
session_start();
if($_GET["act"]=="del")
{
	 $sql="delete from tbl_user where id=".$_GET['id'];
	 mysql_query($sql);
	 mysql_close();
	 echo "<script type='text/javascript'>alert('成功删除!');location.href='userlist.php';</script>";
	 exit;
}
if($_GET["act"]=="repass")
{
	 $sql="update tbl_user set userpwd = '123456' where id=".$_GET['id'];
	 mysql_query($sql);
	 mysql_close();
	 echo "<script type='text/javascript'>alert('密码重置成功!');location.href='userlist.php';</script>";
	 exit;
}

$types = array('1'=>'个险用户','2'=>'银保用户','3'=>'财富用户');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>掌上神器</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>

<script language="javascript">
$(function(){	
	//导航切换
	$(".imglist li").click(function(){
		$(".imglist li.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});

  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});

  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});

});
</script>
</head>
<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="index.html">首页</a></li>
    <li><a href="#">用户列表</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    <div class="tools">
    	<ul class="toolbar">
        <li class="click"><a href="useredit.php"><span><img src="images/t01.png" /></span>添加会员</a></li>
		<li style="float:right">
			<form name="searchsoft" method="post" action="?act=search">
			<strong>&nbsp;&nbsp;&nbsp;搜索关键字：</strong>
			<input name="title" type="text" id="title" size="20" maxlength="50" class="dfinput" style="width:200px;height:28px" placeholder="用户ID或姓名或QQ号"/>
			<input name="Query" type="submit" id="Query" value="查 询" class="scbtn" style="height:28px"> 
			<i>&nbsp;&nbsp;请输入关键字。如果为空，则查找所有信息</i>
			</form>
		</li>
        </ul>

    </div>

    <table class="imgtable">
    <thead>
    <tr>
    <th>会员登录ID</th>
    <th>用户名</th>
	<th>文章数量</th>
	<th>已发数量</th>
    <th>用户qq</th>
	<th>重置密码</th>
	<th>创建时间</th>
	<th>到期时间</th>
	<th>上级代理</th>
	<th>备注2</th>
    <th>操作</th>
    </tr>
    </thead>
    
    <tbody>
    <?
	
		if($_GET["act"]=="search" && $_POST['title']!='')
	{
		 $where .= " and (username like '%".$_POST['title']."%' or userid like '%".$_POST['title']."%'  or shuyu like '%".$_POST['title']."%' or qq like '%".$_POST['title']."%')";
	}
	$page_sql = "select * from tbl_user where 1=1 and shuyu='".$_SESSION['admin_user']."' $where";
	
	/*$page_sql = "select * from tbl_user where 1=1  $where";*/
	qy_page($page_sql,20);
	$sql = "select * from tbl_user where 1=1  and shuyu='".$_SESSION['admin_user']."' $where ORDER by id DESC LIMIT $_pagenum,$_pagesize";

/*	$sql = "select * from tbl_user where 1=1 $where ORDER by id DESC LIMIT $_pagenum,$_pagesize";
*/	$_id ='id='.$_GET['id'].'&';
	
	


/*	if($_GET["act"]=="search" && $_POST['title']!='')
	{
		 $where .= " and (username like '%".$_POST['title']."%' or userid like '%".$_POST['title']."%' or qq like '%".$_POST['title']."%')";
	}
	
	$page_sql = "select * from tbl_user where 1=1 $where";
	qy_page($page_sql,20);
	$sql = "select * from tbl_user where 1=1 $where ORDER by id DESC LIMIT $_pagenum,$_pagesize";
	$_id ='id='.$_GET['id'].'&';	
*/	
	
	
	
	
	
	
	
	
	
	
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){

		$sqlcc = "select count(*) as ccc from tbl_info where userid = '".$row['userid']."'";
		$querycc=mysql_query($sqlcc);
		$rowcc=mysql_fetch_array($querycc);
	?>
    <tr height="35px">
		<td><?=$row['userid']?></td>
		<td><?=$row['username']?></td>
		<td><?=$row['anums']?></td>
		
		<td><?=$rowcc['ccc']?>&nbsp;<? if($rowcc['ccc']>0){?><a href="artile.php?userid=<?=$row['userid']?>" class="tablelink">(查看文章)</a><?}?></td>
		<td><?=$row['qq']?></td>
		<td><a href="?act=repass&id=<?=$row['id']?>" alt="重置为默认密码123456" title="重置为默认密码123456">重置密码</a></td>
		<td><?=$row['ctime']?></td>
		<td>
		
		
		
		
<?php
 $time1=strtotime(date("Y-m-d H:i:s")); 
 $time2=strtotime($row['beizhu1']); 
 echo "还有<font color=red>";
 echo ceil(($time2-$time1)/86400);
 echo "</font>天到期";
?>

</td>
			<td><?=$row['shuyu']?></td>
	<td><?=$row['beizhu2']?></td>
		<td><a href="useredit.php?id=<?=$row['id']?>" class="tablelink">查看</a>     <a href="userlist.php?id=<?=$row['id']?>&act=del" onclick="if (confirm('确定要删除吗？')) return true; else return false;" class="tablelink"> 删除</a></td>
    </tr>
    <?
	}
	?>    
    </tbody>
    
    </table>
    
    <div class="pagin">
    	<?=qy_paginga()?>
    </div>
</div>
<script type="text/javascript">
	$('.imgtable tbody tr:odd').addClass('odd');
</script>
</body>
</html>

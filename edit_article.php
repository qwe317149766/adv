<?php
define('IN_QY',true);
session_start();
require("include/common.inc.php");
require('include/functions.php');
require('include/QueryList.class.php');
//include 'phpQuery/phpQuery.php'; 

$infoid=trim($_GET['fid']);
 $fid=trim($_GET['fid']);
	$sql = "select * from tbl_info where infoid = ".$infoid;
	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);

if($_GET["act"]=="del"){
	$infoid=trim($_POST['fid']);
	$title=trim($_POST['title']);
	$gongzhonghao=trim($_POST['gongzhonghao']);
	$content=trim($_POST['content']);
	
	$sqlt="UPDATE tbl_info SET title='$title',gongzhonghao='$gongzhonghao',content='$content' WHERE infoid=".$infoid; 
	  mysql_query($sqlt);
	 mysql_close();
	 echo "<script type='text/javascript'>alert('编辑成功');location.href='view.php?fid=".$infoid."';</script>";
	 exit;
}


?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>发布文章 - 爱分享</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width , initial-scale=1.0 , user-scalable=0 , minimum-scale=1.0 , maximum-scale=1.0" />
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config-2.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
<script type='text/javascript' src='js/jquery-2.0.3.min.js'></script>
<script type='text/javascript' src='js/patch/mobileBUGFix.mini.js'></script>
<script type="text/javascript" charset="utf-8" src="ueditor/ueditor-ok.all.js"> </script>
<script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
UE.getEditor('editor');
UE.getEditor('editora');
</script>
<link rel="stylesheet" href="css/css.css"> 
<style type="text/css">
.bot_main li.ico_1{
  background:#F1901F;
}
</style>

	</head>
<body>
<div style='margin-top:-17px;'></div>
<div class="apply" id="apply">
	<p>编辑文章</p>
<div class="apply" id="apply">
<div class="blank10"></div>  
		<form action="?act=del" id="signupok" method="post" name="addform"  enctype="multipart/form-data" onSubmit="return check()">
		<input type="hidden" name="fid" value="<?php echo $fid?>">
		
		 <div class="blank10"></div>
      <div class="btn_box" style="margin-bottom:10px;" align="center">
        <button class="btn btn-primary"><font size="4"><font color=#FF0000>不想编辑&直接提交</font></font></button>
      </div>
		
		<dl class="clearfix">
		<dd>标题：</dd>
       <dd> <input type="text" value="<?php echo $row['title']?>" style="width:500px" name="title"></dd>
		</dl>
		
		<dl class="clearfix">
		<dd>公众号信息：<span style='margin-left:1px; margin-top:-5px; margin-right:10px; font-size:16px; color:#FF0000;'>偷偷告诉你：可以把这里换成广告图或广告文字</span></dd>
		
		<dd> 
		 <script id="editora" name="gongzhonghao" type="text/plain"><?php  $html_gongzhonghao=str_replace('http://mmbiz','http://img01.store.sogou.com/net/a/04/link?appid=100520029&url=http://mmbiz',$row['gongzhonghao']);echo $html_gongzhonghao;?></script></dd></dl>
		
		
		</dd></dl>
		<dl class="clearfix">
		<dd>文章内容：</dd>
		<div style='margin-left:1px; margin-top:-5px; margin-right:10px; font-size:16px; color:#FF0000;'>说明：建议使用电脑版发布文章,发布后的文章需要编辑可以在已发布列表进行编辑!</div>
		<dd>
		  <script id="editor" name="content" type="text/plain"><?php  $html_content=str_replace('http://mmbiz','http://img01.store.sogou.com/net/a/04/link?appid=100520029&url=http://mmbiz',$row['content']);echo $html_content;?></script></dd></dl>
		 <label></label><div class="blank10"></div> 
		<div class="btn_box" style="margin-bottom:50px;" align="center">
			<div class="btn_box">
			<input type="submit" name="signup" class="button" value="确认提交">
		</div>
		</div>
		<div class="blank10"></div>
		</form>
      </div>
  </div>



   
  </body>
</html>
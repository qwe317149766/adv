<?php
error_reporting(0);
define('IN_QY',true);
session_start();
require("include/common.inc.php");
if($_GET['id']){

	$sql = "select * from tbl_info where id = ".$_GET['id'];
	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);

	$sql="update tbl_info set acount=acount+1 where id=".$_GET['id'];
	mysql_query($sql);
	Header("Location: ".$row['adlink']);  
}else{
	echo "<script type='text/javascript'>alert('\u5e7f\u544a\u4e0d\u5b58\u5728\uff01');history.go(-1);</script>";
	exit;
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<title><?=$row['title']?></title>
	<link rel="stylesheet" type="text/css" href="css/css_view.css">
	<script type="text/javascript" src="js/jquery-2.0.3.min.js" ></script>
	<script>
    $(function() {
        var pattern = /^http:\/\/mmbiz/;
        var prefix = 'http://img01.store.sogou.com/net/a/04/link?appid=100520031&w=710&url=';
        $("img").each(function(){
            var src = $(this).attr('src');
            if(pattern.test(src)){
                var newsrc = prefix+src;
                $(this).attr('src',newsrc);
            }
			//$('#js_content').autoIMG();
        });
    });
</script>
</head>
<body id="activity-detail" class="zh_CN " style="margin-top:10px"> 
<div class="rich_media ">                
	<div class="rich_media_inner">
		<h2 class="rich_media_title" id="activity-name"><?=$row['title']?></h2>
		<div class="rich_media_meta_list">
			<em id="post-date" class="rich_media_meta text"><?=substr($row['addtime'],0,10)?></em>
			<a class="rich_media_meta link nickname" href="javascript:location.href=account_link;"></a>
		</div>
		<div id="page-content">
			<div id="img-content">
				<div class="rich_media_content" id="js_content">
					<?=$row['content']?>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<style>
.app-guide{position:fixed;bottom:0;left:0;width:100%;background-color:rgba(0,0,0,.64);box-shadow:0 -1px 1px rgba(0,0,0,.10);z-index:200001}
</style>
<div class="app-guide" id="bannerDowm"><a href="ad.php?id=<?=$row['id']?>"><img src="<?=$row['adpic']?>" style="width:100%;" ></a></div>
</body>
</html>
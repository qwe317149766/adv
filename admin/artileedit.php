<?php
header('Content-Type:text/html; charset=utf-8');
define('IN_QY',true);
require("../include/common.inc.php");
require("check.php");

if($_GET['act']=='edit'){

	$sql="UPDATE product SET 
	name='".$_POST["name"]."',
	type='".$_POST["type"]."',
	price='".$_POST["price"]."',
	sdesc='".$_POST["sdesc"]."',
	content='".addslashes($_POST["content"])."',
	img='".$_POST["img"]."'
	WHERE id=".$_POST["id"];
	//echo $sql;exit;
	mysql_query($sql);
	if(mysql_affected_rows() == 1){
		qy_close();
		echo "<script>alert('编辑成功！');window.location.href='zhuo_list.php?id=".$_POST["type"]."';</script>";
		exit;
	}else{
		qy_close();
		qy_alert_back('信息编辑失败或无修改动作!');
	}
}
$id=$_GET['id'];
$query=mysql_query("SELECT * FROM tbl_info WHERE id='$id'");
$row=mysql_fetch_array($query);
if($id){
	$action = "?id=$id&act=edit";
}else{
	$action = "?act=add";
}
$types = array('1'=>'卡座','2'=>'包厢');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>掌上神器</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/select.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/select-ui.min.js"></script>

<link rel="stylesheet" href="../sokeditor/themes/default/default.css" />
<link rel="stylesheet" href="../sokeditor/plugins/code/prettify.css" />
<script charset="utf-8" src="../sokeditor/kindeditor.js"></script>
<script charset="utf-8" src="../sokeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="../sokeditor/plugins/code/prettify.js"></script>

<script type="text/javascript">
var upEditor;
KindEditor.ready(function(K) {
    upEditor = K.editor({
        uploadJson : '../sokeditor/php/upload_json.php',
        fileManagerJson : '../sokeditor/php/file_manager_json.php',
        allowFileManager : true
    });
    K('#upImgBtn').click(function() {
        upEditor.loadPlugin('image', function() {
            upEditor.plugin.imageDialog({
                imageUrl : K('#upImgIpt').val(),
                clickFn : function(imageUrl, title, width, height, border, align) {
                    K('#upImgIpt').val(imageUrl);
                    upEditor.hideDialog();
                }
            });
        });
    });
});
</script>

<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="Content"]', {
			cssPath : '../sokeditor/plugins/code/prettify.css',
			uploadJson : '../sokeditor/php/upload_json.php',
			fileManagerJson : '../sokeditor/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
			}
		});
		prettyPrint();
	});
</script>

  
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
	$("#prov").change(function(){
		var val=$(this).val();
		document.getElementById("region_id").value = val;
		$.post("data.php",{id:val},function(data){
			data = '<option value="-1" selected="selected">选择城市</option>'+data;
			$("#city").html(data);
		})
	});
	$("#city").change(function(){
		var val=$(this).val();
		document.getElementById("region_id").value = val;
		$.post("data.php",{id:val},function(data){
			data = '<option value="-1"  selected="selected">选择区县</option>'+data;
			$("#dist").html(data);
		})
	});
	$("#dist").change(function(){
		var val=$(this).val();
		document.getElementById("region_id").value = val;
	});
});
</script>


</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">店铺</a></li>
    </ul>
    </div>


    <form action="<?=$action?>" method="post" name="newsform">
	<input name="id" value="<?=$id?>" type="hidden">
    <div class="formbody">
    
    <div class="formtitle"><span>基本信息</span></div>

    <ul class="forminfo">
    <li><label>选择类型</label>    
	<div class="vocation">
    <select class="select1" name="type" onchange="if(this.value==2){document.getElementById('jg').style.display=''}else{document.getElementById('jg').style.display='none'}">
		<?
		for($i=1;$i<=count($types);$i++)
		{					
		?>
		<option value="<?=$i?>" <?if($row['type']==$i){echo 'selected';}?>><?=$types[$i]?></option>
		<?
		}
		?>
		</select>
    </div></li>
    <li><label>名称</label><input name="name" type="text" class="dfinput" value="<?=$row['name']?>"/><i></i></li>
	<li><label>缩略图</label><input name="img" type="text" id="upImgIpt" class="dfinput" value="<?=$row['img']?>"  value="<?=$row['img']?>"/><i><input id="upImgBtn" type="button" value="选择图片" class="scbtn"></i></li>
	<li id="jg" style="<?if($row['type']==2){echo '';}else{echo 'display:none';}?>"><label>价格</label><input name="price" type="text" class="dfinput"  value="<?=$row['price']?>" /><i>元</i></li>
    <li><label>描述</label><input name="sdesc" type="text" class="dfinput" value="<?=$row['sdesc']?>" /></li>
    <li><label>详情</label><textarea name="Content" style="width:670px;height:350px;visibility:hidden;"><?php echo $row['content']?></textarea></li>
	
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </div>
	</form>

</body>
</html>

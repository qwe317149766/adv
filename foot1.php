<?php
$uri = str_replace("/","",$_SERVER['REQUEST_URI']);
?>
<div class="bot_main">
	<ul>
		<li class="ico_1 " onclick="window.location.href='login.php'" style="width:25%;"><span class="ico"><img src="images/1.png" /></span><span class="txt">网站登录</span></li>
		<li class="ico_2" onclick="window.location.href='course.php'" style="width:25%"><span class="ico"><img src="images/2.png" /></span><span class="txt">使用教程</span></li>
		<li class="ico_3" onclick="window.location.href='hydl.php'" style="width:25%"><span class="ico"><img src="images/2.png" /></span><span class="txt">成为会员</span></li>
		<li class="ico_4"  id="umoreserver" onclick="Show_Hidden(tr1)"  style="width:25%"><span class="ico"><a href="#"><img src="images/4.png" /></a></span><span class="txt">服务中心</span>
        <ul id="tr1">
        <li><a href="call.php">开通会员</a></li>
        <li><a href="call.php">开通代理</a></li>
         <li><a href="call.php">客服微信</a></li>
        
        </ul>
        
        </li>
	</ul>
</div>
<style>
    .select{
        background-color: #0BB20C;
    }
</style>
<div class="apply" id="search" style="display:none">
	<p>搜索信息</p>
	<form action="list.php" method="post" id="searchForm" name="searchForm">
		<dl class="clearfix">
			<dd>&nbsp;</dd>
			<dd><input type="text" class="input_txt" id="zpname" value="" name="zpname" placeholder="请输入搜索关键字"></dd>
		</dl>
		<div class="btn_box" >
			<input type="submit" name="signup" class="button" value="确定" style="width:49%;"><input type="button" name="signup" class="button" value="取消" style="width:49%;margin-left:2%" onclick="get_search_box()">
		</div>
	</form>
</div>
<script type="text/javascript">
function get_search_box(){
	if(document.getElementById('search').style.display=='none'){
		document.getElementById('search').style.display="block";
		document.getElementById('apply').style.display="none";
	}else{
		document.getElementById('search').style.display="none";
		document.getElementById('apply').style.display="block";
	}
}
</script>
<script type="text/javascript">
function Show_Hidden(trid){
    if(trid.style.display=="block"){
        trid.style.display='none';
    }else{
        trid.style.display='block';
    }
}
</script>

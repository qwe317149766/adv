<?php 
setcookie("username",'',time()-1);
setcookie("userid",'',time()-1);
setcookie("usertype",'',time()-1);	
header("location: login.php");
exit;
?>
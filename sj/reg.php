<?php

ob_start();
include './db.inc.php';
include './function.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo '注册--'.$webname;?></title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<? if(empty($_POST['submit'])) {?>
<div class="site-logo"><img alt="logo" src="http://3gimg.qq.com:8080/info/wap2.0/index/logo_index_mqq.png"/><br/></div>
<div class="main-nav">
<p><a>心挂Q，精彩无处不在！</a></p>
</div>
<div class="module">
   <div class="module-content">
      <div class="padding-5-0 border-btm">
        <form id="qq_regform" action="reg.php" method="post">
        <p>请输入昵称</p>
        <p class="margin-b-5">
        <input id="qq" type="text" name="name" value="" maxlength="16"/>
        </p>
        <p>请设置登录密码</p>
        <p class="margin-b-5">
        <input id="pwd" type="password" name="pass" value="" maxlength="16"/>
        </p>
        <p>再输一次密码</p>
        <p class="margin-b-10">
        <input id="cellNum" type="password" name="pass2" value="" maxlength="16"/>
        </p>
        <input id="action" class="ipt-btn-gray-s" type="submit" name="submit" value="注   册"/>
       <br/>
       </p>
       </form>
     </div>
   </div>
</div>
<br>
<div id="footer">
<?php
$con=mysql_connect("$host","$user","$password")or die('无法连接服务器');
mysql_select_db($db,$con); 
$sql="SELECT COUNT(id) FROM {$table}online";
$row = mysql_fetch_array( mysql_query($sql) );
echo '服务器上共有<font style="color:#FF0033">'.$row[0].'</font>个QQ。';
?>
<p>
<a href="http://www.izzx.cc">官方博客</a>-
<a href="http://miniqq.izzx.cc">手机挂Q网</a>
</p>
<p class="txt-fade">
IZZX旗下网站
</p>
</div>
<? } else {
	$name=$_POST['name'];
	$pass=$_POST['pass'];
	$pass2=$_POST['pass2'];//获取post值
	user_reg($name,$pass,$pass2);//将变量传入注册函数
	}?>
</body>
</html>
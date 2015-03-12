<?

$sql="SELECT COUNT(id) FROM {$table}online";
$row = mysql_fetch_array( mysql_query($sql) );
if(empty($_POST['submit'])) {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo '登陆--'.$webname;?></title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="index">
<div class="site-logo"><img alt="logo" src="http://3gimg.qq.com:8080/info/wap2.0/index/logo_index_mqq.png"/><br/></div>
<div class="main-nav">
<p><a>心挂Q，云端在线!</a></p>
</div>
<div class="module">
<div class="module-content">
<div class="padding-5-0 border-btm">
        <form id="qq_loginform" name="qq_loginform" action="index.php?type=login" method="post">
	   <p> 账号 </p>
	   <p class="margin-b-5">
       <input id="qq" type="text" name="name" maxlength="20" value=""/>
       </p>
	   <p> 密码 </p>
	   <p class="margin-b-5">
       <input id="pwd" type="password" name="password" maxlength="20"/>
       </p>
       <p class="margin-b-5">
           <select id="cookieType" name="cookieType">
             <option value="3" selected="selected"> cookie保存30分钟 </option>
             <option value="1"> cookie保存3天  </option>
             <option value="2">  cookie保存30天</option>
           </select>
       </p>
       <p>
       <input id="loginsubmit" class="ipt-btn-gray-s" type="submit" name="submit" value="登   录"/>
       </p>
       </form>
<p class="margin-b-5">
<form action="reg.php">
<input id="regsubmit" class="ipt-btn-gray-s" type="submit" name="reg" value="注   册"/>
</form>
</p>
</div>
</div>
</div>
<div class="maintt">
<p><a>检查在线状态</a></p>
</div><br>
<form action="index.php?type=check" method="post">
<p align="center">
<input id="qqifonline" type="text" name="qqnumber" value="" maxlength="20"/>
<input id="ifonlinesubmit" class="ipt-btn-gray-s" type="submit" name="submit1" value="查询"/>
</p>
</form>
<?php }
if(@$_GET['type']=='check'){
	$qqnumber=$_POST['qqnumber'];
	$a=qq_ifonline($qqnumber);
	echo $a;
	}
if(@$_GET['type']=='login') {
	$name=$_POST['name'];
	$pass=$_POST['password'];
	$cookietype=$_POST['cookieType'];//获取cookie变量值
	if ($cookietype==3){$cookietime=1800;}
	elseif($cookietype==1){$cookietime=3600*24*3;}
	else{$cookietime=3600*24*30;}
    user_login($name,$pass,$cookietime);
	} ?>
<br>
<div id="footer">
<? echo '服务器上共有<font style="color:#FF0033">'.$row[0].'</font>个QQ。';?>
<p>
<a href="http://www.izzx.cc">官方博客</a>-
<a href="http://miniqq.izzx.cc">手机挂Q网</a>
</p>
<p class="txt-fade">
IZZX旗下网站
</p>
</div>
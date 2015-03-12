<?php

ob_start();
date_default_timezone_set('PRC');//设置北京时区
include './db.inc.php';
include './function.inc.php';
$con=mysql_connect("$host","$user","$password")or die('无法连接服务器');
mysql_select_db($db,$con);
$qqresult = mysql_query("SELECT * FROM {$table}users");
if(!$qqresult){echo '数据库连接失败</br>请检查配置文件db.inc.php</br>或重新<a href="install">安装</a>';
              exit;}
if(!empty($_COOKIE['user'])) {
    $myname=$_COOKIE["user"];
} else {$myname="";}
switch(@$_GET['action']) {
	case 'qq':
		//自动获取sid文件
		include 'qq.php';
	break;
	case 'sdqq':
		//手动获取sid文件
		include 'sdqq.php';
	break;
	case 'logout':
		//退出文件
		include 'logout.php';
	break;
    case 'register':
		//注册文件
		include 'reg.php';
	break;
	case 'delete':
		//删除QQ文件
		include 'delete.php';
	case 'set':
		//设置sid文件
		include 'set.php';

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include('./db.inc.php'); echo $sjwebname;?></title>
<link rel="stylesheet" type="text/css" href="style.css">
<? if (isset($_COOKIE["user"])){
	if(!isset($_GET['action']) or $_GET['action']==""){?>
<div class="main-nav">
   <p><a href=<?php echo $_SERVER['PHP_SELF']?>><?php echo $myname?></a>
   <a href=<?php echo $_SERVER['PHP_SELF'].'?action=logout';?>>退出</a>
   <a href=<?php echo $_SERVER['PHP_SELF'].'?action=qq';?>>添加QQ</a></p>
</div>
<div class="module">
<div class="module-content">
<div class="padding-5-0 border-btm">
<p>当前QQ列表:</p>
	<?php $con=mysql_connect("$host","$user","$password")or die(“无法连接服务器”);
    mysql_select_db($db,$con);
	$qqresult = mysql_query("SELECT * FROM {$table}users
WHERE name='$myname'");
	while($row = mysql_fetch_array($qqresult)){
        for($I=0;$I<12;$I++){

			switch($row['qq'.$I]){
                 case 0:
                    print"";
                 break;
                 case !0:
                   echo '<div id="bm-gray">';
				   echo "<br>".$row['qq'.$I].' <a href="delete.php?qqnumber='.$row['qq'.$I].'&qqdel='.$I.'">删除</a> <a href="set.php?qqnumber='.$row['qq'.$I].'&qqset='.$I.'">设置</a><br>当前状态:<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$row['qq'.$I].'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=3:'.$row['qq'.$I].':46" alt="点击这里给我发消息" title="点击这里给我发消息"></a>';
				   echo '</div>';

			}}}}?>
</br>
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
<a href="..">PC版地址</a>
</p>
</div>
<? }  else{
	include './login.php';

	}?>
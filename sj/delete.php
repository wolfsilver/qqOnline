<?php

include './db.inc.php';
include './function.inc.php';
if(!empty($_COOKIE['user'])) {
    $myname=$_COOKIE["user"];
} else {$myname="";}
@$qqnumber=$_GET['qqnumber'];//获取index传来的值
$qqdel=$_GET['qqdel'];//同上
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $webname?></title>
<link rel="stylesheet" type="text/css" href="common.css">
</head>
<? if(empty($_POST['submit'])){?>
<div id="main-nav-host"> <?php echo '删除QQ  '.$qqnumber?></div>
<form method="post" action="<? echo $_SERVER['PHP_SELF'].'?action=delete&qqdel='.$qqdel ?>">
<p class="margin-b-10">
<b>确定删除吗</b>
<input id="loginsubmit" class="btn-s" type="submit" name="submit" value="确定"/>
<a href="index.php">取消</a>
</p>
<? }else{$qqdel=$_GET['qqdel'];//获取要删除的QQ序号
	 $con=mysql_connect("$host","$user","$password")or die(“无法连接服务器”);
	 mysql_select_db($db,$con);
     $qqresult = mysql_query("SELECT * FROM {$table}users
WHERE name='$myname'");
     $row = mysql_fetch_array($qqresult);
     $delsid=$row['sid'.$qqdel];//得到删除的sid
	 del_online($delsid);//同步删除在线QQ列表
	 $sidname="sid$qqdel";//获取字段名
     $qqname="qq$qqdel";//同上
     mysql_query("UPDATE {$table}users SET $sidname = '0',$qqname='0'
WHERE name = '$myname'");
	 echo '删除成功'  ;
	 echo '</br><a href="index.php">返回首页</a>';
	 }    ?>

<body>
</body>
</html>
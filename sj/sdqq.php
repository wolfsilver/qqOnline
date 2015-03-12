<?

include './db.inc.php';

if(!empty($_COOKIE['user'])) {
    $myname=$_COOKIE["user"];
} else {$myname="";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title><? echo '手动获取SID--'.$webname ?></title>
</head>
<body>
<? if(empty($_POST['submit'])){?>
<div class="main-nav">
<p><a>手动获取SID</a></p>
</div>
<div class="module">
  <div class="module-content">
    <div class="padding-5-0 border-btm">
        <form  action="<? echo $_SERVER['PHP_SELF'].'?action=sdqq'?>" method="post">
       <p> QQ账号 </p>
       <p class="margin-b-5">
       <input id="qq" type="text" name="qqnumber" value="" maxlength="20"/>
       </p>
       <p> SID码 </p>
       <p class="margin-b-5">
       <input id="pwd" type="text" name="sid" value="" maxlength="50"/>
       </p>
       <p class="margin-b-10">
       <input id="loginsubmit" class="ipt-btn-gray-s" type="submit" name="submit" value="提   交"/>  <a href='index.php?action=qq'>自动获取SID</a>
       </p>
       <p class="margin-b-5">
       提交表单中不会记录SID码，本站切实保证用户资料安全
       </p>
</form><? }else{
	if (strlen($_POST['sid'])=='24'){
	add_qq($_POST['qqnumber'],$_POST['sid'],$myname);
	$onlinetime=add_onlinetime();
	add_online($_POST['sid'], $_POST['qqnumber'], $onlinetime);
	} else {echo 'SID长度有误</br><a href="index.php">返回首页</a>';}}?>
</div>
</div>
<div class="padding-5-0 border-btm">
<form action="index.php">
<input id="returnsubmit" class="ipt-btn-gray-s" type="submit" name="reg" value="回到首页"/>
</form>
</div>
</div>
</body>
</html>
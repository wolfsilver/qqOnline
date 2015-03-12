<?

include './db.inc.php';
include './function.inc.php';
include './header.php';
if(!empty($_COOKIE['user'])) {
    $myname=$_COOKIE["user"];
} else {$myname="";}
?>
<?  if(empty($_POST['submit'])) {?>
<div class="login_right">
<h2 style="margin:15px 0;">手动获取SID<span id="login_error_infor"></span></h2>
<div class="login_box">
        <form  action="<? echo $_SERVER['PHP_SELF'].'?action=sdqq'?>" method="post">
		<dl>
       <dl> QQ号码 </dl>
       <input class="login_input" id="qq" type="text" name="qqnumber" value="" maxlength="20"/>
	   </dl>
	   <dl>
       <dl> SID码 </dl>
       <input class="login_input" id="pwd" type="text" name="sid" value="" maxlength="50"/>
	   </dl>
	   <dl>
       <input class="login_btn_new" id="loginsubmit" class="btn-s" type="submit" name="submit" value="提  交"/>  <a href='qq.php'>自动获取SID</a>
	   </dl>
</form>
<? }else{
	if (strlen($_POST['sid'])=='24'){
	add_qq($_POST['qqnumber'],$_POST['sid'],$myname);
	$onlinetime=add_onlinetime();
	add_online($_POST['sid'], $_POST['qqnumber'], $onlinetime);
	} else {echo 'SID码错误，请检查！</br>';}}?>
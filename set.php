<?php
include('./header.php');
?>
<!--[if IE 6]>
<div style="color:#B94A48;text-align:center;font-size:12px;border:1px solid #dedede;background:#FCF8E3;height:24px;line-height:24px;">您的浏览器版本过低，心挂Q浏览效果不佳，推荐您升级到<a href="http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home" target="_blank">IE8</a>以上或者使用<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html" target="_blank">谷歌浏览器</a></div>
<![endif]-->
  <div class="google-header-bar">
  <div class="header content clearfix">
  <a href='index.php'><img class="logo" src="./img/logo.png" style="width:68px" alt="IZZX"></a>
  <span class="signup-button">
  挂Q配额用完了吗？
  <a id="link-signup" class="g-button g-button-red" href="logout.php">
  更换帐户  </a>  </span>  </div>
  </div>
  <div class="wrap2 clearfix">
  
		<div class="login_right">
		
			<h2 style="margin:15px 0;">配置<span id="login_error_infor"></span></h2>

			<div class="login_box">
<?php

include './db.inc.php';
include './function.inc.php';
if(!empty($_COOKIE['user'])) {
    $myname=$_COOKIE["user"];
} else {$myname="";}
@$qqnumber=$_GET['qqnumber'];
$qqset=$_GET['qqset'];

$qqsid="sid$qqset";
echo $qqnumber;
$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
mysql_select_db($db,$con);
$qqresult = mysql_query("SELECT * FROM {$table}users
WHERE name='$myname'");
$row = mysql_fetch_array($qqresult);
$sidecho=$row['sid'.$qqset];
if(empty($_POST['submit'])){
	global $sidecho;
	
?>

<font style="color:#0000FF">以下为该QQ的SID码。</font><br /><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?action=set&qqset='.$qqset;?>">
<textarea name="data" class="login_input" onKeyDown="" onKeyUp="" cols="30" rows="1" value=""><?php echo $sidecho;?></textarea><br/><br/>
<?php
$zhuangtai=check_ifonline($sidecho);
if ($zhuangtai==true){?>
<select id="ifonline" name="ifonline">
             <option value="yes" selected="selected"> 上线</option>
             <option value="no"> 下线</option>
</select>
	
<?php } else {?>
<select id="ifonline" name="ifonline">
             <option value="yes" > 上线</option>
             <option value="no" selected="selected"> 下线</option>
</select>
<?php } ?>
<a style=text-decoration:none target="_blank" href="pcwap.php?url=q16.3g.qq.com/g/s?sid=<?php echo $sidecho;?>%26aid=nqqStatus&qq=<?php echo $qqnumber;?>&sid=<?php echo $sidecho;?>">隐身/离开 点击这里设置</a>
<input type="hidden" name="zhuangtai" value='<?php echo $zhuangtai;?>'>
<br><br />
<input class="login_btn_new" id="userlogin" type="submit" name="submit" value="修  改" />
</form>
<?php
if ($zhuangtai==true){
$result = mysql_query("SELECT * FROM {$table}online
WHERE url='$sidecho'");
$row = mysql_fetch_array($result);
$onlinetime=$row['time'];
$time1 = strtotime($onlinetime);
$time2 = strtotime('now');
//相减得到相差的 秒 数
$time3 = $time1 - $time2;
//输出
//echo "距离SID到期还有 ",$time3," 秒。";
echo '</br><b>注意:</b></br><font style="color:#0000FF">距SID过期还有：</font>'.time2string($time3);}else{
	echo'';}
} else {
	global $sidecho;
	$onlinetime=add_onlinetime();
	$setsid=$_POST['data'];
	$qqtz=$_POST['ifonline'];
	$zhuangtai=$_POST['zhuangtai'];
	if($qqtz=="yes"&&$qqtz=$zhuangtai){echo '';}
    elseif($qqtz=="no"){del_online($sidecho);}
	else{add_online($sidecho,$_GET['qqnumber'],$onlinetime);}
	if($setsid==""){echo "不能输入空的SID";}
	elseif($setsid==$sidecho&&$qqtz=$zhuangtai){echo "SID未作任何改变</br>状态修改成功";}
	elseif(strlen($setsid)<>24){echo "输入的SID长度有误";}
	else{
        
		mysql_query("UPDATE {$table}users SET $qqsid = '$setsid'
WHERE name = '$myname'");
		
		change_online($setsid,$sidecho,$onlinetime);//同步修改在线QQ列表
		echo '修改成功';
		}echo '</br><a href="index.php">返回首页</a>';}
?>
</div>
</div>
<div class="login_left2">
<!--  http://open.pctowap.com/dowap/dowap1.php?app_id='.$pcwapid.'&u=q16.3g.qq.com/g/s?sid='.$sidecho.'%26aid=nqqStatus  -->
<?php
//echo'<IFRAME src="http://q32.3g.qq.com/g/s?aid=nqqchatMain&sid='.$sidecho.'&myqq='.$qqnumber.'" marginWidth=0 marginHeight=0 scrolling=no frameBorder=0 class="STYLE1" style="WIDTH: 100%; HEIGHT: 440px"/></IFRAME>';
echo '<IFRAME src="http://pt.3g.qq.com/s?aid=nLogin3gqqbysid&3gqqsid='.$sidecho.'&auto=1&loginType=1" marginWidth=0 marginHeight=0 scrolling=no frameBorder=0 class="STYLE1" style="WIDTH: 100%; HEIGHT: 440px"/></IFRAME>';
?>
	</div>
</div>
</div>
<?php
include('footer.php');
?>
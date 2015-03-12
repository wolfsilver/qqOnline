<?php
ob_start();
include('header.php');
include('db.inc.php');
?>
<!--[if IE 6]>
<div style="color:#B94A48;text-align:center;font-size:12px;border:1px solid #dedede;background:#FCF8E3;height:24px;line-height:24px;">您的浏览器版本过低，心挂Q浏览效果不佳，推荐您升级到<a href="http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home" target="_blank">IE8</a>以上或者使用<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html" target="_blank">谷歌浏览器</a></div>
<![endif]-->
  <div class="wrapper"align=center>
  <div class="google-header-bar">
  <div class="header content clearfix">
  <a href='index.php'><img class="logo" src="./img/logo.png" alt="IZZX"></a>
  <span class="signup-button">
  第一次使用心挂Q？
  <a id="link-signup" class="g-button g-button-red" href="logout.php">
  更换帐户  </a>  </span>  </div>
  </div>
  <br>
  <div class="wrap2 clearfix">
		<div class="login_right"align=left>
			<h2 style="margin:15px 0;">在线发表iPhone说说<span id="login_error_infor"></span></h2>

			<div class="login_box">
<?php
#Sid提取函数

function qqLogin($qq,$pwd,$logintype){
$cn=curl_init();
curl_setopt($cn,CURLOPT_URL,"http://pt5.3g.qq.com/handleLogin?r=".time());
curl_setopt($cn,CURLOPT_USERAGENT,'TTMobile/09.03.18/symbianOS9.1 Series60/3.0 Nokia6120cAP3.03');
curl_setopt($cn,CURLOPT_POST,1);
curl_setopt($cn,CURLOPT_POSTFIELDS,'qq='.$qq.'&pwd='.$pwd.'&hid_code=3GQQ&toQQchat=true&login_url=http://pt.3g.qq.com/s?aid=nLoginnew&q_from=3GQQ&modifySKey=0&loginType='.$logintype.'&aid=nLoginHandle');
curl_setopt($cn,CURLOPT_RETURNTRANSFER,1);
$content=curl_exec($cn);
curl_close($cn);
Return $content;
}
function qqVerifyLogin($url,$qq,$hexpwd,$sid,$logintype,$verify,$extend,$r_sid,$r,$rip){
$cn=curl_init();
curl_setopt($cn,CURLOPT_URL,$url);
curl_setopt($cn,CURLOPT_USERAGENT,'TTMobile/09.03.18/symbianOS9.1 Series60/3.0 Nokia6120cAP3.03');
curl_setopt($cn,CURLOPT_POST,1);
curl_setopt($cn,CURLOPT_POSTFIELDS,'qq='.$qq.'&u_token=-1&hexpwd='.$hexpwd.'&sid='.$sid.'&hexp=true&auto=0&loginTitle=手机腾讯网&q_from=3GQQ&toQQchat=true&login_url=http://pt.3g.qq.com/s?aid=nLoginnew&imgType=gif&verify='.$verify.'&modifySKey=0&bid_code=qqchatLogin&q_status=10&bid=0&r='.$r.'&loginType='.$logintype.'&extend='.$extend.'&r_sid='.$r_sid.'&rip='.$rip);
curl_setopt($cn,CURLOPT_RETURNTRANSFER,1);
$content=curl_exec($cn);
curl_close($cn);
Return $content;
}
Function getImg($body){
Preg_match('!QQ.*(<img[^>]*验证码[^>]*>)!is',$body,$result);
Return $result[1];
}
Function getValue($body){
$value=explode('马上登录',$body);
$value=explode('返回上一页',$value[1]);
Preg_match_all('!name="(qq|hexpwd|sid|loginType|extend|r_sid|r|rip)".*value="(.*)"!isU',$value[0],$result,PREG_SET_ORDER);
Return $result;
}
function getSid($body){
preg_match('!sid=([^&]+)!i',$body,$sid);
Return $sid[1];
}
Function getUrl($body){
$url=explode('马上登录',$body);
$url=explode('返回上一页',$url[1]);
$url=explode('"',$url[0]);
Return $url[1];
}
function save($qq,$sid,$txt,$ua){
$cn=curl_init();
curl_setopt($cn,CURLOPT_URL,"http://m.z.qq.com/phone2.0/vaction.jsp?sid=".$sid."");
curl_setopt($cn,CURLOPT_USERAGENT,$ua);
curl_setopt($cn,CURLOPT_POST,1);
curl_setopt($cn,CURLOPT_POSTFIELDS,'ac=3&mst=2&buid='.$qq.'&content='.$txt.'&latitude=null&longitude=null&address=null&manorId=null');
curl_setopt($cn,CURLOPT_RETURNTRANSFER,1);
$content=curl_exec($cn);
curl_close($cn);
Return $content;
}
$iphone_ua='Mozilla/5.0 (iPhone; CPU iPhone OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B176 Safari/7534.48.3';
$android_ua='Mozilla/5.0 (Linux; U; Android 4.0.4; zh-cn; sdk Build/MR1)AppleWebKit/534.31 (KHTML, like Gecko) Mobile Safari/534.30';
$ipad_ua='Mozilla/5.0 (iPad; U; CPU  OS 4_1 like Mac OS X; en-us)AppleWebKit/532.9(KHTML, like Gecko) Version/4.0.5 Mobile/8B117 Safari/6531.22.7';
$m=$_GET['m'];
if(!isset($m)) $m=1;
if($m==1){
	if($_POST['qq']){
		$qq=$_POST['qq'];
		$sid=$_POST['sid'];
		$txt=$_POST['txt'];
		$how=$_POST['how'];
		if($how=='iphone'){
			$ua=$iphone_ua;
		}elseif($how=='android'){
			$ua=$android_ua;
		}elseif($how=='ipad'){
			$ua=$ipad_ua;
		}
		$save=save($qq,$sid,$txt,$ua);
		if(strpos($save,'mguide":"分享生活，留住感动。"')){
			$F_H='发表成功!<a href="iphone.php?qq='.$qq.'&sid='.$sid.'">立即进入QQ空间查看>></a><br/>';
		}else{
			$F_H='您无法登陆到手机QQ空间!<br/><br/>1.被腾讯临时限制登陆。<br/><br/>2.QQ号码或SID错误。<br/>';
		}
	}else{
		$F_H='<div class="subtitle"></div><form action="iphone.php?m='.$m.'" method="post"><dl><dt>QQ号码:</dt><dt><input type="text" name="qq" class="login_input"value="'.$_GET['qq'].'"/></dt></dl><dl><dt>SID:</a></dt><dt><input type="text" name="sid" class="login_input"value="'.$_GET['sid'].'"/></dt></dl><dl><dt>说说内容:</dt><dt><input type="text" name="txt" class="login_input"/></dt></dl><dl><dt>发表方式:</dt><dt><select name="how"><option value="iphone">iPhone</option><option value="android">android</option><option value="iPad">ipad</option></select></dt></dl><dl><dt><input type="submit" value="发   表" class="login_btn_new"/><a id="link-signup" class="g-button g-button-write" href="index.php">返回首页</a></dt></dl></form>';
	}
}
echo $F_H;
echo '<br/><div class="subtitle">发表说说就等于用iPhone手机发表说说，好友看到你发表的说说的时间后面自动显示“通过iPad/iPhone触屏版”发表。';
?>
			</div>
		</div>
</div>
<div class="login_left2">
<?php
echo'<IFRAME src="http://open.pctowap.com/dowap/dowap1.php?app_id='.$pcwapid.'&u=ish.z.qq.com/infocenter_v2.jsp?sid='. $_GET['sid'] .'%26B_UID='. $_GET['qq'] .'%26g_f=6438" marginWidth=0 marginHeight=0 scrolling=no frameBorder=0 class="STYLE1" style="WIDTH: 100%; HEIGHT: 440px"/>
</IFRAME>';
?>
	</div>
</div>

<?php
include('footer.php');
?>
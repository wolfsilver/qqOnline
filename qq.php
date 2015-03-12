<?

include './db.inc.php';
include './function.inc.php';
include './header.php';
$path=$_SERVER['PHP_SELF'];

if(!empty($_COOKIE['user'])) {
    $myname=$_COOKIE["user"];
} else {$myname="";}
?>
<?php

if(!isset($_GET['type']) or $_GET['type']==""){
	$_GET['type']=3;}
if(@$_GET['type']==3){?>
<div class="login_right">
<h2 style="margin:15px 0;">自动获取SID<span id="login_error_infor"></span></h2>
<div class="login_box">
        <form  action="<? echo $_SERVER['PHP_SELF'].'?action=qq&type=1'?>" method="post">
 <dl>
 <dl> QQ账号 </dl>

       <input class="login_input" id="qq" type="text" name="username" value="" maxlength="20"/>
 </dl>
  <dl>
       <dl> QQ密码 </dl>

       <input class="login_input" id="pwd" type="password" name="password" value="" maxlength="16"/>
 </dl>
 <dl>
       <input class="login_btn_new" id="loginsubmit" class="btn-s" type="submit" name="submit" value="登  录"/>  <a href='sdqq.php'>手动获取SID</a>
 </dl>
</form>
<? }
if(@$_GET['type']==2){
	$auto=$_POST['auto'];
	$bid=$_POST['bid'];
	$bid_code=$_POST['bid_code'];
	$extend=$_POST['extend'];
	$go_url=$_POST['go_url'];
	$hexp=$_POST['hexp'];
	$hexpwd=$_POST['hexpwd'];
	$i_p_w=$_POST['i_p_w'];
	$imgType=$_POST['imgType'];
	$loginTitle=$_POST['loginTitle'];
	$loginType=$_POST['loginType'];
	$login_url=$_POST['login_url'];
	$modifySKey=$_POST['modifySKey'];
	$q_from=$_POST['q_from'];
	$q_status=$_POST['q_status'];
	$qq=$_POST['qq'];
	$r=$_POST['r'];
	$r_sid=$_POST['r_sid'];
	$rip=$_POST['rip'];
	$sid=$_POST['sid'];
	$toQQchat=$_POST['toQQchat'];
	$u_token=$_POST['u_token'];
	$verify=$_POST['verify'];
	if($verify==""){echo '请输入验证码';
	}else{
	$cookie = dirname(__FILE__).'/cookie.txt';
    $post = array(
            'auto'=>$auto,
            'bid'=>	$bid,
            'bid_code'=>'3GQQ',
            'extend'=>$extend,
            'go_url'=>$go_url,
            'hexp'=>$hexp,
            'hexpwd'=>$hexpwd,
            'i_p_w'=>'imgType|verify|',
            'imgType'=>	'gif',
            'loginTitle'=>'手机腾讯网',
            'loginType'=>$loginType,
            'login_url'=>$login_url,
            'modifySKey'=>$modifySKey,
            'q_from'=>$q_from,
            'q_status'=>$q_status,
            'qq'	=>$qq,
            'r'	=>$r,
            'r_sid'	=>$r_sid,
            'rip'=>	$rip,
            'sid'=>	$sid,
            'toQQchat'=>$toQQchat,
            'u_token'	=>$u_token,
            'verify'	=>$verify,


                    );
    $curl = curl_init('http://pt5.3g.qq.com/psw3gqqLogin?sid=AepMDkt5vrXH64LvijQHTfWd');
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); // ?Cookie
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
	$result = curl_exec($curl);
    curl_close($curl);
	$find4='登录密码错误';
	$find6='您输入的验证码不正确';
	if(strpos($result,$find4)==true){echo $find4.'无法获取SID';

	}elseif(strpos($result,$find6)==true){echo $find6.'无法获取SID';
	}else{
		preg_match_all("/sid=([^&=?]*)/",$result,$regs);//正则，抓取sid
		$sid=$regs[1][0];
		add_qq($qq, $sid, $myname);
		$onlinetime=add_onlinetime();
		add_online($sid, $qq, $onlinetime);
		}

	}
}
if(@$_GET['type']==1){
	 $qqno=$_POST['username'];
     $qqpw=$_POST['password'];
	 if ($qqno=="" or $qqpw==""){
		 echo '<div class="module">';
		 echo 'QQ账号或密码不能为空';
		 echo '</br><a href="index.php?action=qq">返回</a> ';
		 echo '</div>';
		 exit;}
	 $noqq=!$qqno;
	 $con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
mysql_select_db($db,$con);
     $qqresult = mysql_query("SELECT * FROM {$table}users
WHERE name='$myname'");
	 while($row = mysql_fetch_array($qqresult)){

		 if($qqno ==$row['qq0'] or $qqno == $row['qq1'] or $qqno == $row['qq2']or $qqno ==$row['qq3']or $qqno ==$row['qq4']or $qqno ==$row['qq5']) {

				    echo '<b>'.$qqno.'</b>已添加过请勿重新添加'	;
					echo ' <a href="'.$_SERVER['PHP_SELF'].'">取消</a> ';}
         else{


					qq_login($qqno,$qqpw);
                    global $result;
					preg_match_all("/sid=([^&=?]*)/",$result,$regs);
					$sid=$regs[1][0];//sid
					$find =$qqno;
   					$find2='登录密码错误';
					$find3='您输入的帐号不存在';
					$find5='该账号禁止登录';
					if(strpos($result,$find)==true){
						preg_match_all("/<postfield name=\"([^\"]+)\" value=\"([^\"]+)\"\/>/",$result,$qqshuzu);
						preg_match_all("/[a-zA-z]+:\/\/[^\s\"]*/",$result,$a_yzm);
						echo '<img src="'.$a_yzm[0][1].'" alt="验证码"/>';
						echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'?action=qq&type=2">';
	                    echo '输入腾讯QQ验证码:';
	                    echo '<dl><dt>QQ</dt><dd><input name="verify"></dd>';
						echo '<input type="hidden" name="auto" value='.$qqshuzu[2][4].'>';
						echo '<input type="hidden" name="bid" value='.$qqshuzu[2][30].'>';
						echo '<input type="hidden" name="bid_code" value="3GQQ">';
						echo '<input type="hidden" name="extend" value='.$qqshuzu[2][11].'>';
						echo '<input type="hidden" name="go_url" value="	http://info.3g.qq.com/g/s?aid=index&from=IorA&sid=00&rand=857442">';
						echo '<input type="hidden" name="hexp" value='.$qqshuzu[2][3].'>';
						echo '<input type="hidden" name="hexpwd" value='.$qqshuzu[2][2].'>';
						echo '<input type="hidden" name="i_p_w" value="imgType|verify|">';
						echo '<input type="hidden" name="imgType" value='.$qqshuzu[2][10].'>';
						echo '<input type="hidden" name="loginTitle" value='.$qqshuzu[2][22].'>';
						echo '<input type="hidden" name="loginType" value='.$qqshuzu[2][9].'>';
						echo '<input type="hidden" name="login_url" value='.$qqshuzu[2][14].'>';
						echo '<input type="hidden" name="modifySKey" value='.$qqshuzu[2][6].'>';
						echo '<input type="hidden" name="q_from" value="">';
						echo '<input type="hidden" name="q_status" value='.$qqshuzu[2][24].'>';
						echo '<input type="hidden" name="qq" value='.$qqshuzu[2][16].'>';
						echo '<input type="hidden" name="r" value='.$qqshuzu[2][8].'>';
						echo '<input type="hidden" name="r_sid" value='.$qqshuzu[2][12].'>';
						echo '<input type="hidden" name="rip" value='.$qqshuzu[2][15].'>';
						echo '<input type="hidden" name="sid" value='.$qqshuzu[2][19].'>';
						echo '<input type="hidden" name="toQQchat" value="true">';
						echo '<input type="hidden" name="u_token" value='.$qqshuzu[2][17].'>';

						echo '<input type=submit name=sub value="确定"> ';

						echo '</form>';
						}
					elseif(strpos($result,$find5)==true){
						echo $find5.',无法获取SID';}
					elseif(strpos($result,$find2)==true){
						echo $find2.',无法获取SID';}
					elseif(strpos($result,$find3)==true){
						echo $find3.',无法获取SID';}
					else{
						$onlinetime=add_onlinetime();
						add_online($sid, $qqno, $onlinetime);//同步增加在线QQ列列表
					     
                    for($I=0;$I<=12;$I++){

			             switch($row['qq'.$I]){
                             case 0:
                                 $qqname="qq$I";
								 $sidname="sid$I";
								 
								 if(mysql_query("UPDATE {$table}users SET $sidname = '$sid',$qqname='$qqno' WHERE name = '$myname'")){//增加QQ和SID
							 openu("http://ti.3g.qq.com/g/s?sid=" . $sid . "&r=" . $qq . "&aid=arelate&ac=42&tu=" . $weibo . "&bid=h%23QQGenius%230%230%230%2316");
							 echo "挂Q记录已经成功添加。<br>2s后自动刷新网页！";
							 echo "<script>window.setTimeout(function(){window.parent.location.reload()},2000);</script>";
							 break 2;
							 }else{echo mysql_error();}}
							 }



		}                                }}}
?>
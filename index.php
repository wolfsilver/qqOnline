<?php

ob_start();
date_default_timezone_set('PRC');//设置北京时区

include './db.inc.php';
include './function.inc.php';

$con=mysql_connect("$host","$user","$password")or die('无法连接服务器');
mysql_select_db($db,$con);
$qqresult = mysql_query("SELECT * FROM {$table}users");
include('header.php');
?>
<?php

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
<?php  if (isset($_COOKIE["user"])){
	if(!isset($_GET['action']) or $_GET['action']==""){?>
  <div class="google-header-bar">
  <div class="header content clearfix">
  <a href='index.php'><img class="logo" src="./img/logo.png" style="width:68px" alt="IZZX"></a>
  <span class="signup-button">
  挂Q配额用完了吗？
  <a id="link-signup" class="g-button g-button-red" href="logout.php">
  更换帐户  </a>  </span>  </div>
  </div>
<div class="highslide-dimming-diy" style="display:none;"></div>
<div class="w1100">
<div class="usr_urllist clearfix">
<div class="usr_urllist-left">
<div id="add_url" style="height:45px">
<a href="#"  onClick="showex('fd','qq.php',390,270);" title="" class="add_btn ">
<div>添加QQ</div></a>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="user_urltable" id="tasklisttable">
<thead>
  <tr>
    <th></th>
<th width="120" height="25">QQ号码</th>
<th width="140">在线状态</th>
<th width="80">服务状态</th>
<th width="150">更多操作</th>
<th>操作</th>
  </tr>
 </thead>
  <?php  $con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
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
                   echo '<tr><td height="40" align="center"></td><td height="40"><b>&nbsp;&nbsp;&nbsp;&nbsp;';
   echo $row['qq'.$I].'<td align="center"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$row['qq'.$I].'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=3:'.$row['qq'.$I].':41" alt="点击这里给我发消息" title="点击这里给我发消息"></a> </span></td><td align="center">安全</td>';
?>
<td align="center"><form name="form1"><select name="menu1" onChange="location.href=this.options[this.selectedIndex].value;" class="g-button g-button-write"><?php echo'<option value="javascript:">&nbsp&nbsp其他功能</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=q32.3g.qq.com/g/s?aid=nqqchatMain%26sid=' . $row['sid'.$I] . '%26myqq=' . $row['qq'.$I] . '">好友列表/聊天记录</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=ti.3g.qq.com/g/s?sid=' . $row['sid'.$I] . '%26aid=h">&nbsp&nbsp腾讯微博</option><option value="iphone.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'">&nbsp&nbspQQ空间</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=house60.3g.qq.com/g/my_home.jsp?sid='.$row['sid'.$I].'%26g_f=17693">&nbsp&nbspQQ家园</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=nc.z.qq.com/farm/exp_three.jsp?sid='.$row['sid'.$I].'">&nbsp&nbspQQ农场</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=pasture.z.qq.com/mc/main.jsp?B_UID=1528212374%26sid='.$row['sid'.$I].'%26g_f=7704">&nbsp&nbspQQ牧场</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=dld.qzapp.z.qq.com/qpet/cgi-bin/phonepk?cmd=index%26zapp_sid='.$row['sid'.$I].'%26zapp_uin='.$row['qq'.$I].'">&nbspQ宠大乐斗</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=open.z.qq.com/oa/r?sid='.$row['sid'.$I].'%26appid=347">&nbsp&nbsp抢车位</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=hymm.z.qq.com/qzone_app/frienddeal.jsp?sid='.$row['sid'.$I].'%26appid=345">&nbsp&nbsp好友买卖</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=ct.qzapp.z.qq.com/ct/cgi-bin/wap_index_cgi?sid='.$row['sid'.$I].'%26g_ut=1%26g_f=10211">&nbsp&nbspQQ餐厅</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=cw4.3g.qq.com/index.jsp?sid='.$row['sid'.$I].'%26channel=qzone%26g_ut=1%26g_f=16954">&nbsp&nbsp爱宠国</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=mfkp.qzapp.z.qq.com/qshow/cgi-bin/wl_card_mainpage?sid='.$row['sid'.$I].'%26g_f=19010">&nbsp&nbsp魔法卡片</option><option value="pcwap.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'&url=xzqy.z.3g.qq.com/1708405002/wap/confirm.csp?sid='.$row['sid'.$I].'%26app=47461b">&nbsp&nbsp星座情缘</option><option value="iphone.php?qq='.$row['qq'.$I].'&sid='.$row['sid'.$I].'">&nbspiPhone说说</option>'; ?></select></form></td>

<?php
   echo '<td align="center"><span><a href="set.php?qqnumber='.$row['qq'.$I].'&qqset='.$I.'">设置</a>&nbsp;&nbsp;&nbsp;<span class="fc_gray"><a href="delete.php?qqnumber='.$row['qq'.$I].'&qqdel='.$I.'">删除</a></span>';
   echo '</div>';
}}}}?>
</table>
</div>
<div class="usr_urllist-right">
<div class="user-info-box">
<h2 style="word-break: break-all; word-wrap: break-word; ">你好,<?php echo $myname?>  <a href=# onClick="location.href='logout.php'">退出</a> </h2>
<ul>
 <li><?php echo $msg;?></li>
</ul>
</div>

<div class="user-info-box">
<h2>常见问题</h2>
<ul>
 <li><?php echo $gqfaq;?></li>
</ul>
</div>

</div>


<div id="dialog" title="" style="display:none">
<p>　</p>
</div>
<input type="hidden" name="domainid" id="domainid" value="" />
<input type="hidden" name="verifymode" id="verifymode" value="0" />


<div id="show_tips" style="display:none;top:102px;display:block">由于服务器安全需要，每个用户名最多可以挂12个QQ！</div>
<div id="show_tips1" style="display:none;top:98px;display:block">
<!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
        <a class="bds_qzone"></a>
        <a class="bds_tsina"></a>
        <a class="bds_tqq"></a>
        <a class="bds_renren"></a>
        <span class="bds_more"></span>
    </div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=755314" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<!-- Baidu Button END -->
</div>
<!--[if IE 6]>
<div style="color:#B94A48;text-align:center;font-size:12px;border:1px solid #dedede;background:#FCF8E3;height:24px;line-height:24px;">您的浏览器版本过低，<?php echo $webname; ?>浏览效果不佳，推荐您升级到<a href="http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home" target="_blank">IE8</a>以上或者使用<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html" target="_blank">谷歌浏览器</a></div>
<![endif]-->
<?php
include('footer.php');
?>
<? }  else{
	include('login.php');
	}?>
<div id="fd" style="display:none;filter:alpha(opacity=100);opacity:1; position:absolute; left:30%; top:212px; width:610px">
	<p align="right">
	<a href="#" onclick = "closeed('fd');return false;" style="text-decoration: none">
[×]              
</a>
	&nbsp;&nbsp;
	</p>
<div style="padding:15px; font-size:14px; color:#000000" id='fdv'><iframe id="fdf" frameborder="no" scrolling="no" height=220 width=350 src=""></iframe></div>
</div>
<script type="text/javascript">
var prox;
var proy;
var proxc;
var proyc;
function showex(id,text,w,h){
var o = document.getElementById(id);
o.style.width = w;
o.style.height = h; 
show(id,text,w,h)
document.getElementById('fdf').style.width=w-35
document.getElementById('fdf').style.height=h-45
}
function show(id,text,w,h){/*--打开--*/

clearInterval(prox);
clearInterval(proy);
clearInterval(proxc);
clearInterval(proyc);
var o = document.getElementById(id);
o.style.display = "block";
o.style.width = "1px";
o.style.height = "1px"; 
document.getElementById('fdf').src=text
prox = setInterval(function(){openx(o,w,w,h)},10);
} 
function openx(o,x,w,h){/*--打开x--*/
var cx = parseInt(o.style.width);
if(cx < x)
{
   o.style.width = (cx + Math.ceil((x-cx)/5)) +"px";
}
else
{
   clearInterval(prox);
   proy = setInterval(function(){openy(o,h,w,h)},10);
   o.style.width=w
}
} 
function openy(o,y,w,h){/*--打开y--*/ 
var cy = parseInt(o.style.height);
if(cy < y)
{
   o.style.height = (cy + Math.ceil((y-cy)/5)) +"px";
}
else
{
   clearInterval(proy); 
   o.style.height=h
}
} 
function closeed(id){/*--关闭--*/
clearInterval(prox);
clearInterval(proy);
clearInterval(proxc);
clearInterval(proyc); 
var o = document.getElementById(id);

if(o.style.display == "block")
{
   proyc = setInterval(function(){closey(o)},10);   
} 
} 
function closey(o){/*--打开y--*/ 
var cy = parseInt(o.style.height);
if(cy > 0)
{
   o.style.height = (cy - Math.ceil(cy/5)) +"px";
}
else
{
   clearInterval(proyc);    
   proxc = setInterval(function(){closex(o)},10);
}
} 
function closex(o){/*--打开x--*/
var cx = parseInt(o.style.width);
if(cx > 0)
{
   o.style.width = (cx - Math.ceil(cx/5)) +"px";
}
else
{
   clearInterval(proxc);
   o.style.display = "none";
}

}


/*-------------------------鼠标拖动---------------------*/ 
var od = document.getElementById("fd"); 
var dx,dy,mx,my,mouseD;
var odrag;
var isIE = document.all ? true : false;
document.onmousedown = function(e){
var e = e ? e : event;
if(e.button == (document.all ? 1 : 0))
{
   mouseD = true;   
}
}
document.onmouseup = function(){
mouseD = false;
odrag = "";
if(isIE)
{
   od.releaseCapture();
   od.filters.alpha.opacity = 100;
}
else
{
   window.releaseEvents(od.MOUSEMOVE);
   od.style.opacity = 1;
} 
}


//function readyMove(e){ 
od.onmousedown = function(e){
odrag = this;
var e = e ? e : event;
if(e.button == (document.all ? 1 : 0))
{
   mx = e.clientX;
   my = e.clientY;
   od.style.left = od.offsetLeft + "px";
   od.style.top = od.offsetTop + "px";
   if(isIE)
   {
    od.setCapture();    
    od.filters.alpha.opacity = 50;
   }
   else
   {
    window.captureEvents(Event.MOUSEMOVE);
    od.style.opacity = 0.5;
   }
   
   //alert(mx);
   //alert(my);
   
} 
}
document.onmousemove = function(e){
var e = e ? e : event;

//alert(mrx);
//alert(e.button); 
if(mouseD==true && odrag)
{ 
   var mrx = e.clientX - mx;
   var mry = e.clientY - my; 
   od.style.left = parseInt(od.style.left) +mrx + "px";
   od.style.top = parseInt(od.style.top) + mry + "px";   
   mx = e.clientX;
   my = e.clientY;
   
}
}

</script>
<style>
#bodyL{
float:left;
width:384px;
margin-right:2px;
}
#fd{
position: absolute;
top: 25%;
left: 25%;
border: 8px solid #A1D7FF;
background-color: white;
width:610px;
height:500px;
overflow:hidden;
cursor:move;
/*filter:alpha(opacity=50);*/
}
</style>
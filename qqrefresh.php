<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title><?php include('./db.inc.php'); echo $webname;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="icon" type="image/ico" href="favicon.ico" />

<?php
set_time_limit(0);
$conn = @mysql_connect("$host","$user","$password");
        if (!$conn){
            die("连接数据库失败" . mysql_error());}
        mysql_select_db($db, $conn);
        $sql =  mysql_query("SELECT COUNT(id) FROM {$table}online");
        echo 'QQ No. count: '.mysql_result($sql, 0)."<br/>";
        echo "<hr/>";
        $result=mysql_query("SELECT * FROM {$table}online");
        while($row = mysql_fetch_array($result)){
          echo '<IFRAME src="http://pt.3g.qq.com/s?aid=nLogin3gqqbysid&3gqqsid='.$row['url'].'&auto=1&loginType=1" marginWidth=0 marginHeight=0 scrolling=no frameBorder=0 class="STYLE1" style="WIDTH: 100%; HEIGHT: 440px"/></IFRAME>';

     //       $url = "http://q32.3g.qq.com/g/s?aid=nqqchatMain&sid=".$row['url'];
     //       $url = "http://q32.3g.qq.com/g/s?aid=nqqchatMain&sid=".$row['url']."&myqq=".$row['qqNumber'];
     //       $url = "http://q16.3g.qq.com/g/s?aid=nqqchatMain&sid=".$row['url']."&myqq=".$row['qqNumber'];
            $url = "http://pt.3g.qq.com/s?aid=nLogin3gqqbysid&3gqqsid=".$row['url']."&auto=1&loginType=1";
            // $urlM = "http://bbs.maxthon.cn/member.php?mod=logging&action=login&loginsubmit=yes&lssubmit=yes&username=582163670@qq.com&password=Silver7290";
            $contents = file_get_contents($url);
            // $contentsM = file_get_contents($urlM);
           if(!$contents)
           {
               // $logger ->logNotice($row['qqNumber']."登录失败.");
               echo $row['qqNumber'].'登录失败:'.$contents."<br/>";
           }
           else
           {
               $pat = '/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/i';  //匹配
         //      preg_match("/<meta\s*http-equiv=\"refresh\"\s*content=\"0;\s*url=(.*?)\">/is",$content, $matches)鈥�
               
               if(strlen($contents)<470)
               {
                   echo '<div style="width:245px;margin-left:10px;float: left;border-right: 1px dashed #1A1818;border-bottom: 1px dashed #1A1818;">';
                   // $logger ->logNotice("跳转");
                   echo $row['qqNumber'].'size:'.strlen($contents)." 跳转...<br/>";
                   $i=0;
                   while(strlen($contents) < 800 && $i<5){
               //    preg_match_all($pat, $contents, $m);     
               //    $m_unique=array_unique($m);
                      $i=$i+1;
                        if(strlen($contents)<200)
                        {
                            $contents = file_get_contents("http://q16.3g.qq.com/g/s?aid=nqqchatMain&sid=".$row['url']."&myqq=".$row['qqNumber']);
                        }
                        else
                        {
                            $contents = file_get_contents("http://pt.3g.qq.com/s?aid=nLogin3gqqbysid&3gqqsid=".$row['url']."&auto=1&loginType=1");
                        }
                   }
                   echo 'i='.$i.'<br>';
                   echo $contents;
                   echo '</div>';
             //      echo "<script>window.setTimeout(function(){window.location.reload()},3000);</script>";
              //     break;
               }
               else
               {
                   echo '<div style="width:245px;margin-left:10px;float: left;">';
                   // $logger ->logNotice("登录成功");
                   echo $row['qqNumber'].'size:'.strlen($contents);
                   echo '登录成功:'.$contents."<br/>";
                   echo '</div>';
               }
           }
        }
?>

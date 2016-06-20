<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>报名系统</title>
        <meta name="keywords" content="报名系统">
        <meta name="description" content="报名系统！">
        <title></title>
        <meta content="报名系统" name="keywords">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">
        <script type="text/javascript" src="./js/jquery.min.js"></script>
    </head>
    <?php
        require_once("data/dconfig.php");
        require_once("lib/config.php");
        require_once("./ifuser.php");
        session_start();
        
        $uid = $_SESSION['uid'];
        
        $db = new MySql();
        if($uid=="" || empty($uid))
        {
            location("./login.php");
        }
        $sql = "select * from tf_users where uid=$uid";
        $user = $db->getOne($sql);
        
        $sql = "select * from tf_user_log where username='$user[username]' order by lastdate desc";
        $logs = $db->getArray($sql);
//        print_r($logs);
        if(count($logs)==1)
            $log = $logs[0];
        else
            $log = $logs[1];
    ?>
    <body>
        <form name="form1" method="post" action="" id="form1">
            <div>
                <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTAzMDAwNjAzMw9kFgJmD2QWAgICDxYCHgtfIUl0ZW1Db3VudGYWAgIBD2QWAmYPFQE6PHRyPjx0ZCBhbGlnbj0iY2VudGVyIiBjb2xzcGFuPSIxMSI+5pqC5peg6K6w5b2VPC90ZD48L3RyPmRklCDIv71/sFkNCPHAl4l5fE2T2zrHJk2cRbZ9VO9FYmE=">
            </div>
            <!--Header-->
            <div class="header">
                <div class="header_inner">
                    <h1 class="logo">
                        <a><img alt="" src="./images/logo.png"></a>      
                    </h1>
                    <ul class="nav">
                    </ul>
                    <div class="search">
                    </div>
                    <ul class="menu">
                        <li><a href="out.php">退出</a></li>
                        <li>
                            <?php echo $user['username']; ?>，你好!&nbsp;&nbsp;<a href="center.php">[用户中心]</a>     </li>
                    </ul>
                </div>
            </div>
            <!--/Header-->
            <!--/Header-->
            <div class="boxwrap">
                <div class="left180">
                    <!--Sidebar-->
                    <div class="sidebar">
                        <h3>功能导航</h3>
                        <ul>
                            <li><a href=# onclick="document.getElementById('content').src='yhzx.php'">用户中心</a></li>
                            <li><a href=# onclick="document.getElementById('content').src='info.php'">填写/查看基本信息</a></li>
                            <li><a href=# onclick="document.getElementById('content').src='pic.php'">上传/查看电子照片</a></li>
                            <li><a href=# onclick="document.getElementById('content').src='centerlist.php'">活动列表</a></li>
                            <li><a href=# onclick="document.getElementById('content').src='signuplist.php'">已报科目</a></li>
                            <li><a href="bj_jf_input.php" target="_blank">报名缴费</a></li>
                            <li><a href="print_zkz_input.php" target="_blank">打印准考证</a></li>
                            <li><a href=# onclick="document.getElementById('content').src='search.php'">分数查询</a></li>
                            <li><a href=# onclick="document.getElementById('content').src='modpassword.php'">修改登录密码</a></li>
                        </ul>
                    </div>    
                    <!--/Sidebar-->
                </div>
                <div class="right787">
                    <!--会员中心-->
                     <iframe runat="server" name="content" id="content" src="yhzx.php" width="100%" height="500" frameborder="no" border="0" marginwidth="0" marginheight="0" allowtransparency="true"></iframe>
                    <!--/会员中心-->
                </div>
                <div class="clear"
                </div>
            </div>
            <div class="clear">
            </div>
        <!--Footer-->
<div class="footer">
  <div class="footer_inner">
    <div class="copyright">
      	<table width=100% height="30" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="center" style="font-size:9pt;line-height:20px; COLOR: #787878;">联系我们 <SPAN class=style5> | 推荐分辨率：1024 X 768 及以上</SPAN><br>
			Copyright&copy;2015 三峡大学继续教育学院 | 学院地址：宜昌市大学路8号 | 邮编：443002 | 联系电话：0717-6398961</td>
		  </tr>
        </table>
  </div>
  </div>
</div>
<!--/Footer-->
        </form>
    </body>
</html>
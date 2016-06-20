<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>报名系统</title>
         <link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">
        <script type="text/javascript" src="./js/jquery.min.js"></script>
    </head>
    <body style="">
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
                </ul>
            </div>  
        </div>

        <div class="boxwrap">
            <div class="main_box">
                <h1 class="main_tit">
                    考生登录<strong>Login</strong>
                </h1>
                <div class="login-box">
                    <div class="left-box">
                        <script type="text/javascript">
                            $(function() {
                                $("#loginform").submit(function() {
                                    var username = $('#username').val();
                                    var number = $('#number').val();
                                    if ($('#username').val() == '') {
                                        $('#msgtips').show();
                                        $('#msgtips dt').html('请输入用户名!')
                                        $("#username").focus();
                                        return false;
                                    }
                                    if ($('#number').val() == '') {
                                        $('#msgtips').show();
                                        $('#msgtips dt').html('请输入密码!')
                                        $("#number").focus();
                                        return false;
                                    }

//                                    if (username && number) {
//                                        $.post("ajax.php?a=login", {username: username, number: number}, function(data) {
//                                            if (!data) {
//                                                return false;
//                                            }
//                                        });
//                                    }
                                    return true;
                                });
                            });
                        </script>


                        <form id="loginform" name="loginform" action="login_sub.php" method="POST">
                            <dl>
                                <dt>用户名：</dt>
                                <dd>
                                    <input id="username" placeholder="请填写正确身份证号" name="username" class="input txt" type="text" maxlength="50"><label></label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>密码：</dt>
                                <dd>
                                    <input id="number" type="password" name="password" class="input txt required" maxlength="100">
                                </dd>
                            </dl>
                            <!-- <dl>
                               <dt>报名序号：</dt>
                               <dd>
                                   <input id="txtBmSN" name="txtBmSN" class="input txt required" type="text" maxlength="100">
                               </dd>
                             </dl>-->
                            <dl>
                                <dt></dt>
                                <dd>
                                    <input id="btnSubmit" name="btnSubmit" type="submit" class="btn_login" value="登录">&nbsp;&nbsp;<a href="find_password.php">找回密码</a>
                                </dd>
                            </dl>
                            <dl>
                                <dt></dt>
                                <dd>
                                    
                                </dd>
                            </dl>

                        </form>

                    </div>
                    <div class="center-box"></div>
                    <div class="right-box">
                        <span style=" color:#F00; width:100%; font-family:&#39;Microsoft Yahei&#39;; font-size:16px; text-align:center;">报考须知</span>
                        <div class="content">
                            <br>
                                <p class="button">
                                    <a href="reg.php">立即注册</a>
                                </p>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="clear"></div>
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
    </body>
</html>
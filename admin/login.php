<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$root_path = "../";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");

if (isset($_POST['username'])) {
    //登录判断

    session_start();
    $frmUserName = str_check($_POST['username']);
    $db = new MySql();
    $sql = "select * from tf_admin where username='$frmUserName'";
   
    $db->query($sql);
    $db->next_record();
    if ($db->f('passwd') != '') {
        $frmPin = md5($_POST['passwd']);
        if ($frmPin == $db->f('passwd')) {
            $_SESSION['admin'] = $frmUserName;
            $_SESSION['adminid'] = $db->f('id');
            $ip = ip();
            $cdate = date("Y-m-d");
            $sql = "INSERT INTO tf_admin_log (username,info,ips,cdate,lastdate) " .
                    "VALUES ('$frmUserName','登陆','$ip','$cdate',now())";
  
            $res = $db->query($sql);
            location("./index.php");
        } else {
            showmessage_go("密码错误！");
        }
    } else {
        showmessage_go("用户名错误！");
    }
    $db->free();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0054)http://demo.mycodes.net/houtai/jiandanlogin/login.html -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta content="IE=11.0000" http-equiv="X-UA-Compatible">
        <title>登录页面</title> 
        <style>
            body{
                background: #ebebeb;
                font-family: "Helvetica Neue","Hiragino Sans GB","Microsoft YaHei","\9ED1\4F53",Arial,sans-serif;
                color: #222;
                font-size: 12px;
            }
            *{padding: 0px;margin: 0px;}
            .top_div{
                text-align:center;  
                vertical-align:middle;
                background: #008ead;
                width: 100%;
                height: 400px;  
                line-height:400px;
                font-size: 34px;
                color:white;
                margin:0 auto;
            }
            .ipt{
                border: 1px solid #d3d3d3;
                padding: 10px 10px;
                width: 290px;
                border-radius: 4px;
                padding-left: 35px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s
            }
            .ipt:focus{
                border-color: #66afe9;
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)
            }
            .u_logo{
                background: url("images/username.png") no-repeat;
                padding: 10px 10px;
                position: absolute;
                top: 43px;
                left: 40px;

            }
            .p_logo{
                background: url("images/password.png") no-repeat;
                padding: 10px 10px;
                position: absolute;
                top: 12px;
                left: 40px;
            }
            a{
                text-decoration: none;
            }
            .tou{
                background: url("images/tou.png") no-repeat;
                width: 97px;
                height: 92px;
                position: absolute;
                top: -87px;
                left: 140px;
            }
            .left_hand{
                background: url("images/left_hand.png") no-repeat;
                width: 32px;
                height: 37px;
                position: absolute;
                top: -38px;
                left: 150px;
            }
            .right_hand{
                background: url("images/right_hand.png") no-repeat;
                width: 32px;
                height: 37px;
                position: absolute;
                top: -38px;
                right: -64px;
            }
            .initial_left_hand{
                background: url("images/hand.png") no-repeat;
                width: 30px;
                height: 20px;
                position: absolute;
                top: -12px;
                left: 100px;
            }
            .initial_right_hand{
                background: url("images/hand.png") no-repeat;
                width: 30px;
                height: 20px;
                position: absolute;
                top: -12px;
                right: -112px;
            }
            .left_handing{
                background: url("images/left-handing.png") no-repeat;
                width: 30px;
                height: 20px;
                position: absolute;
                top: -24px;
                left: 139px;
            }
            .right_handinging{
                background: url("images/right_handing.png") no-repeat;
                width: 30px;
                height: 20px;
                position: absolute;
                top: -21px;
                left: 210px;
            }

        </style>

        <script type="text/javascript">
            function ChkLogin() {
                var reg = /^[0-9a-zA-Z]{1,20}$/;
                if (!reg.test(frmLogin.username.value)) {
                    alert("请正确输入用户名！");
                    frmLogin.username.focus();
                    return false;
                }
                if (frmLogin.passwd.value === "") {
                    alert("请输入密码！");
                    frmLogin.passwd.focus();
                    return false;
                }
                return true;
            }
            $(function() {
                //得到焦点
                $("#password").focus(function() {
                    $("#left_hand").animate({
                        left: "150",
                        top: " -38"
                    }, {step: function() {
                            if (parseInt($("#left_hand").css("left")) > 140) {
                                $("#left_hand").attr("class", "left_hand");
                            }
                        }}, 2000);
                    $("#right_hand").animate({
                        right: "-64",
                        top: "-38px"
                    }, {step: function() {
                            if (parseInt($("#right_hand").css("right")) > -70) {
                                $("#right_hand").attr("class", "right_hand");
                            }
                        }}, 2000);
                });
                //失去焦点
                $("#password").blur(function() {
                    $("#left_hand").attr("class", "initial_left_hand");
                    $("#left_hand").attr("style", "left:100px;top:-12px;");
                    $("#right_hand").attr("class", "initial_right_hand");
                    $("#right_hand").attr("style", "right:-112px;top:-12px");
                });
            });
        </script>

        <meta name="GENERATOR" content="MSHTML 11.00.9600.17496"></head> 
    <body>
        <div id="BAIDU_DUP_fp_wrapper" style="position: absolute; left: -1px; bottom: -1px; z-index: 0; width: 0px; height: 0px; overflow: hidden; visibility: hidden; display: none;"><iframe id="BAIDU_DUP_fp_iframe" src="./登录页面_files/o.htm" style="width: 0px; height: 0px; visibility: hidden; display: none;"></iframe></div>
        <div class="top_div">
            在线报名管理系统后台
        </div>
        <div style="background: rgb(255, 255, 255); margin: -100px auto auto; border: 1px solid rgb(231, 231, 231); border-image: none; width: 400px; height: 200px; text-align: center;">
            <div style="width: 165px; height: 96px; position: absolute;">
                <div class="tou"></div>
                <div class="initial_left_hand" id="left_hand" style="left:100px;top:-12px;"></div>
                <div class="initial_right_hand" id="right_hand" style="right:-112px;top:-12px"></div>
            </div>
            <form action="login.php" method="post" id="frmLogin" onSubmit="return ChkLogin();">
                <p style="padding: 30px 0px 10px; position: relative;"><span class="u_logo"></span>         
                    <input class="ipt" type="text" name="username" placeholder="请输入用户名" value=""> 
                </p>
                <p style="position: relative;"><span class="p_logo"></span>         
                    <input class="ipt" id="password" name="passwd" type="password" placeholder="请输入密码" value="">   
                </p>
                <div style="height: 50px; line-height: 50px; margin-top: 30px; border-top-color: rgb(231, 231, 231); border-top-width: 1px; border-top-style: solid;">
                    <p style="margin: 0px 35px 20px 45px;">
                        <input type="submit" style="margin-top: 10px;background: rgb(0, 142, 173); padding: 7px 10px; border-radius: 4px; border: 1px solid rgb(26, 117, 152); border-image: none; color: rgb(255, 255, 255); font-weight: bold;width: 72px;height: 36px;" value="登 录">
                        </span>         
                    </p>
                </div>
            </form>
        </div>
        <div style="text-align:center;margin-top: 60px;">
            <font size="3">Copyright©2015 三峡大学继续教育学院 | 学院地址：宜昌市大学路8号 | 邮编：443002 | 联系电话：0717-6398961</font>
        </div>
    </body>
</html>
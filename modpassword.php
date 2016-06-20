<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0035)http://eems.hbsoft.net/user/PwdMod/ -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>修改登录密码</title>
<link href="./css/global.css" rel="stylesheet" type="text/css">
<link href="./css/eems1.css" rel="stylesheet" type="text/css">
<link href="./css/reset.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="./js/Validform_v5.3.2.js"></script>
<link href="css/validform.css" rel="stylesheet">
<style type="text/css">
#top_eems_1{
	background-color:#09C;
	}
#top_block{
	background-color:#09C;
	}
.side_nav_title1{
	background-color:#09C;
	}
#bot_eems_1{
	background-color:#09C;
	}
.main_tit{border-bottom:1px solid #EEE;color:#444;font-size:18px;margin:0 0 20px;padding:0 0 10px;}
</style>
</head>
    
<?php
    require_once("data/dconfig.php");
    require_once("lib/config.php");
    require_once("lib/fun_html.php");
    require_once './ifuser.php';
    include_once 'crypt/crypt.php';
    session_start();
    
    $table = "tf_users";
    
    $act=$_GET['act'];
    
    if($act==2)
    {
        //print_r($_POST);
        $password  = $_POST['password'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        
        if($password == $password1)
        {
            showmessage("新密码不能原密码一样！");
            location("modpassword.php?act=0");
        }
        $password = encrypt($password);
        $password1 = encrypt($password1);
        $uid = $_SESSION['uid'];
        $sql = "select username from ".$table." where password='".$password."' and uid=".$uid;
        $db = new MySql();
        $user = $db->getOne($sql);

        if($user['username']!=null)
        {
            
            
            $db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
            $sql = "update ".$table.' set password="'.$password1.'" where uid='.$uid;
            $ip = ip();
            $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$user[username]','$ip','update','$sql',now())";
         
            $r = $db->query($data_sql);
            //echo $sql;
            $res = $db->query($sql);
            
            if($res>0)
            {
                $db->query("COMMIT");
                showmessage("密码修改成功！");
                location("modpassword.php?act=0");
            }
            else
            {
                $db->query("ROLLBACK");
                showmessage("密码修改失败！");
                location("modpassword.php?act=0");
            }
            /*
            //print_r($user);
            $sql = "update ".$table." set password='".$password1."' where uid=".$uid;
            //echo $sql;
            $res = $db->query($sql);
            if($res>0)
            {
                showmessage("密码修改成功！");
                location("modpassword.php?act=0");
            }
            else
            {
                showmessage("密码修改失败！");
                location("modpassword.php?act=0");
            }
             */
        }
        else
        {
            showmessage("密码错误！"); 
            location("modpassword.php?act=0");
        }
    }
?>
    
<body>
<h1 class="main_tit">
<span></span>修改登录密码
</h1>
<div id="page_eems_1">
    <div id="main_eems_1_right">
        <div id="main_block1">
            <table width="100%%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <form class="form" action="modpassword.php?act=2" method="post"  id="form">
                        <table width="100%%" border="0" cellspacing="0" cellpadding="0" class="table_line1">
                            <tbody>
                            <tr>
                                <td width="25%" height="40" align="right">当前使用的密码</td>
                                <td width="5%" height="40" align="center" class="red105">*</td>
                                <td width="45%" height="40"><input name="password" type="password" datatype="*" class="form2" id="mm0" size="32" maxlength="32"></td>
                                <td width="25%" height="40">
                                    <div class="Validform_checktip">
                                        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%" height="40" align="right">新密码</td>
                                <td width="5%" height="40" align="center"><span class="red105">*</span></td>
                                <td width="45%" height="40"><input name="password1" type="password" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！" class="form2" id="mm1" size="32" maxlength="32"></td>
                                <td width="25%" height="40">
                                    <div class="Validform_checktip">
                                        密码范围在6~16位之间
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%" height="40" align="right">确认新密码</td>
                                <td width="5%" height="40" align="center"><span class="red105">*</span></td>
                                <td width="45%" height="40"><input name="password2" type="password" datatype="*" recheck="password1" errormsg="两次输入的密码不一致！" class="form2" id="mm2" size="32" maxlength="32"></td>
                                <td width="25%" height="40">
                                    <div class="Validform_checktip">
                                        两次输入密码要一致
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td height="40" align="right">&nbsp;</td>
                                <td height="40" align="center">&nbsp;</td>
                                <td height="40"><input type="submit" name="button" id="button" value="修改密码"></td>
                                <td height="40">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                      </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
 $(function() {
    $(".form").Validform({
        tiptype: 2
    });
 });
</script>
</html>

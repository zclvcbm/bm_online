<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<style type="text/css">
<!--
body {
	margin-left: 3px;
	margin-top: 0px;
	margin-right: 3px;
	margin-bottom: 0px;
}
.STYLE1 {
	color: #e1e2e3;
	font-size: 20px;
}
.STYLE6 {color: #000000; font-size: 16px; }
.STYLE10 {color: #000000; font-size: 16px; }
.STYLE19 {
	color: #344b50;
	font-size: 22px;
}
-->
</style>
<br/>
<table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="24" bgcolor="#353c44">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr align="center">
                                            <td width="94%" valign="bottom"><span class="STYLE1">找回密码</span></td>
                                        </tr>
                                    </table></td>
                                <td><div align="right"></div></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <form action="find_password_deal.php" method="POST" onSubmit="return checkform();">
            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
            	<tr>
                    <td width="50%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">注册邮箱：</span></div></td>
                    <td width="50%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><input type="email" id="email" name="email"></input></div></td> 
                </tr>
                <tr>
                    <td width="50%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">真实姓名：</span></div></td>
                    <td width="50%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><input type="text" id='name' name="name"></input></div></td> 
                </tr>
                <tr>
                    <td height="20" bgcolor="d3eaef" class="STYLE19"><div align="center"><input type="submit" name="sub" value="提交"></input></div></td>
                    <td height="20" bgcolor="#d3eaef" class="STYLE19"><div align="center"><input type="button" value="取消" onclick="window.location='index.php'"></input></div></td>
                </tr>
            </table>
            </form>
        </td>
    </tr>
    <script >
        function checkform()
        {
            var rname = document.getElementById('name');
            var mail = document.getElementById('email');
            var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
 
         
            if(mail.value=='')
            {
                    alert("邮箱不能为空!");
                    mail.focus();
                    return false;
            }
            if(!myreg.test(mail.value))
            {
                alert('提示\n\n请输入有效的E_mail！');
                mail.focus();
                return false;
            }
             
            if(rname.value=='')
            {
                    alert("真实姓名不能为空!");
                    pass.focus();
                    return false;
            }
        }
    </script>
</table>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>报名系统</title>
<meta name="keywords" content="报名系统">
<meta name="description" content="报名系统">
<link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">
<link media="screen" type="text/css" href="./css/layout.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/validform.css" rel="stylesheet">
<script type="text/javascript" src="./js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="./js/Validform_v5.3.2.js"></script>
</head>
    <body><a id="gotop" class="gotop" href="reg.php#" title="返回顶部" onfocus="this.blur()" onclick="window.scrollTo(0, 0);" style="display: none;"></a><a id="gotop" class="gotop" href="http://www.ddphp.cn/bm/reg.php#" title="返回顶部" onfocus="this.blur()" onclick="window.scrollTo(0, 0);" style="display: block;"></a>
        <!--Header-->
        <div class="header">
            <div class="header_inner">
                <h1 class="logo">
                    <a href=""><img alt="" src="./images/logo.png"></a>      
                </h1>
                <ul class="nav">
                </ul>
                <div class="search">
                </div>
                <ul class="menu">
                    <li><a href="login.php">登录</a></li>

                </ul>
            </div>
        </div>
        <!--/Header-->
        <div class="boxwrap">
            <div class="main_box">
                <h1 class="main_tit">
                    用户注册<strong>Register</strong>
                </h1>

                <div class="reg-box">
                    <div class="reg-top">
                        <ul class="step">

                            <li class="step1"><em>1</em>用户注册</li>
                            <li class="step2"><em>2</em>注册成功</li>

                        </ul>
                    </div>

                    <div class="reg-con">
                        <!--用户注册-->
                        <!-- <script type="text/javascript" src="html/register_validate.js"></script>-->
                        <form id="regform" class="regform" name="regform" action="reg_sub.php" method="POST">
                            <input type="hidden" name="tid" value="0">
                                <dl>
                                    <dt>
                                        <em>
                                            *
                                        </em>
                                        用户名：
                                    </dt>
                                    <dd>
                                        <input type="text" value="" name="username" class="span3"  class="inputxt" datatype="idcard" nullmsg="请填写身份证号码！" errormsg="您填写的身份证号码不对！">
                                    </dd>
                                    <dd>
                                        <div class="Validform_checktip">
                                            用户名必须使用<font color="red">身份证号</font>进行注册
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <em>
                                            *
                                        </em>
                                        姓&nbsp;&nbsp;&nbsp;名：
                                    </dt>
                                    <dd>
                                        <input type="text" value="" name="name" class="span3" datatype="s" errormsg="请填写真实身份证姓名！">
                                    </dd>
                                    <dd>
                                        <div class="Validform_checktip">
                                            考生姓名只能包含中文字符、不连续不在首尾的·号
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <em>
                                            *
                                        </em>
                                        密&nbsp;&nbsp;&nbsp;码：
                                    </dt>
                                    <dd>
                                        <input type="password" id="inputPassword" class="span3" name="password" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！">
                                    </dd>
                                    <dd>
                                        <div class="Validform_checktip">
                                            密码范围在6~16位之间
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <em>
                                            *
                                        </em>
                                        重复密码：
                                    </dt>
                                    <dd>
                                        <input type="password" id="inputPassword2" class="span3" name="password2" datatype="*" recheck="password" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！">
                                    </dd>
                                    <dd>
                                        <div class="Validform_checktip">
                                            两次输入密码需一致
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <em>
                                            *
                                        </em>
                                        Email：
                                    </dt>
                                    <dd>
                                        <input type="text" name="email" class="span3" placeholder="请输入电子邮件" errormsg="请填写正确格式的邮箱!" nullmsg="请填写邮箱!" datatype="e">
                                    </dd>
                                    <dd>
                                        <div class="Validform_checktip">
                                            格式：1001340@qq.com
                                        </div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <em>
                                        </em>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="token" value="<?php echo $token;?>"/>   
                                        <input id="btnSubmit" name="btnSubmit" type="submit" class="btn_submit" value="注 册">
                                    </dd>
                                    <a href="login.php">已经注册过了？</a>
                                </dl>

                        </form>
                        <!--用户注册-->
                    </div>


                </div>


                <div class="clear"></div>
            </div>
        </div>
        <script type="text/javascript">
        $(function() {
            $(".regform").Validform({
                tiptype: 2,
                datatype:{//传入自定义datatype类型【方式二】;
			"idcard":function(gets,obj,curform,datatype){
				//该方法由佚名网友提供;
			
				var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
				var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;
			
				if (gets.length == 18){   
					var a_idCard = gets.split("");// 得到身份证数组   
					if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {   
						return true;   
					}   
					return false;
				}
				return false;
				
				function isTrueValidateCodeBy18IdCard(a_idCard) {   
					var sum = 0; // 声明加权求和变量   
					if (a_idCard[17].toLowerCase() == 'x') {   
						a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作   
					}   
					for ( var i = 0; i < 17; i++) {   
						sum += Wi[i] * a_idCard[i];// 加权求和   
					}   
					valCodePosition = sum % 11;// 得到验证码所位置   
					if (a_idCard[17] == ValideCode[valCodePosition]) {   
						return true;   
					}
					return false;   
				}
				
				function isValidityBrithBy18IdCard(idCard18){   
					var year = idCard18.substring(6,10);   
					var month = idCard18.substring(10,12);   
					var day = idCard18.substring(12,14);   
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
					// 这里用getFullYear()获取年份，避免千年虫问题   
					if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
						return false;   
					}
					return true;   
				}
			}
                }
            });
        });
       $(function() {
            $(".regform").Validform({
                tiptype: 2,
                datatype:{//传入自定义datatype类型【方式二】;
			"s":function(gets,obj,curform,datatype){
				
				return isChina(gets);
				
	            function isChina(s) //判断字符是否是中文字符 
                  { 
                    var patrn= /[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/gi; 
                    if (!patrn.exec(s)) 
                    { 
                      return false; 
                    }else{ 
                   return true; 
                  } 
                 } 
			}
                }
            });
        });
        </script>
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
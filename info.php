<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0038)http://eems.hbsoft.net/user/ApplyInfo/ -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="./css/global.css" rel="stylesheet" type="text/css">
<link href="./css/eems1.css" rel="stylesheet" type="text/css">
<link href="./css/reset.css" rel="stylesheet" type="text/css">
<link href="./css/validform.css" rel="stylesheet">
<script type="text/javascript" src="./js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="./js/Validform_v5.3.2.js"></script>
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
        require_once 'lib/fun_html.php';
        require_once './ifuser.php';
        session_start();
        
        $uid = $_SESSION['uid'];
        
        $db = new MySql();
        $sql = "select * from tf_users where uid=$uid ";
        $user = $db->getOne($sql);
        
        $sub = $user['issub'];
        $act = $_GET['act'];
        if(!$act) $act=1;

    ?>
<body>
<h1 class="main_tit">
<span></span>填写/查看基本信息
</h1>
<div id="page_eems_1">
    <div id="main_eems_1_right">
        <div id="main_block1">
        <?php 
            
            if($act==1 && $sub==0) //填写信息页面
            {
                echo '<form action="info.php?act=3" method="post" class="form">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_line1">
                        <tbody>
                            <tr>
                                <td height="40" colspan="4" align="center"><span class="black105">基本信息状态：</span><span class="red105"><span class="blue105">尚未提交，请填写以下基础信息并提交。</span></span></td>
                            </tr>
                            <tr>
                                <td width="25%" height="40" align="right" class="black105">姓　　名</td>
                                <td width="5%" height="40" align="center" class="red105">*</td>
                                <td width="45%" height="40" class="black105">'.$user["name"].'</td>
                                <td width="25%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="25%" height="40" align="right" class="black105">性　　别</td>
                                <td width="5%" height="40" align="center" class="red105">*</td>
                                <td width="45%" height="40" class="black105">'.$user["sex"].'</td>
                                <td width="25%" height="40"><span class="red9"></span></td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">证件类型</td>
                              <td width="5%" height="40" align="center" class="red105">*</td>
                              <td width="45%" height="40" class="black105">身份证</td>
                              <td width="25%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">证件号码</td>
                              <td width="5%" height="40" align="center" class="red105">*</td>
                              <td width="45%" height="40" class="black105">'.$user['username'].'</td>
                              <td width="25%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">出生日期</span></td>
                              <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red105">*</span></td>
                              <td width="45%" height="50" class="black105">'.$user["age"].'</td>
                              <td width="25%" height="40">
                                <span class="red9"></span>
                                </td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">电子邮件</td>
                              <td width="5%" height="40" align="center" class="red105">*</td>
                              <td width="45%" height="40" class="black105">'.$user["email"].'</td>
                              <td width="25%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                                  <td width="25%" height="40" align="right" class="black105">民族</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105"><span class="apply_table_td3">
                                    <select name="folk" class="form2">
                                        <option value="汉族" selected="selected">汉族</option>
                                        <option value="满族">满族</option>
                                        <option value="藏族">藏族</option>
                                        <option value="怒族">怒族</option>
                                        <option value="仡佬族">仡佬族</option>
                                        <option value="朝鲜族">朝鲜族</option>
                                        <option value="撒拉族">撒拉族</option>
                                        <option value="东乡族">东乡族</option>
                                        <option value="白族">白族</option>
                                        <option value="羌族">羌族</option>
                                        <option value="壮族">壮族</option>
                                        <option value="阿昌族">阿昌族</option>
                                        <option value="珞巴族">珞巴族</option>
                                        <option value="塔吉克">塔吉克</option>
                                        <option value="景颇族">景颇族</option>
                                        <option value="侗族">侗族</option>
                                        <option value="畲族">畲族</option>
                                        <option value="回族">回族</option>
                                        <option value="保安族">保安族</option>
                                        <option value="毛南族">毛南族</option>
                                        <option value="塔塔尔">塔塔尔</option>
                                        <option value="德昂族">德昂族</option>
                                        <option value="京族">京族</option>
                                        <option value="水族">水族</option>
                                        <option value="独龙族">独龙族</option>
                                        <option value="布朗族">布朗族</option>
                                        <option value="仫佬族">仫佬族</option>
                                        <option value="土家族">土家族</option>
                                        <option value="赫哲族">赫哲族</option>
                                        <option value="黎族">黎族</option>
                                        <option value="土族">土族</option>
                                        <option value="鄂伦春">鄂伦春</option>
                                        <option value="基诺族">基诺族</option>
                                        <option value="门巴族">门巴族</option>
                                        <option value="锡伯族">锡伯族</option>
                                        <option value="维吾尔族">维吾尔族</option>
                                        <option value="佤族">佤族</option>
                                        <option value="俄罗斯">俄罗斯</option>
                                        <option value="拉祜族">拉祜族</option>
                                        <option value="蒙古族">蒙古族</option>
                                        <option value="裕固族">裕固族</option>
                                        <option value="乌孜别克">乌孜别克</option>
                                        <option value="傣族">傣族</option>
                                        <option value="瑶族">瑶族</option>
                                        <option value="鄂温克">鄂温克</option>
                                        <option value="布依族">布依族</option>
                                        <option value="纳西族">纳西族</option>
                                        <option value="哈尼族">哈尼族</option>
                                        <option value="柯尔克孜">柯尔克孜</option>
                                        <option value="苗族">苗族</option>
                                        <option value="彝族">彝族</option>
                                        <option value="高山族">高山族</option>
                                        <option value="傈僳族">傈僳族</option>
                                        <option value="普米族">普米族</option>
                                        <option value="哈萨克">哈萨克</option>
                                        <option value="达斡尔">达斡尔</option>
                                    </select>
                                  </span></td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                            <tr>
                              <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">班　　号</span></td>
                              <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red109">*</span></td>
                              <td width="45%" height="50" class="apply_table_td3">
                                <input name="classid" class="form2"  datatype="*"  type="text" id="classid" onblur="this.value=this.value.toUpperCase()">
                                </td>
                              <td width="25%" height="40">
                                <span class="red9">必填：使用现就读班级8位数班级号报名。学号为A开头的考生，去除学号末三位即为班级号，例：考生学号为A1011001001，则网上报考班级号为A1011001；学号为ZK开头的考生，在ZK前加C同时去除学号末三位即为班级号，例：考生学号为ZK08051001，则网上报考班级号为CZK08051；本校成教函授生使用学号去掉末三位即为班号；社会零散考生报名班级号为90000000；社会团体考生可自行编制无人使用的班级号后统一收缴费用</span>
                                </td>
                            </tr>
                            <tr>
                              <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">学　　号</span></td>
                              <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red105">*</span></td>
                              <td width="45%" height="50" class="apply_table_td3">
                                <input name="studentid" class="form2" type="text" id="studentid">
                                </td>
                              <td width="25%" height="40">
                                <span class="black9">选填</span>
                                </td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">最高学历</td>
                              <td width="5%" height="40" align="center" class="red105">*</td>
                              <td width="45%" height="40" class="black105"><span class="apply_table_td3">
                                <select name="zgxl" class="form2" id="zgxl">
                                  <option value="本科">本科</option>
                                  <option value="专科">专科</option>
                                  <option value="硕士研究生">硕士研究生</option>
                                  <option value="博士研究生">博士研究生</option>
                                  <option value="博士研究生以上">博士研究生以上</option>
                                  <option value="高中">高中/中专</option>
                                  <option value="其它">其它</option>
                                </select>
                              </span></td>
                              <td width="25%" height="40"><span class="red9">必填</span></td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">最高学位</td>
                              <td width="5%" height="40" align="center" class="red105">*</td>
                              <td width="45%" height="40" class="black105"><span class="apply_table_td3">
                                <select name="zgxw" class="form2" id="zgxw">
                                  <option value="学士">学士</option>
                                  <option value="硕士">硕士</option>
                                  <option value="博士">博士</option>
                                  <option value="其它">其它</option>
                                  <option value="无">无</option>
                                </select>
                              </span></td>
                              <td width="25%" height="40"><span class="red9">必填</span></td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">手机号码</td>
                              <td width="5%" height="40" align="center" class="red105">*</td>
                              <td width="45%" height="40" class="black105">
                                <input name="tel" type="text" class="form2" datatype="m" errormsg="请填写正确的手机号码！" error="手机号码不能为空！" value="" size="32" maxlength="11">
                              </td>
                              <td width="25%" height="40">
                                <div class="Validform_checktip">
                                    <span class="red9">必填</span>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">Q Q 号码</td>
                              <td width="5%" height="40" align="center" class="red105">&nbsp;</td>
                              <td width="45%" height="40" class="black105"><input name="qq" type="text" class="form2" id="qqhao" value="" size="32" maxlength="13"></td>
                              <td width="25%" height="40"><span class="black9">选填</span></td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">详细通信地址</td>
                              <td width="5%" height="40" align="center" class="red105">*</td>
                              <td width="45%" height="40" class="black105"><input name="address" type="text" class="form2" datatype="*" errormsg="通讯地址不能为空！" value="" size="32" maxlength="64"></td>
                              <td width="25%" height="40">
                                <div class="Validform_checktip">
                                    <span class="red9">必填</span>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">注意</td>
                              <td width="5%" height="40" align="center" class="red105">&nbsp;</td>
                              <td width="45%" height="40" class="red105">提交前请仔细检查以上填写是否<strong>完整</strong>与<strong>正确</strong></td>
                              <td width="25%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right" class="black105">&nbsp;</td>
                              <td width="5%" height="40" align="center" class="red105">&nbsp;</td>
                              <td width="45%" height="40"><input type="submit" name="button" id="button" value="填写完毕，保存基本信息"></td>
                              <td width="25%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="25%" height="40" align="right">&nbsp;</td>
                              <td width="5%" height="40">&nbsp;</td>
                              <td width="45%" height="40">&nbsp;</td>
                              <td width="25%" height="40" align="left">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    </form>';
            }
            elseif($act==1 && $sub==1) //展示
            {
                echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_line1">
                            <tbody>
                            <form action="info.php?act=3" method="post" class="form">
                                <tr>
                                    <td height="40" colspan="4" align="center"><span class="black105">基本信息状态：</span><span class="red105"><span class="blue105">已提交，可部分更改。</span></span></td>
                                </tr>
                                <tr>
                                    <td width="25%" height="40" align="right" class="black105">姓　　名</td>
                                    <td width="5%" height="40" align="center" class="red105">*</td>
                                    <td width="45%" height="40" class="black105">'.$user["name"].'</td>
                                    <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="25%" height="40" align="right" class="black105">性　　别</td>
                                    <td width="5%" height="40" align="center" class="red105">*</td>
                                    <td width="45%" height="40" class="black105">'.$user['sex'].'
                                    </td>
                                    <td width="25%" height="40"><span class="red9"><span class="red9"></span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">证件类型</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">身份证</td>
                                  <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">证件号码</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">'.$user['username'].'</td>
                                  <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">出生日期</span></td>
                                  <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red105">*</span></td>
                                  <td width="45%" height="50" class="black105">'.$user["age"].'</td>
                                  <td width="25%" height="40">
                                    <span class="red9"></span>
                                    </td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">电子邮件</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">'.$user["email"].'</td>
                                  <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">民族</span></td>
                                  <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red105">*</span></td>
                                  <td width="45%" height="50" class="black105">'.$user["folk"].'</td>
                                  <td width="25%" height="40">
                                    <span class="red9"></span>
                                    </td>
                                </tr>
                                <tr>
                                  <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">班　　号</span></td>
                                  <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red105">*</span></td>
                                  <td width="45%" height="50" class="black105">'.$user["classid"].'</td>
                                  <td width="25%" height="40">
                                    <span class="red9">必填:使用现就读班级8位数班级号报名。学号为A开头的考生，去除学号末三位即为班级号，例：考生学号为A1011001001，则网上报考班级号为A1011001；学号为ZK开头的考生，在ZK前加C同时去除学号末三位即为班级号，例：考生学号为ZK08051001，则网上报考班级号为CZK08051；本校成教函授生使用学号去掉末三位即为班号；社会零散考生报名班级号为90000000；社会团体考生可自行编制无人使用的班级号后统一收缴费用</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">学　　号</span></td>
                                  <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red105">*</span></td>
                                  <td width="45%" height="50" class="black105">'.$user["studentid"].'</td>
                                  <td width="25%" height="40">
                                    <span class="black9">选填</span>
                                    </td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">最高学历</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">'.$user["zgxl"].'</td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">最高学位</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">'.$user["zgxw"].'</td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">手机号码</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">'.$user["tel"].'</td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">Q Q 号码</td>
                                  <td width="5%" height="40" align="center" class="red105">&nbsp;</td>
                                  <td width="45%" height="40" class="black105">'.$user["qq"].'</td>
                                  <td width="25%" height="40"><span class="black9">选填</span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">详细通信地址</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">'.$user["address"].'</td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                                    <td width="25%" height="40" align="right" class="black105">最后修改时间</td>
                                    <td width="5%" height="40">&nbsp;</td>
                                    <td width="45%" height="40" class="black105">'.$user['modtime'].'</td>
                                    <td width="25%" height="40" align="left">&nbsp;</td>
                                 </tr>
                                <tr>
                                    <td width="25%" height="40" align="right">&nbsp;</td>
                                    <td width="5%" height="40">&nbsp;</td>
                                    <td width="45%" height="40"><a href="info.php?act=2" class="blue105">修改以上基本信息</a> <span class="black105">| <a href="centerlist.php" class="blue105">下一步：填写报考信息</a></span></td>
                                    <td width="25%" height="40" align="left">&nbsp;</td>
                                </tr>
                            </form>
                    </tbody>
                </table>';
            }
            elseif($act==2)
            {
                echo '<form action="info.php?act=3" method="post" class="form">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_line1">
                            <tbody>
                                <tr>
                                    <td height="40" colspan="4" align="center"><span class="black105">基本信息状态：</span><span class="red105"><span class="blue105">已提交，可部分更改。</span></span><span class="red9"><br>注意：修改基本信息后，已提交的报考信息不会随之更改。如希望修改报考信息，可在此次修改基本信息后重新提交报考信息。</span></td>
                                </tr>
                                <tr>
                                    <td width="25%" height="40" align="right" class="black105">姓　　名</td>
                                    <td width="5%" height="40" align="center" class="red105">*</td>
                                    <td width="45%" height="40" class="black105">'.$user["name"].'</td>
                                    <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="25%" height="40" align="right" class="black105">性　　别</td>
                                    <td width="5%" height="40" align="center" class="red105">*</td>
                                    <td width="45%" height="40" class="black105">'.$user['sex'].'</td>
                                    <td width="25%" height="40"><span class="red9"><span class="red9"></span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">证件类型</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">身份证</td>
                                  <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">证件号码</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">'.$user['username'].'</td>
                                  <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">出生日期</span></td>
                                  <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red105">*</span></td>
                                  <td width="45%" height="50" class="black105">'.$user["age"].'</td>
                                  <td width="25%" height="40">
                                    <span class="red9"></span>
                                    </td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">电子邮件</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">'.$user["email"].'</td>
                                  <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">民族</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105"><span class="apply_table_td3">
                                    <select name="folk" class="form2">
                                        <option value="'.$user['folk'].'">'.$user['folk'].'</option>
                                        <option value="汉族">汉族</option>
                                        <option value="满族">满族</option>
                                        <option value="藏族">藏族</option>
                                        <option value="怒族">怒族</option>
                                        <option value="仡佬族">仡佬族</option>
                                        <option value="朝鲜族">朝鲜族</option>
                                        <option value="撒拉族">撒拉族</option>
                                        <option value="东乡族">东乡族</option>
                                        <option value="白族">白族</option>
                                        <option value="羌族">羌族</option>
                                        <option value="壮族">壮族</option>
                                        <option value="阿昌族">阿昌族</option>
                                        <option value="珞巴族">珞巴族</option>
                                        <option value="塔吉克">塔吉克</option>
                                        <option value="景颇族">景颇族</option>
                                        <option value="侗族">侗族</option>
                                        <option value="畲族">畲族</option>
                                        <option value="回族">回族</option>
                                        <option value="保安族">保安族</option>
                                        <option value="毛南族">毛南族</option>
                                        <option value="塔塔尔">塔塔尔</option>
                                        <option value="德昂族">德昂族</option>
                                        <option value="京族">京族</option>
                                        <option value="水族">水族</option>
                                        <option value="独龙族">独龙族</option>
                                        <option value="布朗族">布朗族</option>
                                        <option value="仫佬族">仫佬族</option>
                                        <option value="土家族">土家族</option>
                                        <option value="赫哲族">赫哲族</option>
                                        <option value="黎族">黎族</option>
                                        <option value="土族">土族</option>
                                        <option value="鄂伦春">鄂伦春</option>
                                        <option value="基诺族">基诺族</option>
                                        <option value="门巴族">门巴族</option>
                                        <option value="锡伯族">锡伯族</option>
                                        <option value="维吾尔族">维吾尔族</option>
                                        <option value="佤族">佤族</option>
                                        <option value="俄罗斯">俄罗斯</option>
                                        <option value="拉祜族">拉祜族</option>
                                        <option value="蒙古族">蒙古族</option>
                                        <option value="裕固族">裕固族</option>
                                        <option value="乌孜别克">乌孜别克</option>
                                        <option value="傣族">傣族</option>
                                        <option value="瑶族">瑶族</option>
                                        <option value="鄂温克">鄂温克</option>
                                        <option value="布依族">布依族</option>
                                        <option value="纳西族">纳西族</option>
                                        <option value="哈尼族">哈尼族</option>
                                        <option value="柯尔克孜">柯尔克孜</option>
                                        <option value="苗族">苗族</option>
                                        <option value="彝族">彝族</option>
                                        <option value="高山族">高山族</option>
                                        <option value="傈僳族">傈僳族</option>
                                        <option value="普米族">普米族</option>
                                        <option value="哈萨克">哈萨克</option>
                                        <option value="达斡尔">达斡尔</option>
                                    </select>
                                  </span></td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                              <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">班　　号</span></td>
                              <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red109">*</span></td>
                              <td width="45%" height="50" class="apply_table_td3">
                                <input name="classid" class="form2"  datatype="*"  type="text" id="classid" value="'.$user["classid"].'" onblur="this.value=this.value.toUpperCase()">
                                </td>
                              <td width="25%" height="40">
                                <span class="red9">必填:使用现就读班级8位数班级号报名。学号为A开头的考生，去除学号末三位即为班级号，例：考生学号为A1011001001，则网上报考班级号为A1011001；学号为ZK开头的考生，在ZK前加C同时去除学号末三位即为班级号，例：考生学号为ZK08051001，则网上报考班级号为CZK08051；社会零散考生报名班级号为90000000；社会团体考生可自行编制无人使用的班级号后统一收缴费用</span>
                                </td>
                            </tr>
                            <tr>
                              <td width="25%" height="50" align="right" class="apply_table_td3"><span class="black105">学　　号</span></td>
                              <td width="5%" height="50" align="center" class="apply_table_td3"><span class="red105">*</span></td>
                              <td width="45%" height="50" class="apply_table_td3">
                                <input name="studentid" class="form2" type="text" id="studentid" value="'.$user["studentid"].'">
                                </td>
                              <td width="25%" height="40">
                                <span class="black9">选填</span>
                                </td>
                            </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">最高学历</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105"><span class="apply_table_td3">
                                    <select name="zgxl" class="form2" id="zgxl">
                                        <option value="'.$user['zgxl'].'">'.$user['zgxl'].'</option>
                                        <option value="本科">本科</option>
                                        <option value="专科">专科</option>
                                        <option value="硕士研究生">硕士研究生</option>
                                        <option value="博士研究生">博士研究生</option>
                                        <option value="博士研究生以上">博士研究生以上</option>
                                        <option value="高中">高中/中专</option>
                                        <option value="其它">其它</option>
                                     </select>
                                  </span></td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">最高学位</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105"><span class="apply_table_td3">
                                    <select name="zgxw" class="form2" id="zgxw">
                                        <option value="'.$user['zgxw'].'">'.$user['zgxw'].'</option>
                                        <option value="学士">学士</option>
                                        <option value="硕士">硕士</option>
                                        <option value="博士">博士</option>
                                        <option value="其它">其它</option>
                                        <option value="无">无</option>
                                    </select>
                                  </span></td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">手机号码</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105">
                                    <input name="tel" type="text" class="form2" datatype="m" errormsg="请填写正确的手机号码！" error="手机号码不能为空！" value="'.$user["tel"].'" size="32" maxlength="11">
                                  </td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">Q Q 号码</td>
                                  <td width="5%" height="40" align="center" class="red105">&nbsp;</td>
                                  <td width="45%" height="40" class="black105"><input name="qq" type="text" class="form2" value="'.$user["qq"].'" size="32" maxlength="13"></td>
                                  <td width="25%" height="40"><span class="black9">选填</span></td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">详细通信地址</td>
                                  <td width="5%" height="40" align="center" class="red105">*</td>
                                  <td width="45%" height="40" class="black105"><input name="address" type="text" class="form2" datatype="*" nullmsg="通讯地址不能为空！ " value="'.$user["address"].'" size="32" maxlength="64"></td>
                                  <td width="25%" height="40"><span class="red9">必填</span></td>
                                </tr>
                                <tr>
                                    <td width="25%" height="40" align="right" class="black105">注意</td>
                                    <td width="5%" height="40" align="center" class="red105">&nbsp;</td>
                                    <td width="45%" height="40" class="red105">提交前请仔细检查以上填写是否<strong>完整</strong>与<strong>正确</strong></td>
                                    <td width="25%" height="40">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td width="25%" height="40" align="right" class="black105">&nbsp;</td>
                                    <td width="5%" height="40" align="center" class="red105">&nbsp;</td>
                                    <td width="45%" height="40"><input type="submit" name="button" id="button" value="填写完毕，保存基本信息"></td>
                                    <td width="25%" height="40">&nbsp;</td>
                                  </tr>
                                <tr>
                                  <td width="25%" height="40" align="right">&nbsp;</td>
                                  <td width="5%" height="40">&nbsp;</td>
                                  <td width="45%" height="40">&nbsp;</td>
                                  <td width="25%" height="40" align="left">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>';
            }
            elseif($act==3)
            {
                $folk = $_POST['folk'];
                $zgxl = $_POST['zgxl'];
                $zgxw = $_POST['zgxw'];
                $tel = $_POST['tel'];
                $qq = str_replace(' ','',$_POST['qq']);
                $classid =  str_replace(' ','',$_POST['classid']);
                $studentid =  str_replace(' ','',trim($_POST['studentid']));
                $address =  str_replace(' ','',$_POST['address']);
   
                $sql = "update tf_users set zgxl='".$zgxl.
                        "' ,zgxw='".$zgxw.
                        "',folk='".$folk.
                        "' , tel='".$tel.
                        "' , qq='".$qq.
                        "' , classid='".$classid.
                        "' , studentid='".$studentid.
                        "' , address='".$address.
                        "', modtime=now() , issub=1 where uid=".$uid;
                //echo $sql;
                $sql = str_replace("'","\"",$sql);
                $ip = ip();
                $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[username]','$ip','update','$sql',now())";
                
                $db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
                $result = $db->query($sql);
                $db->query($data_sql);
                if($result>0)
                {
                    $db->query("COMMIT");
                    location("info.php");
                }else{
                    $db->query("ROLLBACK");
                }
            }
        ?>
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
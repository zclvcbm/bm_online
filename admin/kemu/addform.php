<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
//判断管理员是否登录
require_once '../ifadmin.php';
//设置工程相对路径
$root_path = "../../";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("$root_path/lib/fun_com.php");

//加载分页文件
require_once($root_path . "lib/db_page.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)http://www.ddphp.cn/bm/dadmin/user_edit.php?id=1607&action=edit -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../js/Validform_v5.3.2.js"></script>
<link href="../../css/validform.css" rel="stylesheet">
</head>
    <?php
    if ($_POST['submit'] == '添加') {
        if (!$_POST['fname']) {
            msg("表单名称不能为空");
        } else {
            $fname = trim($_POST['fname']);
            $fmsg = $_POST['fmsg'];
       
            $res = $db->getOne("select count(*) as c from tf_form where fname='".$fname."'");
     
            if($res['c']>0)
            {
                msg('添加失败，已经存在同名考试科目！');
            }
            else
            {
                $db->query("INSERT INTO tf_form (fname,fmsg,addtime) VALUES ('$fname', '$fmsg', unix_timestamp())");
                msg('添加完成', 'subok', 'kemu_list.php');
            }           
        }
    }
    ?>

    <body>
        <div class="main">
            <div class="content">
                <div class="title">新建考试科目</div>

            </div>
            <div class="list">
                <form name="fom" id="form" class="form" method="post" action="addform.php">
                    <table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
                        <tbody>
                            <tr>
                                <td class="tRight" width="150" rowspan="1">考试名称</td>
                                <td class="tLeft" id="StructureLeft2" ><input type="text" name="fname" datatype="*" errormsg="考试名称不能为空！" style="width:320px; height:26px"></input>
                                </td>
                                <td>
                                    <div class="Validform_checktip">
                                        考试名称不能为空！
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tRight" width="150">考试科目说明</td>
                                <td class="tLeft"><textarea cols="80" rows="10" name="fmsg"></textarea></td>
                                <td>
                                    <div class="Validform_checktip">
                                        选填
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class="center" colspan="3">
                                    <input type="submit" value="添加" name="submit" class="button small">
                                    <input type="reset" class="button small" onclick="" value="重 置">
                                    <input type="button" onclick="history.go(-1)" class="button small" name="reset" value="返 回" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
<script>
    $(function() {
        $(".form").Validform({
            tiptype: 2
        });
    });
</script>
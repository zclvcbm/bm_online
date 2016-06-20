
<?php
session_start();
error_reporting(0);
//note 加载MooPHP框架
require 'data/dconfig.php';
require_once 'admin/MooPHP/MooPHP.php';
//note:加载配置文件
require_once 'admin/MooPHP/MooConfig.php';
require_once './ifuser.php';
require_once 'lib/fun_html.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <SCRIPT LANGUAGE="JavaScript" src="./js/jquery.js"></SCRIPT>
        <SCRIPT LANGUAGE="JavaScript" src="./js/comm.js"></SCRIPT>
        <link href="./css/eems1.css" rel="stylesheet" type="text/css">
            <title><?= $f['fname'] ?></title>
            <style type="text/css">
                table tr{height: 30px}
            </style>
    </head>
    <body align="center">

        <?php
        session_start();
        if ($action == 'savecontent') {
            $user_sql = "select * from tf_users where uid=" . $_SESSION['uid'];
            $user = $db->getOne($user_sql);
            $bkjb = explode('|', $_POST['val0']);
            $pxlb = explode('|', $_POST['val1']);
            $bmh = $db->getOne("select max(bmh) max_bmh from form_" . $_POST['fid']); //取得报名表中id最大值
            if(empty($bmh['max_bmh']))
            {
                $bm_max = 420014000001;
            }
            else{
                $bm_max = $bmh['max_bmh'] + 1;
            }
          
            $sql1 = "select count(*) num from form_".$_POST['fid'];
            $c = $db->getOne($sql1);
            
            $sql2 = "select maxnum from tf_kkhb where fid=".$_POST['fid'];
            $re = $db->getOne($sql2);
            if($c['num']>=$re['maxnum'])
                msg('报名失败，报名人数已达上限！', "subok", "centerlist.php");
            $sql = "INSERT INTO form_" . $_POST['fid'] . "(";
            
            $count = count($_POST);
            $i = 0;
            for (; $i < $count - 3; $i++)
                $sql .= "val$i, ";
            $sql .= "val$i,bmsj,sfzh,bmh,kskm,pxkm,ksfy,pxfy";
            $sql .=") values(";
            $i = 0;
            for (; $i < $count - 3; $i++)
                $sql .= "'" . $_POST['val' . $i] . "', ";
            $sql .= "'" . $_POST['val' . $i] . "',now(),'" . $user[username] . "','" . $bm_max . "','" . $bkjb[0] . "','" . $pxlb[0] . "',$bkjb[2],$pxlb[2])";
       
            $titleList = $db->getAll("SELECT title,ismust FROM tf_form_type WHERE fid=".escapeshellarg($fid)." ORDER BY orderid,id ASC");
            foreach ($titleList AS $k => $t) {
                if ($titleList[$k]['ismust']) {
                    checkMust($content[$k], $titleList[$k]['ismust']);
                }
                $title[] = $t['title'];
            }
            
            $result = $db->query($sql);
            if ($result > 0)
                msg('信息已提交！', "subok", "signuplist.php");
            else
                msg('信息提交失败！');
        } else {

            $user_sql = "select * from tf_users where uid=" . $_SESSION['uid'];
            $user = $db->getOne($user_sql);
  
            if ($user['issub'] == 0) {
                showmessage_go("请先填写基本信息！");
            } else {
                if ($user['stat'] == 0) {
                    showmessage_go("您提交的基本信息还在审核中……");
                } else if ($user['stat'] == 2) {
                    showmessage_go("Sorry！您提交的基本信息未能通过审核！");
                }
            }
            $f = $db->getOne("SELECT * FROM tf_form WHERE fid='$fid' AND display='1'");
            if (!$f)
                exit;   
            $formList = $db->getAll("SELECT * FROM tf_form_type WHERE fid='$fid' ORDER BY orderid,id ASC");
            $fmsg = str_replace("\r\n", "<br />", $f['fmsg']);
            $option = '<h2 style="margin-top: 10px; margin-bottom: 10px;">' . $f['fname'] . '</h2>';
            $option .= '<div align="center" class="h5">' . $fmsg . '<br/></div>';
            echo $option;

            $option = '<div class="table_line1">' . showForm('formhead', '?action=savecontent');
            $option .= '<input type="hidden" name="fid" value="' . $fid . '" />';
            $option .= '<table width="100%" align="center" >';
            $option .='<tr>
                                <td width="20%" height="40" align="right" class="black105">姓　　名</td>
                                <td align="left" style="padding-left:20px;">' . $user["name"] . '</td>
                                <td width="30%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="20%" height="40" align="right" class="black105">性　　别</td>
                                <td align="left" style="padding-left:20px;">
                                    ' .$user["sex"]. '
                                </td>
                                <td width="30%" height="40"><span class="red9"></td>
                            </tr>
                            <tr>
                              <td width="20%" height="40" align="right" class="black105">证件类型</td>
                              
                              <td align="left" style="padding-left:20px;">身份证</td>
                              <td width="30%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="20%" height="40" align="right" class="black105">证件号码</td>
                              <td align="left" style="padding-left:20px;">' . $user['username'] . '</td>
                              <td width="30%" height="40">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="20%" height="40" align="right" class="black105">电子邮件</td>
                              <td align="left" style="padding-left:20px;">' . $user['email'] . '</td>
                              <td width="30%" height="40">&nbsp;</td>
                            </tr>';
            foreach ($formList AS $k => $form) {

                $k = (!$k) ? 0 : $k++;
                if($form['ismust']==1 && $form['msg']=="")
                    $form['msg']="必填";
                $option .= showForm($form['type'], $form['title'], $form['options'], $form['defaultvalue'], $form['msg'], $k, $form['ismust']);
            }

            $option .= showForm('submit', 'submitcontent');
            $option .= '</table></div>';
            echo $option;
        }
        ?>
    </body>
</html>

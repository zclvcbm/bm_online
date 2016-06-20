
<?php
error_reporting(0);
session_start();
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
          
            $qt = explode('|', $_POST['val2']);
            
            $bmh = $db->getOne("select max(bmh) max_bmh from form_" . $_POST['fid']); //取得报名表中id最大值
            if(empty($bmh['max_bmh']))
            {
                $bm_max = 420014000001;
            }
            else{
                $bm_max = $bmh['max_bmh'] + 1;
            }
            
            $count = count($_POST);
       
            $sql = "INSERT INTO form_" . $_POST['fid'] . "(";
            $i = 0;

            for (; $i < $count - 3; $i++)
                $sql .= "val$i, ";
 
            $sql .= "val$i,bmsj,sfzh,bmh,kskm,pxkm,ksfy,pxfy,qtfy";
            $sql .=") values(";
            $i = 0;
 
            for (; $i < $count - 2; $i++)
            {
                if(is_array($_POST['val'.$i]))
                {
                    foreach ($_POST['val'.$i] as $v) {
                        $strs .= str_replace("\r\n","",$v)."|";
                    }
                    $sql .= "'".$strs."',";
                } 
                else
                    $sql .= "'" .$_POST['val'.$i]. "', ";
            }
            $sql .= " now(),'" . $user[username] . "','" . $bm_max . "','" . $bkjb[0] . "','" . $pxlb[0] . "',$bkjb[2],$pxlb[2],$qt[1])";
            $ip = ip();
            $sql = str_replace("'","\"",$sql); 
            $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[username]','$ip','insert','$sql',now())";
            
             $sqlgz = "select * from form_" . $_POST['fid']."  where sfzh='". $user[username]."' and kskm='".trim($bkjb[0])."'";
             $recordgz = $db->getOne($sqlgz);
             if($recordgz['sfzh']!='')
             {
               msg('您已经报过名了！');
             }
             else
             {  
                //附件上传
                {
            //	$fileType=array('application/octet-stream','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/x-zip-compressed','application/pdf','application/msword');//允许上传的文件类型 
                    $num = count($_FILES['files']['name']);   //计算上传文件的个数

                    for ($i = 0; $i < $num; $i++) {
                        $_FILES['files']['tmp_name'][$i] = str_replace('\\\\\\\\', '\\', $_FILES['files']['tmp_name'][$i]);
                        //echo $_FILES['files']['tmp_name'][$i];
                        //echo is_uploaded_file($_FILES['files']['tmp_name'][$i]);
                        if ($_FILES['files']['name'][$i] != '' && is_uploaded_file($_FILES['files']['tmp_name'][$i])) {
            //			    if(in_array($_FILES['files']['type'][$i],$fileType))//判断文件是否是允许的类型
            //			    {

                            $rand = md5(time() . mt_rand(0,1000));
                            $type = substr(strrchr($_FILES['files']['name'][$i], '.'), 1);
                            $fname = 'upfile/' . $_POST['fid'] . '_' .$_SESSION['username'] . '_' . $rand.$_FILES[''].".".$type;
                            //echo $fname;
                            move_uploaded_file($_FILES['files']['tmp_name'][$i], $fname);
                            $sql_fj = "insert into form_fj(fid,username,filename,nfilename,uploadtime) values
                                (".$_POST['fid'].",'".$_SESSION['username']."','".$_FILES['files']['name'][$i]."','".$fname."',now())";
                            echo $sql_fj;
                            ;
                            mysql_query($sql_fj);
                            echo '<br/>文件上传成功！';
            //			    }else
            //			    {
            //				     echo '<br/>不允许上传该文件类型'; 
            //			    }
                        } else {
                            echo '<br/>没有上传文件';
                        }
                    }
                } 
                
                
                $result = $db->query($sql);
                $r = $db->query($data_sql);
                if ($result > 0)
                {
                        $db->query("COMMIT");
                        msg('信息已提交！', "subok", "signuplist.php");
                   
                }
                else
                {
                        $db->query("COMMIT");
                        msg('信息提交失败！');
                   
                }
            }

        } else {

            $user_sql = "select * from tf_users where uid=" . $_SESSION['uid'];
            $user = $db->getOne($user_sql);
            //print_r($user);
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
//                print_r($form);
                $k = (!$k) ? 0 : $k++;
                if($form['ismust']==1 && $form['msg']=="")
                    $form['msg']="必填";
                $option .= showForm($form['type'], $form['title'], $form['options'], $form['defaultvalue'], $form['msg'], $k, $form['ismust']);
            }
            $option .= '<tr>
                            <td width="20%" height="40" align="right" class="black105">附件1：</td>
                            <td align="left" style="padding-left:20px;"><input name="files[]" type="file" id="fileField" size="36" maxlength="128"></td>
                            <td width="30%" height="40">&nbsp;</td>
                        </tr>';
            $option .= '<tr>
                            <td width="20%" height="40" align="right" class="black105">附件2：</td>
                            <td align="left" style="padding-left:20px;"><input name="files[]" type="file" id="fileField" size="36" maxlength="128"></td>
                            <td width="30%" height="40">&nbsp;</td>
                        </tr>';
            $option .= '<tr>
                            <td width="20%" height="40" align="right" class="black105">附件3：</td>
                            <td align="left" style="padding-left:20px;"><input name="files[]" type="file" id="fileField" size="36" maxlength="128"></td>
                            <td width="30%" height="40">&nbsp;</td>
                        </tr>';
            $option .= showForm('submit', 'submitcontent');
            $option .= '</table><br>报名成功后，如产生退费事件，按<< <a href=http://210.42.38.102/a/bumengaikuang/banshizhinan/2014/0618/270.html target="_new">三峡大学继续教育学院培训及考试退费管理办法（暂行）>> </a>执行。</div>';
            echo $option;
        }
        ?>
    </body>
</html>

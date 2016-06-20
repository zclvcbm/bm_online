<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="../table.js"></script>
<?php
//设置工程相对路径
$root_path="../../";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("$root_path/lib/fun_com.php");

require_once("../ifadmin.php");
//加载分页文件

//print_r($_GET);
$fid = $_REQUEST['fid'];
$idstr = $_REQUEST['id'];
$fy = $_REQUEST['fy'];
$idstr = substr($idstr, 0, strlen($idstr)-1);
$ids = explode(',', $idstr);
//print_r($ids);
$db=new MySql();


$sql_jfdh = "SELECT max(CAST(jfdh AS signed)) FROM `tf_classname` where kskm = $fid";//找出当前科目被确认了多少班
$result_jfdh=$db->getArray($sql_jfdh);
//echo "aaaa".$result_jfdh['max(CAST(jfdh AS signed))'];
$max_jfdh = $result_jfdh[0][0];
$max_jfdh ++;


?>

<table width="630" height="277" border="0" align="center" cellpadding="0"  cellspacing="0" bordercolor="#003366" bgcolor="#FFFFFF">
        <tr><td valign="top" align=left>
                <table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                        <td align="center" height="30">您选中的学生列表如下：</b></td>
                    </tr>
                    <tr>
                        <td align="left"><br>
                        </td>
                    </tr>
                </table>

                <table width="700" border="1" cellspacing="0" cellpadding="0"  bordercolor="#B8DDED" align="center">

                    <tr align="center" valign=middle style="height:25px;"> 
                        <td ><font color="#000000">序号</font></td>
                        <td  ><font color="#000000">身份证号</td>
                        <td  ><font color="#000000">姓名</font></td>
                        <td width="100" ><font color="#000000">考试项目</font></td>
                        <td  ><font color="#000000">考试费用</font></td>
                        <td  ><font color="#000000">培训费用</font></td>
                        <td  ><font color="#000000">其它费用</font></td>
                        <td  ><font color="#000000">总费用</font></td>
                        <td  ><font color="#000000">联系电话</font></td>
                    </tr>
                    <?php
                        $i=1;
                        $classes = array();
                        foreach ($ids as $key => $id) {
                            $sql = "select u.username,u.classid,u.name,u.tel,f.val2,f.qtfy,f.pxfy,f.ksfy,f.kskm,f.sfzh from form_".$fid." f left join tf_users u on sfzh=username where f.id = ".$id;
                            //echo $sql."<br/>";
                            
                            $result=$db->getArray($sql);
                            //echo count($result);
                            $item = $result[0];
                            //foreach ($result as $key => $item) {
                                $hjksfy += $item['ksfy']; 
                                $hjpxfy += $item['pxfy'];
                                $hjqtfy += $item['qtfy'];
                                
                                if(!in_array($item['classid'], $classes) && !empty($item['classid']))
                                {
                                    $classes[] = $item['classid'];
                                }

                                
                            //}
                            
                            
                    ?>  
                    <tr height="20" align="center">
                        <td width="5%"><?=$i?></td>
                        <td width="15%"><?=$item['sfzh']?></td> 
                        <td width="8%"><?=$item['name']?></td>
                        <td width="20%"><?=$item['kskm']?></td>
                        <td width="8%"><?=$item['ksfy']?></td>
                        <td width="8%"><?=$item['pxfy']?></td>
                        <td width="8%"><?=$item['val2'];?></td>
                        <td width="8%"><?php echo $item['ksfy']+$item['pxfy']+$item['qtfy'];?></td>
                        <td width="15%"><?=$item['tel']; ?></td>
                    </tr>
                    <?php
                            $i++;

                        }
                            $len = count($classes);
                            $flag = $len-1;
                                //die();
                                if($flag>=1)
                                {
                                    echo "<script>alert('您选中了多个不同班级！'); window.location.href='baoming_list.php'; </script>";
                                }
                        $hjzfy = $hjksfy+$hjpxfy+$hjqtfy;
                        $clas = implode(' , ', $classes);
                    ?>
                    <tr align="center" bgcolor="#ffffff"> 
                        <td colspan="7">合计</td>
                        <td align="center"><?=$hjzfy?></td>
                        <td  colspan=3>&nbsp;</td>
                    </tr>
                </table>
                <table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                        <td align="left" height="30"><b>您选中的班级为：</b>
                        
                            <?php
                                echo $clas;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left"><br>
                        </td>
                    </tr>
                </table>

                <table>
                    <form action="baoming_deal_all.php" method="post" name="form1" onsubmit="return check(this)" >
                        <tr><td>请输入缴费单号：<input name="jfdh" value="<?php echo $max_jfdh; ?>"></input></td></tr>
                        <tr>
                            <td>
                                <input name="id" type="hidden" value="<?=$idstr?>"></input>
                                <input name="fid" type="hidden" value="<?=$fid?>"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="seach" value="确定" class="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" name="edit" value="取消" onClick="location.href='baoming_list.php'" class="button"/>
                            
                            </td>
                        </tr>
                    </form>
                </table>
        </tr> 
    </table>
<script>
    function check(f){
        if( f.jfdh.value == '' )
        {
            alert('缴费单号不能为空！');
            return false;
        }
    }
</script>

<?php
    error_reporting(0);
    session_start();
    
    $fid = $_GET['fid'];
    $elements = $_GET['elements'];
    echo $elements;
    //设置工程相对路径
    $root_path="../../";
    require_once("$root_path/data/dconfig.php");
    require_once("$root_path/lib/config.php");
    require_once("$root_path/lib/fun_com.php");
    require_once("../ifadmin.php");

    //bmh,val0,val1,classid,studentid,tel,checked,jfzt,shzt,name
    //$s = "SELECT bmb,val0,val1,classid,studentid,tel,checked,jfzt,shzt,name from form_4 a left join tf_users b on a.sfzh=b.username order by a.id desc";
    $sql = "SELECT ".$elements." from form_".intval($fid)." a left join tf_users b on a.sfzh=b.username order by a.id desc";
/*    echo $s;
    die();
    $sql="select *,a.id bid from form_".intval($_GET['fid'])." a left join tf_users  b on  a.sfzh=b.username order by a.id desc";
 */   
    $db=new MySql();
    
    $db->query($sql);
    
    header("Content-type:application/vnd.ms-excel");

    header("Content-Disposition:attachment;filename=baoming_data.xls");
    
?>
<style type="text/css">
    td {
        border:1px solid black;
    }
</style>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%" height="40" valign="bottom" colspan="10" align="center"><span ><font size="5">考生报名信息列表</font></span></td>
                </tr>
            </table>
        </td>
    </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
      <tr>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">报名号</span></div></td>
	<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">报考级别</span></div></td>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">培训类别</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">班级</span></div></td>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">学号</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">姓名</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">手机</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">报名日期</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">缴费状态</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">审核状态</span></div></td>
      </tr>
      <?php
     while($db->next_record())
     {
			$bkjb = explode('|', $db->f(val0));
            $pxlb = explode('|', $db->f(val1));
     ?>
      <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo "'".substr($db->f("bmh"),0,12)?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $bkjb[0];?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $pxlb[0];?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("classid")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("studentid")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("name")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("tel")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("bmsj")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php if($db->f("jfzt")==1) echo "已缴费"; elseif(empty ($db->f("jfzt"))) echo ""; else echo "未缴费";?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php if($db->f("shzt")===1) echo "审核通过";elseif($db->f("shzt")===0) echo "未审核"; elseif(empty($db->f("shzt"))) echo ""; else echo "审核未通过";?></div></td>
        </tr>
    <?php
    }
    ?>
    </table></td>
  </tr>
</table>

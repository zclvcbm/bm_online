<?php
    error_reporting(0);

    session_start();
    
    //设置工程相对路径
    $root_path="../../";
    require_once("$root_path/data/dconfig.php");
    require_once("$root_path/lib/config.php");
    require_once("$root_path/lib/fun_com.php");
    require_once("../ifadmin.php");

    $fid = $_GET['fid'];
    if(empty($fid))
        $sql="select p.*,u.studentid,u.classid,u.name,u.email,u.sex,u.age,u.tel,u.qq,u.address from tf_paylist p  left join tf_users u on p.sfzh=u.username where sfzh like '%".$_REQUEST['sfzh']."%'";
    else
        $sql="select p.*,u.studentid,u.classid,u.name,u.email,u.sex,u.age,u.tel,u.qq,u.address from tf_paylist p  left join tf_users u on p.sfzh=u.username where sfzh like '%".$_REQUEST['sfzh']."%'"." and sfzh IN (select sfzh from form_".$fid.")";
    $db=new MySql();
    
    $db->query($sql);
    
    header("Content-type:application/vnd.ms-excel");

    header("Content-Disposition:attachment;filename=paylist_data.xls");
    
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
                    <td width="100%" height="40" valign="bottom" colspan="8" align="center"><span ><font size="5">考生报名信息列表</font></span></td>
                </tr>
            </table>
        </td>
    </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
      <tr>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">报名号</span></div></td>
	    <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">身份证号</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">姓名</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">性别</span></div></td>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">交易事项</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">交易流水号</span></div></td>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">总金额</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">付款日期</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">付款方式</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">邮件</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">班号</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">学号</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">电话</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">qq</span></div></td>
      </tr>
      <?php
        while($db->next_record())
        {
            //print_r($db);
     ?>
      <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("applyid");?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo "'".$db->f("sfzh");?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("name");?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("sex");?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("transaction");?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("serialnumber")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("money")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("paytime")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("paymethod")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("email")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("studentid")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("classid")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("tel")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("qq")?></div></td>
      </tr>
    <?php
    }
    ?>
    </table></td>
  </tr>
</table>

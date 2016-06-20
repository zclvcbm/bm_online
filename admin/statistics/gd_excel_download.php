<?php
    error_reporting(0);

    session_start();
    
    //设置工程相对路径
    $root_path="../../";
    require_once("$root_path/data/dconfig.php");
    require_once("$root_path/lib/config.php");
    require_once("$root_path/lib/fun_com.php");
    require_once("../ifadmin.php");

    $sql="select * from tf_guidang";
    
    $db=new MySql();
    
    $db->query($sql);
    
    header("Content-type:application/vnd.ms-excel");

    header("Content-Disposition:attachment;filename=guidang_data.xls");
    
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
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">考试科目</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">年份</span></div></td>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">次数</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">报考级别</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">姓名</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">身份证号</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">班号</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">学号</span></div></td>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">联系电话</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">准考证号</span></div></td>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">证书编号</span></div></td>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">成绩一</span></div></td>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">成绩二</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">成绩三</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">成绩四</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">成绩状态</span></div></td>
      </tr>
      <?php
     while($db->next_record())
     {
     ?>
      <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("kskm")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("year")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("counts")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("bkjb")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("name")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("sfzh")."'"?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("classid")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("studentid")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("lxdh")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("zkzh")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("zsbh")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("cj1")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("cj2")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("cj3")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("cj4")?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $db->f("cj_stats")?></div></td>
            
            
        </tr>
    <?php
    }
    ?>
    </table></td>
  </tr>
</table>

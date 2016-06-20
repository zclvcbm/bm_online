<?php
    error_reporting(0);

    session_start();
    
    //设置工程相对路径
    $root_path="../../";
    require_once("$root_path/data/dconfig.php");
    require_once("$root_path/lib/config.php");
    require_once("$root_path/lib/fun_com.php");
    require_once("../ifadmin.php");

    //表名
    $table="tf_kkhb";

    $sql="SELECT k.*,f.fname FROM ".$table." k,tf_form f where k.fid=f.fid order by id desc";
    
    $db=new MySql();
    
    $result = $db->query($sql);
    
    header("Content-type:application/vnd.ms-excel");

    header("Content-Disposition:attachment;filename=export_data.xls");
    
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
                    <td width="100%" height="40" valign="bottom" colspan="9" align="center"><span ><font size="5">考试科目信息列表</font></span></td>
                </tr>
            </table>
        </td>
    </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
      <tr>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">序号</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">考试科目</span></div></td>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">年份</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">次数</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">最大报名人数</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">报名开始日期</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">报名截止日期</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">缴费开始日期</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">缴费截止日期</span></div></td>
      </tr>
      <?php
      $i=1;
     while($data = mysql_fetch_array($result))
     {
     ?>
      <tr>
            <td bgcolor="#FFFFFF" ><div align="center"><?php echo $i++;?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['fname'];?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['yyyy']; ?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['counts'];?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['maxnum'];?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['start_time']; ?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['end_time']; ?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['subs_time']; ?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['sube_time'];?></div></td>
        </tr>
    <?php
    }
    ?>
    </table></td>
  </tr>
</table>

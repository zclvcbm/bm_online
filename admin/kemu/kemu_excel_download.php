<?php
    error_reporting(0);

    session_start();
    
    //设置工程相对路径
    $root_path="../";
    require_once("$root_path/data/dconfig.php");
    require_once("$root_path/lib/config.php");
    require_once("$root_path/lib/fun_com.php");

    //表名
    $table="tf_form";

    $sql="SELECT * FROM ".$table." order by fid desc";
    
    $db=new MySql();
    
    $result = $db->query($sql);
    
    header("Content-type:application/vnd.ms-excel");

    header("Content-Disposition:attachment;filename=kemu_data.xls");
    
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
                    <td width="100%" height="40" valign="bottom" colspan="4" align="center"><span ><font size="5">考试科目信息列表</font></span></td>
                </tr>
            </table>
        </td>
    </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
      <tr>
        <td width="2%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">序号</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">考试科目名称</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">考试科目说明</span></div></td>
        <td width="8%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">科目添加日期</span></div></td>
      </tr>
      <?php
      $i=1;
     while($data = mysql_fetch_array($result))
     {
     ?>
      <tr>
            <td bgcolor="#FFFFFF" ><div align="center"><?php echo $i++;?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['fname'];?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $data['fmsg'];?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo date('Y-m-d',$data['addtime']); ?></div></td>
        </tr>
    <?php
    }
    ?>
    </table></td>
  </tr>
</table>

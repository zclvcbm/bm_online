<?php
//设置工程相对路径
$root_path="../..";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
if(file_exists("$root_path/data/alipayconfig.php")){	  
    require_once("$root_path/data/alipayconfig.php");
}
require_once("../ifadmin.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css" />
</head>
<body >

<div class="main" >
<div class="content" >
<div class="title">支付宝配置</div>

</div>
<div class="list">
<form id="form1" name="form1" method="post"action="alipay.php">
<table cellpadding=0 cellspacing=0 width=100% class="role_table" >
<tr>
	<td class="tRight" width="160" >支付宝是否开启：</td>
<td  class="tLeft" > <input name="payok" type="text" size="50" value="<?php echo $payok ?>"/></td>
</tr>
<tr>
	<td class="tRight" width="160">合作身份者ID</td>
	<td  class="tLeft" > <input type="text" name="partner" size="50"  value="<?php echo $partner?>"/> </td>
</tr>
<tr>
	<td class="tRight" width="160">安全检验码</td>
	<td  class="tLeft" > <input name="key" type="text" size="50" value="<?php echo $key?>"/> </td>
</tr>
<tr>
	<td class="tRight" width="160">签约支付宝账号或支付宝帐户</td>
	<td  class="tLeft" > <input type="text" name="seller_email"  size="50"  value="<?php echo $seller_email?>"/> </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
    <input name="mod" type="hidden" value="1" />
	<input type="submit" value="保 存"  name="submit" class="button small">  </td>
</tr>
</table>

</form>
</div>
</div>
</body>

</html>
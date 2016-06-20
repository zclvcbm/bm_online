<?php
@session_start();
$admin = @$_SESSION['admin'];

$relativepath=$_SERVER['PHP_SELF'];
$relativepath=substr($relativepath,0,strpos($relativepath,"admin"));
$basepath='http://'.$_SERVER['HTTP_HOST'];
$url=$basepath.$relativepath."admin/login.php";

if ($admin == "") {
    echo "<script>top.location.href='$url';</script>";
    exit;
}

require_once('waf.php');
?>











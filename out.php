<?php
@session_start();
$_SESSION['username']="";
$_SESSION['uid']="";
$_SESSION['id']="";
echo "<script>window.location.href='./login.php';</script>";
?>
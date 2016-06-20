<?php

@session_start();
$user = @$_SESSION['uid'];
if ($user == "") {
    echo "<script>top.location.href='login.php';</script>";
    exit;
}
require_once('waf/waf.php');
require_once 'lib/fun_html.php';
?>
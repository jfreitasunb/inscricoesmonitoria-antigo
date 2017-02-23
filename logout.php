<?php
require_once "config/init.php";
require_once 'HTTP2.php';
$http = new HTTP2();
session_unset();
session_destroy();
// echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
$http->redirect("index.php");
?>
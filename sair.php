<?php
session_cache_expire(180000);
session_start();
$_SESSION['logged'] = false;
session_destroy();
header('Location: login.php');
?>
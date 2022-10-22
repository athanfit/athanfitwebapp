<?php
session_start();
$title = "Password reset";
include '../includes/head.php';
include '../includes/navbar.php';
$Token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $Token;
//the get parameters:
$userID = $_GET['ID'];
$hash = $_GET['h'];
echo $userID."<br>";
echo $hash;
?>

<?php
include '../includes/foot.php';
?>
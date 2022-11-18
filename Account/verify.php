<?php
session_start();
$title = "Verify email";
require '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
//the get parameters:
$userID = $_GET['ID'];
$userIDsession = $_GET['ID'];
$hash = $_GET['h'];
$today = date("Y-m-d");
if (isset($_SESSION['ID'])   &&
    isset($_SESSION['email'])) 
{
    exit;
}
if ($userID != $_SESSION['ID'])
{
    exit;
}
$sql = "UPDATE `Verify` SET `Hash`=? , `Date`=?  WHERE UserID=?"; // SQL with parameters
$stmt = $mysqli->prepare($sql); 
$stmt->bind_param("sss", $hash, $today, $userID);
$stmt->execute();
$mysqli->close();
include '../includes/foot.php';
?>
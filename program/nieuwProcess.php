<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$today = date("Y-m-d");
if (isset($_SERVER["HTTP_REFERER"])     && $_SERVER["HTTP_REFERER"] == "https://train.4260.nl/program/nieuw.php")
{
    if (!empty($_POST['csrfToken'])){
        if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) 
        {
            echo "werkt";
        } else {
            ?><script>console.log("token not right");</script><?php
        }
    } else {
        ?><script>console.log("token missing");</script><?php
    }
} else {
    ?><script>console.log("not from right page");</script><?php
}
?>
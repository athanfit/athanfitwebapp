<?php
session_start();
$title = "Password reset";
include '../includes/head.php';
include '../includes/navbar.php';
require '../includes/config.php';
$today = date("Y-m-d");
//the get parameters:
$userID = $_GET['ID']; 
$hash = $_GET['h'];
if (isset($_SERVER["HTTP_REFERER"])     && $_SERVER["HTTP_REFERER"] == "https://train.4260.nl/password/reset.php?ID=$userID&h=$hash") 
    {
        if (!empty($_POST['Password'])     &&
            !empty($_POST["csrfToken"])) 
        {
            if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) {
                echo "all good";
            } else {
                ?><script>console.log("Token is not right.");</script><?php
            }
        } else {
            ?><script>console.log("Not all is filled in.");</script><?php
        }
    } else {
        ?><script>console.log("Not from right page.");</script><?php
    }

?>
<?php
include '../includes/foot.php';
?>
<?php
session_start();
$title = "Verify email";
require '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
//the get parameters:
$userID = $_GET['ID'];
$userIDsession = $_GET['ID'];
$email = $_SESSION['email'];
$hash = $_GET['h'];
$today = date("Y-m-d");
if (!isset($_SESSION['ID'])   &&
    !isset($_SESSION['email'])) 
{
    echo "Something gone wrong.";
    exit();
}
if ($userID != $_SESSION['ID'])
{
    echo "Something gone wrong.";
    exit;
}
$sql = "UPDATE `Verify` SET `Hash`=? , `Date`=?  WHERE UserID=?"; // SQL with parameters
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param('sss', $hash, $today, $userID);
    if ($stmt->execute()) {
        ?><script>console.log("Done, data to DB");</script><?php
        //header("location:./");
        ?>
        <div class="container">
            <div class="col-sm-7 smallcard">
                <div class="card">
                    <h5 class="card-header">Verify link</h5>
                    <div class="card-body">
                        <h5 class="card-title">New verify link has been requested</h5>
                        <p class="card-text">You will recieve a mail to verify so we know it is yours.</p>
                        <a href="./" class="card-link">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $to = $email;
        $subject = "Verify - 4260train";
        $message = '
        <!DOCTYPE html>
        <html>
        <head>
        <style>
        </style>
        </head>
        <body>
        <h1>Verify email</h1>
        <p>Click on the link below to verify your email.</p>
        <a href="https://train.4260.nl/php/verify.php?ID='.$userIDsession.'&h='.$hash.'">Verify</a>
        <p>This mail is because an account with this email has requested a new verify link.</p>
        </body>
        </html>
        ';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <noreply@4260.nl>' . "\r\n";
        mail($to,$subject,$message,$headers);
    } else {
        echo "Something went wrong!";
    }
    } else {
        echo "zit een fout in de query: " . $mysqli->error;
    }
include '../includes/foot.php';
?>
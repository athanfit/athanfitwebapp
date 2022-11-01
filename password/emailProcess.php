<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$today = date("Y-m-d");
$time1  = date('H:i:s');
$time = date('H:i:s', strtotime('+1 hours', strtotime($time1)));
?>
<div class="container">
    <div class="col-sm-7 smallcard">
<?PHP
// above all includes
if (isset($_SERVER["HTTP_REFERER"])     && $_SERVER["HTTP_REFERER"] == "https://train.4260.nl/password/")
    {
    if (!empty($_POST['Email'])     &&
        !empty($_POST["csrfToken"]))
        {
        if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) {
            if (filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)){
                $email = $_POST['Email'];
                do {
                    $ID = rand(10000000,99999999);
                    $result = mysqli_query($mysqli, "SELECT ID FROM `Password` WHERE ID = '$ID'");
                    $rows = mysqli_num_rows($result);
                } while($rows > 1);
                // get the ID of the user from the DB
                $sql = "SELECT UserID FROM Users WHERE UserEmail = '$email'";
                $result=$mysqli->query($sql);
                if($result){
                    if ($result -> num_rows > 0) {
                        $fetchUserData = $result->fetch_assoc();
                        $userID = $fetchUserData['UserID'];
                        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_~';
                        $hash = substr(str_shuffle($permitted_chars), 0, 26);
                        $sql = "INSERT INTO Password (ID, UserID, `Hash`, `Date`, `Time`) VALUES  (?, ?, ?, ?, ?)";
                        if ($stmt = $mysqli->prepare($sql)) {
                            $stmt->bind_param('issss', $ID, $userID, $hash, $today, $time);
                            if ($stmt->execute()) {
                                ?><script>console.log("Done, data to DB");</script><?php
                            } else {
                                echo "Something went wrong!";
                            }
                        } else {
                            echo "zit een fout in de query: " . $mysqli->error;
                        }
                        $mysqli->close();
                        $to = $email;
                        $subject = "Password reset - 4260train";
                        $message = '
                        <!DOCTYPE html>
                        <html>
                        <head>
                        <style>
                        </style>
                        </head>
                        <body>
                        <h1>Password reset</h1>
                        <p>Click on the link below to be redirected to the site so your able to reset your password.</p>
                        <a href="https://train.4260.nl/password/reset.php?ID='.$userID.'&h='.$hash.'">Reset</a>
                        <p>With this email has a request been made to reset the password of your account with train.4260.</p>
                        <p>The link can be used on the same day as you requested the reset.</p>
                        </body>
                        </html>
                        ';
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <noreply@4260.nl>' . "\r\n";
                        mail($to,$subject,$message,$headers);
                    }
                }

                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Password reset</h5>
                        <p class="card-text">Email has been send to <?= $email ?>. You will find in the mail an link. With the link u will be able to reset your password.</p>
                        <p class="card-text">Check your SPAM inbox if you dont see it.</p>
                        <p class="card-text">If you have not recieved an mail, you may have misspelled or the email is not known with us.</p>
                        <a href="../index.php" class="card-link">Login</a>
                        <a href="../signup.php" class="card-link">Signup</a>
                    </div>
                </div>
                <?php

            } else {
                ?><script>console.log("Not an email adress");</script><?php
            }
        } else {
            ?><script>console.log("token is wrong");</script><?php
        }
    } else {
        ?><script>console.log("not everything filled in");</script><?php
    }
} else {
    ?><script>console.log("not from right page");</script><?php
}
?>
    </div>
</div>

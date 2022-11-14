<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$today = date("Y-m-d");
// above all includes
// below begin checking if all data is valid for the database
if (!empty($_POST["NewEmail"])      &&
    !empty($_POST["NewFirstname"])  &&
    !empty($_POST["NewLastname"])   &&
    !empty($_POST["NewPassword"])   &&
    !empty($_POST["csrfToken"])) {
        // all is checkt if is filled in
        ?> <script>console.log("All inputs filled in with signing up");</script> <?php
        if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) {
            // the token that given on the signUp page is checkt and correct
            ?> <script>console.log("csrfToken is correct");</script> <?php
            if (filter_var($_POST["NewEmail"], FILTER_VALIDATE_EMAIL)) {
                // Has an valid email
                ?> <script>console.log("Has an valid email: <?= $_POST["NewEmail"] ?>");</script> <?php // haal als werkt weg dat hij de mail stuurd in log
                $Email =        $_POST['NewEmail'];
                $Firstname =    $_POST['NewFirstname'];
                $Lastname =     $_POST['NewLastname'];
                $TextPassword = $_POST['NewPassword'];
                // add salt to the password
                $saltPassword = $TextPassword . "PannenkoekenStraat";
                $Password = hash('sha256', $saltPassword);
                // password hash van php zelf !!!!!!
                // $passwordHashed = password_hash($TextPassword, PASSWORD_DEFAULT);

                // if(password_verify($TextPassword, $dbPassword)){
                //     echo "Succes";
                // }
                
                // The firstname and lastname to all lowercase, and every first charachter of each word in the string to uppercase
                $Firstname = ucwords(strtolower($Firstname));
                $Lastname = ucwords(strtolower($Lastname));
                
                // create random gerareted ID
                do {
                    $permitted_chars = '1234567890abcdeABCDE1234567890';
                    $ID = substr(str_shuffle($permitted_chars), 0, 12);
                    $result = mysqli_query($mysqli, "SELECT UserID FROM `Users` WHERE UserID = '$ID'");
                    $rows = mysqli_num_rows($result);
                }
                while($rows > 1)
                ?> <script>console.log("Data: <?= $ID ?>");</script> <?php
                $sqlUser = "INSERT INTO Users (UserID, UserFirstname, UserLastname, UserPassword, UserEmail, `Date`) VALUES  (?, ?, ?, ?, ?, ?)";
                if ($stmt = $mysqli->prepare($sqlUser)) {
                    $stmt->bind_param('ssssss', $ID, $Firstname, $Lastname, $Password, $Email, $today);
                    if ($stmt->execute()) {
                        // ID for verify
                        do {
                            $permitted_chars = '1234567890abcdeABCDE1234567890';
                            $IDv = substr(str_shuffle($permitted_chars), 0, 12);
                            $resultv = mysqli_query($mysqli, "SELECT ID FROM `Verify` WHERE ID = '$IDv'");
                            $rowsv = mysqli_num_rows($resultv);
                        }
                        while($rowsv > 1);
                        // hash for verify
                        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_~';
                        $hash = substr(str_shuffle($permitted_chars), 0, 26);
                        // make verify record
                        $sqlVerify = "INSERT INTO `Verify` (ID ,UserID, `Hash`, `Date`) VALUES  (?, ?, ?, ?)";
                        if ($stmtv = $mysqli->prepare($sqlVerify)) {
                            $stmtv->bind_param('ssss', $IDv, $ID, $hash, $today);
                            if ($stmtv->execute()) {
                                ?> <script>console.log("verify insert works");</script> <?php
                            } else {
                                echo "is mislukt(verify)";
                            }
                        } else {
                            echo "zit een fout in de query: " . $mysqli->error;
                        }
                        ?>
                        <div class="container">
                            <div class="col-sm-7 smallcard">
                                <div class="card">
                                <h5 class="card-header">Signed-up</h5>
                                    <div class="card-body">
                                        <h5 class="card-title">Account has been made with <?= $Email ?></h5>
                                        <p class="card-text">You will recieve a mail to verify so we know it is yours.</p>
                                        <a href="../" class="card-link">Homepage</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $to = $Email;
                        $subject = "Sign-UP - 4260train";
                        $message = '
                        <!DOCTYPE html>
                        <html>
                        <head>
                        <style>
                        </style>
                        </head>
                        <body>
                        <h1>Verify email</h1>
                        <p>'.$Firstname.' '.$Lastname.'</p>
                        <p>Click on the link below to verify your email.</p>
                        <a href="https://train.4260.nl/php/verify.php?ID='.$ID.'&h='.$hash.'">Verify</a>
                        <p>This email is a conformation that a account has been made with this email-adress.</p>
                        </body>
                        </html>
                        ';
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <noreply@4260.nl>' . "\r\n";
                        mail($to,$subject,$message,$headers);
                    } else {
                        echo "is mislukt";
                    }
                } else {
                    echo "zit een fout in de query: " . $mysqli->error;
                }
                $mysqli->close();
            } else {
                // Not an valid email
                ?> <script>console.log("Not an valid email: <?= $_POST["NewUserEmail"] ?>");</script> <?php
            }
        } else {
            // the token is not correct
            ?> <script>console.log("token is not correct");</script> <?php
        }
} else {
    // not every input is filled in on the signUp page
    ?> <script>console.log("Missing data by signing up");</script> <?php
}
include '../includes/foot.php';
?> 
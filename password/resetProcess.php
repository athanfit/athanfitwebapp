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
if (isset($_SERVER["HTTP_REFERER"])     && $_SERVER["HTTP_REFERER"] == "https://athanfit.com/password/reset.php?ID=$userID&h=$hash") 
    {
        if (!empty($_POST['Password'])     &&
            !empty($_POST["csrfToken"])) 
        {
            if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) {
                $sql = "SELECT UserID, `Hash`, `Date` FROM `Password` WHERE UserID = '$userID' AND `Hash` = '$hash'";
                $result=$mysqli->query($sql); 
                if($result){ 
                    if ($result -> num_rows > 0) {
                    $fetchUserData = $result->fetch_assoc(); 
                    $date = $fetchUserData['Date'];
                    if ($date == $today){
                        $password = $mysqli -> real_escape_string($_POST['Password']);
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "UPDATE Users SET UserPassword='$hashedPassword' WHERE UserID='$userID'";
                        if ($mysqli->query($sql) === TRUE) {
                            ?><script>console.log("Record updated successfully.");</script><?php
                        } else {
                            echo "Error updating record: " . $mysqli->error;
                        }
                        $mysqli->close();
                        ?>
                        <div class="container">
                            <div class="col-sm-7 smallcard">
                                <div class="card">
                                <h5 class="card-header">Password reset</h5>
                                    <div class="card-body">
                                        <h5 class="card-title">Password has been reset</h5>
                                        <p class="card-text">You can now login with your new password.</p>
                                        <a href="../" class="card-link">Login on homepage</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }
                }
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
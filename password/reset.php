<?php
session_start();
$title = "Password reset";
include '../includes/head.php';
include '../includes/navbar.php';
require '../includes/config.php';
$Token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $Token;
$today = date("Y-m-d");
//the get parameters:
$userID = $_GET['ID']; 
$hash = $_GET['h'];
$sql = "SELECT UserEmail FROM Users WHERE UserID = '$userID'";
$result=$mysqli->query($sql); 
if($result){ 
    if ($result -> num_rows > 0) {
    $fetchUserData = $result->fetch_assoc(); 
    $email = $fetchUserData['UserEmail'];
    }
}
$sql = "SELECT UserID, `Hash`, `Date` FROM `Password` WHERE UserID = '$userID' AND `Hash` = '$hash'";
$result=$mysqli->query($sql); 
if($result){ 
    if ($result -> num_rows > 0) {
    $fetchUserData = $result->fetch_assoc(); 
    $date = $fetchUserData['Date'];
    if ($date == $today){
    ?>
    <div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
            <h5 class="card-header">Password reset</h5>
                <div class="card-body">
                    <form action="resetProcess.php?ID=<?= $userID ?>&h=<?= $hash ?>" method="post">       
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" id="Email" class="form-control" placeholder="<?= $email ?>" disabled>
                        </div>  
                        <div class="form-group">
                            <label for="Password">New password</label>
                            <input type="password" class="form-control" name="Password" id="Password" placeholder="••••••••••" aria-describedby="description" required>
                            <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                            <div id="description" class="form-text">Enter a new password.</div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary SubmitBtn">Submit</button>           
                    </form>
                </div>
                <div class="card-footer">
                    The password u now fill in will be your new password for the profile with the email above.
                </div>
            </div>
        </div>
    </div>
    <?php
    } else {
    ?>
    <div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
            <h5 class="card-header">Password reset</h5>
                <div class="card-body">
                    <h5 class="card-title">Link expired or not valid</h5>
                    <p class="card-text">The link you used is expired. If you requested the link this day, please try again this could been our fault.</p>
                    <p class="card-text">The link may not be valid, try again.</p>
                    <a href="./" class="card-link">Reset form</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    }
}
?>
    
<?php
include '../includes/foot.php';
?>
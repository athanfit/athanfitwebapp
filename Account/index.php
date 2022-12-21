<?php
$title = "Account";
require '../includes/check.php';
require '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_~';
$hash = substr(str_shuffle($permitted_chars), 0, 26);
$_SESSION['hash'] = $hash;
$ID = $_SESSION['ID'];
$sql = "SELECT * FROM Users WHERE UserID = '$ID'";
$result=$mysqli->query($sql); 
$user = $result->fetch_assoc(); 
$sql = "SELECT * FROM Verify WHERE UserID = '$ID'";
$result=$mysqli->query($sql); 
$verify = $result->fetch_assoc(); 
$Firstname = $user['UserFirstname'];
$Lastname = $user['UserLastname'];
$Email = $user['UserEmail'];
$Verified = $verify['Verified'];
?>
<div class="container">
    <div class="col-sm-7 smallcard">
        <div class="card">
            <h5 class="card-header">Account page</h5>
            <div class="card-body">
            <h5 class="card-title">Account of <?= $Firstname . " " . $Lastname ?></h5>
            <p class="card-text">Find here the info of your account and to update info of your account.</p>
            </div>
        </div>
        <?php
        if ($Verified == '0'){
            ?>
            <div>
                <div class="alert alert-warning" role="alert">
                    <p>You need to verify your email.</p>
                    <p>If your link has been expired, click below to recieve a new link in your email.</p>
                    <a class="btn btn-primary" href="verify.php?ID=<?= $ID ?>&h=<?= $hash ?>" role="button">New link</a>
                </div>
            <?php
        }
        ?>
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">Firstname: <?= $Firstname ?></li> 
                    <li class="list-group-item">Surname: <?= $Lastname ?></li>
                    <li class="list-group-item">Email: <?= $Email ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
include '../includes/foot.php';
?>
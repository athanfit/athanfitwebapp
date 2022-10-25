<?php
$title = "Account";
require '../includes/check.php';
require '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$ID = $_SESSION['ID'];
$sql = "SELECT * FROM Users WHERE UserID = '$ID'";
$result=$mysqli->query($sql); 
$fetchUserData = $result->fetch_assoc(); 
$Firstname = $fetchUserData['UserFirstname'];
$Lastname = $fetchUserData['UserLastname'];
$Email = $fetchUserData['UserEmail'];
$Verified = $fetchUserData['verified'];
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
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">Fristname: <?= $Firstname ?></li>
                    <li class="list-group-item">Lastname: <?= $Lastname ?></li>
                    <li class="list-group-item">Email: <?= $Email ?></li>
                    <li class="list-group-item">ID: <?= $ID ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
include '../includes/foot.php';
?>
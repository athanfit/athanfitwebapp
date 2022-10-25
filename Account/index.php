<?php
$title = "Account";
require '../includes/check.php';
include '../includes/head.php';
include '../includes/navbar.php';
require '../includes/config.php';
?>
<div class="container">
    <div class="col-sm-7 smallcard">
        <div class="card">
            <h5 class="card-header">Account page</h5>
            <div class="card-body">
            <h5 class="card-title">Account of <?= $_SESSION['Firstname'] ?></h5>
            <p class="card-text">Find here the info of your account and to update info of your account.</p>
            </div>
        </div>
    </div>
</div>
<?php
include '../includes/foot.php';
?>
<?php
session_start();
$title = "Verify email";
include '../includes/head.php';
include '../includes/navbar.php';
require '../includes/config.php';
//the get parameters:
$userID = $_GET['ID'];
$ID = mysqli_real_escape_string($mysqli, $userID);
$sql = "UPDATE Users SET verified='verified' WHERE UserID='$ID'";
if ($mysqli->query($sql) === TRUE) {
    ?><script>console.log("Record updated successfully.");</script><?php
    ?>
    <div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
                <h5 class="card-header">Verified</h5>
                <div class="card-body">
                    <p class="card-text">Email-adress has been verified.</p>
                    <a href="../" class="card-link">Login</a>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "Error updating record: " . $mysqli->error;
}
$mysqli->close();
?>
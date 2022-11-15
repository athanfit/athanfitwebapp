<?php
session_start();
$title = "Verify email";
require '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
//the get parameters:
$userID = $_GET['ID'];
$hash = $_GET['h'];
$today = date("Y-m-d");
$sql = "SELECT * FROM `Verify` WHERE UserID=? AND `Hash`=?"; // SQL with parameters
$stmt = $mysqli->prepare($sql); 
$stmt->bind_param("ss", $userID, $hash);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
if ($result == NULL){
    echo "is leeg";
}
$SeVerify = $result->fetch_assoc(); // fetch data  
$ID = $SeVerify["ID"];
$UserID = $SeVerify["UserID"];
$Hash = $SeVerify["Hash"];
$Date = $SeVerify["Date"];
$DateVerified = $SeVerify["DateVerified"];
$Verified = $SeVerify["Verified"];
if ($Verified == '0')
{
    $sql = "UPDATE `Verify` SET DateVerified='$today', Verified='1' WHERE ID='$ID'";
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
} else {
    ?>
    <div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
                <h5 class="card-header">Failed</h5>
                <div class="card-body">
                    <p class="card-text">Email-adress has already verified!</p>
                    <p class="card-text">Request in account setting a new link if needed.</p>
                    <a href="../" class="card-link">Login</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
$mysqli->close();
include '../includes/foot.php';
?>
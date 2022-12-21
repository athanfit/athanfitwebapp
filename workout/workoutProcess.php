<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$id = $_GET['ID'];
$userID = $_SESSION["ID"];
$exercise = array();
$today = date("Y-m-d");
if (!empty($_POST['csrfToken'])){
    if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) {
        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $sql = "UPDATE `Exersice` SET `name`=? , `amount`=? WHERE ID=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param('sds', $name, $amount, $id);
            if ($stmt->execute()) {
                ?><script>console.log("Done, data to DB");</script><?php
                header("location:./");
            } else {
                echo "Something went wrong!";
            }
        } else {
            echo "zit een fout in de query: " . $mysqli->error;
        }
    } else {
        ?><script>console.log("token not right");</script><?php
    }
} else {
    ?><script>console.log("token missing");</script><?php
}
?>
<?php
session_start();
$title = "New workout";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$userID = $_SESSION["ID"];
$today = date("Y-m-d");
$todayU = time();
$workoutGet = $_GET['w'];
echo $workoutGet . "<br>";
echo $_SERVER["HTTP_REFERER"];
// HTTP previous page
// if (isset($_SERVER["HTTP_REFERER"])     && $_SERVER["HTTP_REFERER"] == "https://athanfit.com/workout/new.php?w=$workoutGet")
// {
    // token given in the form.
    if (!empty($_POST['csrfToken'])){
        if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) 
        {
            $exersice = $_POST['exersice'];
            $amount = $_POST['amount'];
            $unit = $_POST['unit'];
            do {
                $permitted_chars = '1234567890abcdeABCDE1234567890';
                $ID = substr(str_shuffle($permitted_chars), 0, 18);
                $result = mysqli_query($mysqli, "SELECT ID FROM `Exersice` WHERE ID = '$ID'");
                $rows = mysqli_num_rows($result);
            }
            while($rows > 1);
            $sql = "INSERT INTO `Exersice` (ID, `name`, `amount`, `unit`, `userID`, `date`, `unixDate`) VALUES  (?, ?, ?, ?, ?, ?, ?)";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param('ssdsssi', $ID, $exersice, $amount, $unit, $userID, $today, $todayU);
                if ($stmt->execute()) {
                    ?><script>console.log("Done, data to DB");</script><?php
                    header("location:./");
                } else {
                    echo "Something went wrong!";
                }
                } else {
                    echo "Something wrong in the query: " . $mysqli->error;
                }
        } else {
            ?><script>console.log("token not right");</script><?php
        }
    } else {
        ?><script>console.log("token missing");</script><?php
    }
// } else {
//     ?><script>//console.log("not from right page");</script><?php
// }
?>
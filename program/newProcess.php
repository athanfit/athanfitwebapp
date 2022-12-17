<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$userID = $_SESSION["ID"];
$exercise = array();
$today = date("Y-m-d");
if (isset($_SERVER["HTTP_REFERER"])     && $_SERVER["HTTP_REFERER"] == "https://athanfit.com/program/new.php")
{
    if (!empty($_POST['csrfToken'])){
        if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) 
        {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $unit = $_POST['unit'];
            $data = $_POST;
            array_shift($data);
            array_shift($data);
            array_shift($data);
            array_pop($data);
            echo $title."<br>";
            echo $description."<br>";
            foreach ($data as $value) {
                array_push($exercise, $value);
            }
            print_r($exercise)."<br>";
            $dbExercise = serialize($exercise);
            do {
                $permitted_chars = '1234567890abcdeABCDE1234567890';
                $ID = substr(str_shuffle($permitted_chars), 0, 12);
                $result = mysqli_query($mysqli, "SELECT ID FROM `Programs` WHERE ID = '$ID'");
                $rows = mysqli_num_rows($result);
            }
            while($rows > 1);
            $sql = "INSERT INTO `Programs` (ID, `Title`, `Description`, `Program`, `unit`, `Date`, `UserID`) VALUES  (?, ?, ?, ?, ?, ?, ?)";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param('sssssss', $ID, $title, $description, $dbExercise, $unit, $today, $userID);
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
} else {
    ?><script>console.log("not from right page");</script><?php
}
?>
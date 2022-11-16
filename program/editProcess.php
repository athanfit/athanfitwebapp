<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$id = $_GET['ID'];
echo $id;
$userID = $_SESSION["ID"];
$exercise = array();
$today = date("Y-m-d");
if (isset($_SERVER["HTTP_REFERER"])     && $_SERVER["HTTP_REFERER"] == "https://train.4260.nl/program/edit.php?ID=$id")
{
    if (!empty($_POST['csrfToken'])){
        if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) 
        {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $data = $_POST;
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
            $sql = "UPDATE `Programs` SET `Title`=? , `Description`=? , `Program`=? , `Date`=? WHERE ID=?";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param('sssss', $title, $description, $dbExercise, $today, $id);
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
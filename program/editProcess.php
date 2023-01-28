<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$id = $_GET['ID'];
echo $id;
$userID = $_SESSION["ID"];
$today = date("Y-m-d");
if (isset($_SERVER["HTTP_REFERER"])     && $_SERVER["HTTP_REFERER"] == "https://athanfit.com/program/edit.php?ID=$id")
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
            $exercises = array();
            $newExercise = array();
            $seccondData = false;
            foreach ($data as $value) {
                // array_push($exercises, $value);
                if ($seccondData)
                {
                    $seccondData = false;
                    array_push($newExercise, $value);
                    array_push($exercises, $newExercise);
                } else {
                    $seccondData = true;
                    $newExercise = array();
                    array_push($newExercise, $value);
                }
            }
            print_r($exercises)."<br>";
            $dbExercise = serialize($exercises);
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
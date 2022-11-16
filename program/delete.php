<?php
session_start();
$title = "Program";
require '../includes/config.php';
$id = $_GET['ID'];
$token = $_GET['h'];
$userID = $_SESSION["ID"];
if (isset($_SESSION['ID'])   &&
    isset($_SESSION['email'])) 
    {
    if ($_SESSION['verified'] == "1")
        {
            if (!empty($token)){
                if (isset($_SESSION["token"]) && $_SESSION["token"] == $token) 
                {
                $sql = "DELETE FROM `Programs` WHERE ID=?";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param('s', $id);
                    if ($stmt->execute()) {
                        ?><script>console.log("Done, data to DB");</script><?php
                        header("location:./");
                    } else {
                        echo "Something went wrong!";
                    }
                    } else {
                        echo "zit een fout in de query: " . $mysqli->error;
                    }
                }
            }
        }
    }
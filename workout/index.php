<?php
session_start();
$title = "Workout";
require '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$userID = $_SESSION["ID"];
if (isset($_SESSION['ID'])   &&
    isset($_SESSION['email'])) 
    {
    if ($_SESSION['verified'] == "1")
        {
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h1>Workout</h1>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="new.php?w=" class="btn bigBtn btn-primary" type="button">New workout</a>
                </div>
            </div>
            <div class="col-sm-8">
                <?php
                $query = "SELECT DISTINCT(date) FROM `Exersice`";
                $result = mysqli_query($mysqli, $query);
                while ($rowDate = mysqli_fetch_array($result))
                {
                    $date = $rowDate['date'];
                    $dateFor = date("D d-M", strtotime($date));
                    $query = "SELECT * FROM `Exersice` WHERE `date`='$date'";
                    $resultEx = mysqli_query($mysqli, $query);
                    
                ?>
                <div class="card">
                    <div class="card-body">
                        <?= $dateFor ?>
                        <hr>
                        <table class="table">
                        <?php
                        while ($rowEx = mysqli_fetch_array($resultEx))
                        {
                        ?>
                        <tr>
                            <td><?= $rowEx['name'] ?></td>
                            <td><?= $rowEx['amount'] . $rowEx['unit'] ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>
                <?php
                    
                }
                ?>
            </div>
        </div>
    </div>
<?php
        } else {
            header("location:../");
        }
    } else {
        header("location:../");
    }
include '../includes/foot.php';
?>

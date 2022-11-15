<?php
session_start();
$title = "Program";
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
                        <h5>Programs</h5>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="new.php" class="btn bigBtn btn-primary" type="button">New program</a>
                </div>
            </div>
            <div class="col-sm-8">
                <?php
                $query = "SELECT * FROM `Programs` WHERE UserID = '$userID'";
                $result = mysqli_query($mysqli, $query);
                while ($row = mysqli_fetch_array($result))
                {
                    $id = $row['ID'];
                    $title = $row['Title'];
                    $description = $row['Description'];
                    $data = $row['Program'];
                    $program = unserialize($data);

                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h5><?= $title ?></h5>
                            <p><?= $description ?></p>
                            <ul class="list-group">
                                <?php
                                foreach ($program as $value) {
                                    ?><li class="list-group-item"><?= $value ?></li><?php
                                }
                                ?>
                            </ul>
                            <a type="button" href="edit.php?ID=<?= $id ?>" class="btn btn-outline-primary SubmitBtn">Edit</a>
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

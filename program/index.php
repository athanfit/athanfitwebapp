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
                        <h1>Programs</h1>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="new.php" aria-label="make new program" class="btn bigBtn btn-primary" type="button">New program</a>
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
                        <!-- <a type="button" href="edit.php?ID=" class="btn btn-outline-primary SubmitBtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16"><path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/></svg></a> -->
                            <h2 class="program-title"><?= $title ?></h2>
                            <p><?= $description ?></p>
                            <div class="list-group">
                                <?php
                                foreach ($program as $value) {
                                    ?><a href="../workout/new.php?w=<?= $value ?>&ID=<?= $id ?>" class="list-group-item list-group-item-action"><?= $value ?></a><?php
                                }
                                ?>
                            </div>
                            <a type="button" aria-label="go to edit the program with the name <?= $$title ?>" href="edit.php?ID=<?= $id ?>" class="btn btn-outline-primary SubmitBtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- <script src="keydown.js"></script>    -->

<?php
        } else {
            header("location:../");
        }
    } else {
        header("location:../");
    }
include '../js/keyControls/programs.html';
include '../includes/foot.php';
?>

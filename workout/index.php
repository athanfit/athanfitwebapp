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
            $limit = 7;
            $select1 = "";
            $select2 = "";
            $select3 = "";
            if (!empty($_GET['limit']))
            {
                $getlimit = $_GET['limit'];
                switch ($getlimit) {
                case '1':
                    // 7 as 1
                    $limit = 7;
                    $select1 = " selected";
                    break;
                case '2':
                    // 14 as 2
                    $limit = 14;
                    $select2 = " selected";
                    break;
                case '3';
                    // 40 as 3
                    $limit = 40;
                    $select3 = " selected";
                    break;
                }
            }
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
                    <a href="new.php?w=&ID=" class="btn bigBtn btn-primary" type="button">New workout</a>
                    <form class="row g-2" action="" method="get">
                        <div class="col-auto">
                            <select class="form-select" name="limit" aria-label="workout overview limit change">
                                <option value="1"<?= $select1 ?>>7 results</option>
                                <option value="2"<?= $select2 ?>>14 results</option>
                                <option value="3"<?= $select3 ?>>40 results</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <?php
                $query = "SELECT DISTINCT(date) FROM `Exersice` WHERE userID='$userID' ORDER BY date DESC LIMIT $limit";
                $result = mysqli_query($mysqli, $query);
                while ($rowDate = mysqli_fetch_array($result))
                {
                    $date = $rowDate['date'];
                    $dateFor = date("D d-M", strtotime($date));
                    $query = "SELECT * FROM `Exersice` WHERE `date`='$date' AND userID='$userID'";
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
                            $programID = $rowEx['programID'];
                            $sql = "SELECT Title FROM Programs WHERE ID=?"; // SQL with parameters
                            $stmt = $mysqli->prepare($sql); 
                            $stmt->bind_param("s", $programID);
                            $stmt->execute();
                            $resultProgram = $stmt->get_result(); // get the mysqli result
                            $program = $resultProgram->fetch_assoc(); // fetch data  
                            $programName = $program["Title"];
                        ?>
                        
                        <tr  onclick="window.location='workout.php?ID=<?= $rowEx['ID'] ?>';">
                            <td><?= $rowEx['name'] ?></td>
                            <td><?= $rowEx['amount'] . $rowEx['unit'] ?></td>
                            <td><?= $programName ?></td>
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
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
<?php
        } else {
            header("location:../");
        }
    } else {
        header("location:../");
    }
include '../includes/foot.php';
?>

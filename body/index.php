<?php
session_start();
$title = "Body";
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
                        <h1>Body</h1>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="newWeight.php" class="btn bigBtn btn-primary" type="button">Add weight</a>
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
                $query = "SELECT `weight`, `date` FROM `Weight` WHERE userID='$userID' ORDER BY date DESC LIMIT $limit";
                $result = mysqli_query($mysqli, $query);
                ?>
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                        <?php
                        while ($rowWeight = mysqli_fetch_array($result))
                        {
                            $date = $rowWeight['date'];
                            $dateFor = date("D d-M", strtotime($date));
                        ?>
                        <tr>
                            <td><?= $rowWeight['weight'] ?></td>
                            <td><?= $dateFor ?></td>
                        </tr>
                        
                        <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>
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

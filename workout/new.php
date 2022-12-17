<?php
session_start();
$title = "New workout";
require '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$Token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $Token;
$userID = $_SESSION["ID"];
if (isset($_SESSION['ID'])   &&
    isset($_SESSION['email'])) 
    {
    if ($_SESSION['verified'] == "1")
        {
        $workoutGet = $_GET['w'];
        $programID = $_GET['ID'];
?>
<div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
                <h5 class="card-header">New workout</h5>
                <div class="card-body">
                    <form action="newProcess.php?w=<?= $workoutGet ?>&ID=<?= $programID ?>" method="post">
                        <div class="form-group">
                            <label for="exersice">Exersice:*</label>
                            <input type="text" value="<?= $workoutGet ?>" class="form-control" name="exersice" id="exersice" maxlength="255" aria-describedby="ExersiceHelp" require>
                            <small id="ExersiceHelp" class="form-text text-muted">Enter here the name of the exersice and if wanted reps and sets or minutes.</small>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" class="form-control" name="amount" id="amount" step=any>
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit:</label>
                            <input type="text" class="form-control" value="KG" name="unit" id="unit" aria-describedby="unitHelp">
                            <small id="unitHelp" class="form-text text-muted">KG/KM/M</small>
                        </div>
                        <?php
                        if ($programID){
                            $sql = "SELECT Title FROM Programs WHERE ID=?"; // SQL with parameters
                            $stmt = $mysqli->prepare($sql); 
                            $stmt->bind_param("s", $programID);
                            $stmt->execute();
                            $result = $stmt->get_result(); // get the mysqli result
                            $program = $result->fetch_assoc(); // fetch data  
                            $programName = $program["Title"];
                        ?>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="program" value="1" id="programSwitch" checked>
                            <label class="form-check-label" for="programSwitch" aria-describedby="SwitchHelp" ><?= $programName ?></label><br>
                            <small id="SwitchHelp" class="form-text text-muted">Link to the program</small>
                        </div>
                        <?php
                        }
                        ?>
                        <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                        <button type="submit" class="btn btn-primary btn-block SubmitBtn">Save workout</button>
                    </form>
                </div>
            </div>
            <div class="d-grid gap-2">
                <a href="./" class="btn bigBtn btn-outline-primary" type="button">Go back</a>
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
<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$Token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $Token;
if (isset($_SESSION['ID'])   &&
    isset($_SESSION['email'])) 
    {
    if ($_SESSION['verified'] == "1")
        {
?>
    <div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
                <h5 class="card-header">New program</h5>
                <div class="card-body">
                    <form action="newProcess.php" method="post">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp" maxlength="70">
                            <small id="titleHelp" class="form-text text-muted">Keep title of the program short. If more text needed, put in the description.</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" id="description" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit:</label>
                            <input type="text" class="form-control" name="unit" id="unit" placeholder="KG/KM/M" maxlength="5">
                        </div>
                        <div class="form-group" id="exersices">
                            <label for="Exersice1">Exersice:*</label>
                            <input type="text" class="form-control" name="Exersice" id="Exersice" aria-describedby="ExersiceHelp" placeholder="Squat 6-8reps 3sets">
                            <small id="ExersiceHelp" class="form-text text-muted">Enter here the name of the exersice and if wanted reps and sets.</small>
                        </div>
                        
                        <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                        <button type="submit" class="btn btn-primary btn-block SubmitBtn">Submit</button>
                        <button type="button" class="btn btn-secondary extraBtn SubmitBtn" onClick="addInput()">Add exersice</button>
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
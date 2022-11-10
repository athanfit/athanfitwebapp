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
    if ($_SESSION['verified'] == "verified")
        {
?>
    <div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
                <h5 class="card-header">Nieuw program</h5>
                <div class="card-body">
                    <form action="nieuwProcess.php" method="post">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" id="title" maxlength="70">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" id="description" maxlength="255">
                        </div>
                        <div class="form-group" id="exersices">
                            <label for="Exersice1">Exersice:*</label>
                            <input type="text" class="form-control" name="Exersice" id="Exersice" aria-describedby="ExersiceHelp" placeholder="Squat 10-12reps 3sets">
                            <small id="ExersiceHelp" class="form-text text-muted">Enter here the name of the exersice and if wanted reps and sets.</small>
                        </div>
                        <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                        <button type="button" class="btn btn-secondary extraBtn" onClick="addInput()">Add exersice</button>
                        <button type="submit" class="btn btn-primary btn-block SubmitBtn">Submit</button>
                    </form>
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
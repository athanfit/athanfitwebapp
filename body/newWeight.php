<?php
session_start();
$title = "Add Weight";
include '../includes/head.php';
include '../includes/navbar.php';
$Token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $Token;
?>
    <div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
            <h5 class="card-header">Add weight</h5>
                <div class="card-body">
                    <form action="weightProcess.php" method="post">         
                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="number" class="form-control" name="weight" id="weight" placeholder="78,50" aria-describedby="input to add weight to record" step=any>
                            <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                        </div>
                        <button type="submit" name="submit" aria-label="Request reset" class="btn btn-primary SubmitBtn">Add weight</button>           
                    </form>
                </div>
                <div class="card-footer">
                    Tip: try to weigh yourself on the same moment, like in the moring after going to the toilet and before u have breakfast.
                </div>
            </div>
        </div>
    </div>
<?php
include '../includes/foot.php';
?>
<?php
session_start();
$title = "Aanmelden - ";
include 'includes/head.php';
include 'includes/navbar.php';
$Token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $Token;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-7 smallcard">
            <div class="card">
                <h5 class="card-header">Sign-Up</h5>
                <div class="card-body">
                    <form action="php/SignUpProcess.php" method="post">
                        <div class="form-group">
                            <label for="NewEmail">Email </label>
                            <input type="email" class="form-control" name="NewEmail" id="NewEmail" aria-describedby="emailHelp" placeholder="name@site.com" required>
                            <small id="emailHelp" class="form-text text-muted">Your email will only be used for some functions of the site.</small>
                        </div>
                        <div class="form-group">
                            <label for="NewFirstname">Firstname</label>
                            <input type="text" class="form-control" name="NewFirstname" id="NewFirstname" placeholder="Enter firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="NewLastname">Surname</label>
                            <input type="text" class="form-control" name="NewLastname" id="NewLastname" placeholder="Enter surname" required>
                        </div>
                        <div class="form-group">
                            <label for="NewPassword">Password</label>
                            <input type="password" class="form-control" name="NewPassword" id="NewPassword" placeholder="Enter password" required>
                            <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block SubmitBtn">Sign-up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/foot.php';
?>
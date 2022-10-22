<?php
session_start();
$title = "Password reset";
include '../includes/head.php';
include '../includes/navbar.php';
$Token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $Token;
?>
    <div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
            <h5 class="card-header">Password reset</h5>
                <div class="card-body">
                    <form action="emailProcess.php" method="post">         
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="Email" id="Email" placeholder="name@site.com" aria-describedby="description">
                            <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                            <div id="description" class="form-text">Enter the email-adress of the account u want the password reset.</div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary SubmitBtn">Submit</button>           
                    </form>
                </div>
                <div class="card-footer">
                    You will recieve an email message if the email-adress u entered is linked to any profile known with us.
                </div>
            </div>
        </div>
    </div>
<?php
include '../includes/foot.php';
?>
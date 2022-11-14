<?php
session_start();
$title = "Home";
include 'includes/head.php';
include 'includes/navbar.php';
require 'includes/config.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php
                if (isset($_SESSION["ID"])){
                ?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION['Firstname'] ?>, your logged in.
                </div>
                <?php
                } else {
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <form method="post">
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" name="Email" id="Email" placeholder="name@site.com">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control" name="Password" id="Password" placeholder="••••••••••">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary SubmitBtn">Login</button>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) 
                        {
                            if (!empty($_POST["Email"]) &&
                                !empty($_POST["Password"])) 
                                {
                                if (filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL))
                                {
                                    $Email = $mysqli -> real_escape_string($_POST['Email']);
                                    $TextPassword = $mysqli -> real_escape_string($_POST['Password']);
                                    $saltPassword = $TextPassword . "PannenkoekenStraat";
                                    $Password = hash('sha256', $saltPassword);
                                    ?><script>console.log("hash: <?= $Password ?>");</script><?php
                                    $query = "SELECT * FROM Users WHERE UserEmail = '$Email' AND UserPassword = '$Password'";
                                    $resultaat = mysqli_query($mysqli, $query);
                                    if (mysqli_num_rows($resultaat) > 0)
                                    {
                                        // done
                                        $user = mysqli_fetch_array($resultaat);
                                        $_SESSION['ID'] = $user['UserID'];
                                        $_SESSION['email'] = $user['UserEmail'];
                                        $_SESSION['Firstname'] = $user['UserFirstname'];
                                        $_SESSION['verified'] = $user['verified'];
                                        header("Refresh:0");
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Something went wrong, username and or password may be incorect
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="card-footer text-muted">
                        No account, <a href="signup.php">Click here</a> to signup.<br>
                        Forgot password? <a href="password/">Click here</a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-sm-8">
                <?php
                if (isset($_SESSION["ID"])){
                    ?>
                    <div class="alert alert-warning" role="alert">
                        ingelogd
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        niet Ingelogd
                    </div>
                    <?php
                }
                ?>
                
            </div>
        </div>
    </div>
<?php
include 'includes/foot.php';
?>

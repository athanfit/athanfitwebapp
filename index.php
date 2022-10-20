<?php
session_start();
$title = "";
include 'includes/head.php';
include 'includes/navbar.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inloggen</h5>
                        <form method="post">
                            <div class="form-group">
                                <label for="userEmail">Email</label>
                                <input type="email" class="form-control" name="UserEmail" id="userEmail" placeholder="naam@voorbeeld.com">
                            </div>
                            <div class="form-group">
                                <label for="userPassword">Wachtwoord</label>
                                <input type="password" class="form-control" name="UserPassword" id="userPassword" placeholder="Wachtwoord">
                            </div>
                            <button type="submit" class="btn btn-primary LoginBtn">Inloggen</button>
                            
                        </form>
                        <?php
                        if (isset($_POST['submit'])) 
                        {
                            if (!empty($_POST["UserEmail"]) &&
                                !empty($_POST["UserPassword"])) 
                                {
                                if (filter_var($_POST["NewUserEmail"], FILTER_VALIDATE_EMAIL))
                                {
                                    $Email = $mysqli -> real_escape_string($_POST['UserEmail']);
                                    $TextPassword = $mysqli -> real_escape_string($_POST['UserPassword']);
                                    $Password = hash('sha256', $TextPassword);
                                    $query = "SELECT * FROM users WHERE userEmail = '$Email' AND userPassword = '$Password'";
                                    $resultaat = mysqli_query($mysqli, $query);
                                    if (mysqli_num_rows($resultaat) > 0)
                                    {
                                        $user = mysqli_fetch_array($resultaat);
                                        $_SESSION['ID'] = $user['userID'];
                                        $_SESSION['email'] = $user['userEmail'];
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Ging wat fout bij het formulier, er is geen acount gemaakt
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="card-footer text-muted">
                        Nog geen acount, <a href="signup.php">klink hier</a> om een acount aan te maken.
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                
                <div class="alert alert-warning" role="alert">
                    De site is nog in ontwikkeling.
                </div>
            </div>
        </div>
    </div>
<?php
include 'includes/foot.php';
?>

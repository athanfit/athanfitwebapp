<?php
session_start();
$title = "Program";
include '../includes/head.php';
include '../includes/navbar.php';
require '../includes/config.php';
if (isset($_SESSION['ID'])   &&
    isset($_SESSION['email'])) 
    {
    if ($_SESSION['verified'] == "verified")
        {
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="list-group">
                    <a href="nieuw.php" class="list-group-item list-group-item-action">Nieuw</a>
                    <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                    <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                    <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
                </div>
            </div>
            <div class="col-sm-8">
                <?php
                if (isset($_SESSION["ID"])){
                    ?>
                    <div class="alert alert-warning" role="alert">
                        ingelogd
                    </div>
                    <?php
                    if ($_SESSION["verified"] == 'not verified')
                    {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Please verify your email!
                        </div>
                        <?php
                    }
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
        } else {
            header("location:../");
        }
    } else {
        header("location:../");
    }
include '../includes/foot.php';
?>

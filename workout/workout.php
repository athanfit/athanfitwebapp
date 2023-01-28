<?php
session_start();
$title = "Edit workout";
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
        $id = $_GET["ID"];
        
        $sql = "SELECT * FROM Exersice WHERE ID = ? AND userID = ?"; // SQL with parameters
        $stmt = $mysqli->prepare($sql); 
        $stmt->bind_param("ss", $id, $userID);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $exersice = $result->fetch_assoc(); // fetch data  
        $id = $exersice['ID'];
        $name = $exersice['name'];
        $amount = $exersice['amount'];
        $userID = $exersice['userID'];
?>
<div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
                <h5 class="card-header">Edit workout</h5>
                <div class="card-body">
                    <form action="workoutProcess.php?ID=<?= $id ?>" method="post">
                        <div class="form-group">
                            <label for="exersice">Name:</label>
                            <input type="text" value="<?= $name ?>" class="form-control" name="name" id="exersice" maxlength="255" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" value="<?= $amount ?>" class="form-control" name="amount" id="amount" step=any>
                        </div>
                        <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                        <button type="submit" aria-label="Save changes to workout" class="btn btn-primary btn-block SubmitBtn">Save changes</button>
                        <button type="button" aria-label="delete workout" class="btn btn-danger extraBtn SubmitBtn" onClick="myFunction()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button>
                    </form>
                </div>
            </div>
            <div class="d-grid gap-2">
                <a href="./" class="btn bigBtn btn-outline-primary" aria-label="go back" type="button">Go back</a>
            </div>
        </div>
    </div>
    <script>
    function myFunction() {
        if (confirm("Are u sure u want to delete this?")) {
            window.location.href = "delete.php?ID=<?= $id ?>&h=<?= $Token ?>";
        }
    }
    autocomplete(document.getElementById("exersice"), exersices);
    </script>
<?php
        } else {
            header("location:../");
        }
    } else {
        header("location:../");
    }
include '../js/keyControls/programForm.html';
include '../includes/foot.php';
?>
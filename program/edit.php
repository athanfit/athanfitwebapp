<?php
session_start();
$title = "Edit program";
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
        
        $sql = "SELECT * FROM Programs WHERE ID = ? AND UserID = ?"; // SQL with parameters
        $stmt = $mysqli->prepare($sql); 
        $stmt->bind_param("ss", $id, $userID);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $program = $result->fetch_assoc(); // fetch data  
        $id = $program['ID'];
        $title = $program['Title'];
        $description = $program['Description'];
        $data = $program['Program'];
        $exercise = unserialize($data);
        $exercise1 = $exercise[0];
        array_shift($exercise);
        $userID = $program['UserID'];
?>
<div class="container">
        <div class="col-sm-7 smallcard">
            <div class="card">
                <h5 class="card-header">Edit program</h5>
                <div class="card-body">
                    <form action="editProcess.php?ID=<?= $id ?>" method="post">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" value="<?= $title ?>" class="form-control" name="title" id="title" maxlength="70">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" value="<?= $description ?>" class="form-control" name="description" id="description" maxlength="255">
                        </div>
                        <div class="form-group" id="exersices">
                            <label for="Exersice1">Exersice:*</label>
                            <input type="text" value="<?= $exercise1 ?>" class="form-control" name="Exersice" id="Exersice" aria-describedby="ExersiceHelp" placeholder="Squat 10-12reps 3sets">
                            <small id="ExersiceHelp" class="form-text text-muted">Enter here the name of the exersice and if wanted reps and sets.</small>
                        </div>
                        <?php
                        foreach ($exercise as $value) {
                            ?>
                            <script>window.onload = addInput("<?= $value ?>")</script>
                            <!-- <div class='form-group'><input type='text' value="" class='form-control' name='Exersice"+counter+"' id='Exersice'><button type='button' class='btn btn-outline-secondary smallBtn' onClick='removeInput("+dynamicInput[counter]+");'> - </button></div> -->
                            <?php
                        }
                        ?>
                        <input type="hidden" name="csrfToken" value="<?= $Token ?>">
                        <button type="submit" aria-label="Save changes to program" class="btn btn-primary btn-block SubmitBtn">Save changes</button>
                        <button type="button" aria-label="delete program" class="btn btn-danger extraBtn SubmitBtn" onClick="myFunction()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button>
                        <button type="button" aria-label="add extra exersice input" class="btn btn-secondary extraBtn SubmitBtn" onClick="addInput()">Add exersice</button>
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
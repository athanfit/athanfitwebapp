<?php
session_start();
$title = "Program";
require '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
$userID = $_SESSION["ID"];
if (isset($_SESSION['ID'])   &&
    isset($_SESSION['email'])) 
    {
    if ($_SESSION['verified'] == "1")
        {
        $id = $_GET["ID"];
        
        $sql = "SELECT * FROM Programs WHERE ID = ?"; // SQL with parameters
        $stmt = $mysqli->prepare($sql); 
        $stmt->bind_param("s", $id);
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
                    <form action="nieuwProcess.php" method="post">
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
                        <button type="button" class="btn btn-secondary extraBtn" onClick="addInput()">Add exersice</button>
                        <button type="submit" class="btn btn-primary btn-block SubmitBtn">Submit</button>
                    </form>
                </div>
            </div>
            <div class="d-grid gap-2">
                <a href="./" class="btn bigBtn btn-primary" type="button">Go back</a>
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
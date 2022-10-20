<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
// above all includes
// below begin checking if all data is valid for the database
if (!empty($_POST["NewUserEmail"])      &&
    !empty($_POST["NewUserFirstname"])  &&
    !empty($_POST["NewUserLastname"])   &&
    !empty($_POST["NewUserGender"])     &&
    !empty($_POST["NewUserPassword"])   &&
    !empty($_POST["csrfToken"])) {
        // all is checkt if is filled in
        ?> <script>console.log("All inputs filled in with signing up");</script> <?php
        if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) {
            // the token that given on the signUp page is checkt and correct
            ?> <script>console.log("csrfToken is correct");</script> <?php
            if (filter_var($_POST["NewUserEmail"], FILTER_VALIDATE_EMAIL)) {
                // Has an valid email
                ?> <script>console.log("Has an valid email: <?= $_POST["NewUserEmail"] ?>");</script> <?php // haal als werkt weg dat hij de mail stuurd in log
                $Email = $mysqli -> real_escape_string($_POST['NewUserEmail']);
                $Firstname = $mysqli -> real_escape_string($_POST['NewUserFirstname']);
                $Lastname = $mysqli -> real_escape_string($_POST['NewUserLastname']);
                $Gender = $mysqli -> real_escape_string($_POST['NewUserGender']);
                $TextPassword = $mysqli -> real_escape_string($_POST['NewUserPassword']);
                $Password = hash('sha256', $TextPassword);
                
                // The firstname and lastname to all lowercase, and every first charachter of each word in the string to uppercase
                $Firstname = ucwords(strtolower($Firstname));
                $Lastname = ucwords(strtolower($Lastname));
                
                // create random gerareted ID
                do {
                    $ID = rand(10000000,99999999);
                    $result = mysqli_query($mysqli, "SELECT * FROM `users` WHERE userID = '$ID'");
                    $rows = mysqli_num_rows($result);
                }
                while($rows > 1)
                ?> <script>console.log("Data: <?= $ID ?>");</script> <?php
                $sql = "INSERT INTO users (userID, userEmail, userFirstname, userLastname, userGender, userPassword) VALUES  (?, ?, ?, ?, ?, ?)";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param('isssss', $ID, $Email, $Firstname, $Lastname, $Gender, $Password);
                    if ($stmt->execute()) {
                        echo "is gelukt";
                    } else {
                        echo "is mislukt";
                    }
                } else {
                    echo "zit een fout in de query: " . $mysqli->error;
                }
                $mysqli->close();
            } else {
                // Not an valid email
                ?> <script>console.log("Not an valid email: <?= $_POST["NewUserEmail"] ?>");</script> <?php
            }
        } else {
            // the token is not correct
            ?> <script>console.log("token is not correct");</script> <?php
        }
} else {
    // not every input is filled in on the signUp page
    ?> <script>console.log("Missing data by signing up");</script> <?php
}
include '../includes/foot.php';
?> 
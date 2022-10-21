<?php
session_start();
$title = "Aanleden";
include '../includes/config.php';
include '../includes/head.php';
include '../includes/navbar.php';
// above all includes
// below begin checking if all data is valid for the database
if (!empty($_POST["NewEmail"])      &&
    !empty($_POST["NewFirstname"])  &&
    !empty($_POST["NewLastname"])   &&
    !empty($_POST["NewPassword"])   &&
    !empty($_POST["csrfToken"])) {
        // all is checkt if is filled in
        ?> <script>console.log("All inputs filled in with signing up");</script> <?php
        if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrfToken"]) {
            // the token that given on the signUp page is checkt and correct
            ?> <script>console.log("csrfToken is correct");</script> <?php
            if (filter_var($_POST["NewEmail"], FILTER_VALIDATE_EMAIL)) {
                // Has an valid email
                ?> <script>console.log("Has an valid email: <?= $_POST["NewEmail"] ?>");</script> <?php // haal als werkt weg dat hij de mail stuurd in log
                $Email =        $_POST['NewEmail'];
                $Firstname =    $_POST['NewFirstname'];
                $Lastname =     $_POST['NewLastname'];
                $TextPassword = $_POST['NewPassword'];
                // add salt to the password
                $saltPassword = $TextPassword . "PannenkoekenStraat";
                $Password = hash('sha256', $saltPassword);
                // password hash van php zelf !!!!!!
                // $passwordHashed = password_hash($TextPassword, PASSWORD_DEFAULT);

                // if(password_verify($TextPassword, $dbPassword)){
                //     echo "Succes";
                // }
                
                // The firstname and lastname to all lowercase, and every first charachter of each word in the string to uppercase
                $Firstname = ucwords(strtolower($Firstname));
                $Lastname = ucwords(strtolower($Lastname));
                
                // create random gerareted ID
                do {
                    $permitted_chars = '1234567890abcdeABCDE1234567890';
                    $ID = substr(str_shuffle($permitted_chars), 0, 12);
                    $result = mysqli_query($mysqli, "SELECT UserID FROM `Users` WHERE UserID = '$ID'");
                    $rows = mysqli_num_rows($result);
                }
                while($rows > 1)
                ?> <script>console.log("Data: <?= $ID ?>");</script> <?php
                $sql = "INSERT INTO Users (UserID, UserFirstname, UserLastname, UserPassword, UserEmail) VALUES  (?, ?, ?, ?, ?)";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param('sssss', $ID, $Firstname, $Lastname, $Password, $Email);
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
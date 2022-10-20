<?php
// database logingegevens
$db_hostename = 'localhost'; // of '127.0.0.1'
$db_username = '4260nl';
$db_password = '0SRFa0wP';
$db_database = '4260nl_train';

$mysqli = mysqli_connect($db_hostename, $db_username, $db_password, $db_database);

if (!$mysqli) {

    echo "FOUT: geen connectie naar database. <br>";
    echo "Errno: " . mysqli_connect_errno() . "<br>";
    echo "Error: " . mysqli_connect_error() . "<br>";
    exit;

}

error_reporting(E_ALL);
ini_set('display_errors', '1');
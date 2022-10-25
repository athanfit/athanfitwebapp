<?php
//session check
//require on php file where someone cant be without being logged in.
session_start();
if (!isset($_SESSION['ID'])   &&
    !isset($_SESSION['email'])&&
    !isset($_SESSION['verified'])) 
    {
    header("location:../");
}
?>
<?php

session_start();

if(!isset($_SESSION['Email'])){
    $_SESSION['Email'];
    header("location: index.php");
    exit(0);
}



?>
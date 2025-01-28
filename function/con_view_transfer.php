<?php

include '../connection/dbcon.php';




if(isset($_POST['submit']))
{
    $fn1=mysqli_real_escape_string($con, $_POST['full_name']);
    $con1=mysqli_real_escape_string($con, $_POST['contact']);
    $cf1=mysqli_real_escape_string($con, $_POST['cur_faculty']);
    $cfi1=mysqli_real_escape_string($con, $_POST['faculty_id']);

    $query = "INSERT INTO `student_transfar`(`name`, `contact`, `current_faculty`, `transfer_faculty`) VALUES ('$fn1','$con1','$cf1','$cfi1')";
    $query_run = mysqli_query($con, $query);
    header("location:../transfer.php");
       
}


?>
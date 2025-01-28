<?php

include '../connection/dbcon.php';

// extract($_POST);

if(isset($_POST['submit']))
{       $id=$_POST['id'];
        $name = $_POST['full_name'];
        $RecieveBy = $_POST['RecieveBy'];
        $Date = $_POST['Date'];
        $CourseFees = $_POST['CourseFees'];
        $PaidFees = $_POST['PaidFees'];
        $BalanceFees = $_POST['BalanceFees']; 
        $Payement = $_POST['Payement'];
        $course = $_POST['course'];
        $Remark = $_POST['Remark'];
        $CheckNo = $_POST['CheckNo']??'';
        $uTRNO = $_POST['uTRNO']??'';
    $query = "UPDATE `payement` 
          SET 
              `name` = '$name',
              `course` = '$course',
              `Recieve` = '$RecieveBy',
              `Date` = '$Date',
              `ModeOfPayement` = '$Payement',
              `courseFees` = '$CourseFees',
              `Paid` = '$PaidFees',
              `Balance` = '$BalanceFees',
              `chekcno` = '$CheckNo',
              `utrno` = '$uTRNO',
              `Remark` = '$Remark'
          WHERE `id` = '$id'";

     $query_run = mysqli_query($con, $query);
    if($query_run){
        echo " <script>  
                alert('Enquiry Successfully');
                window.location.href='../home.php';
              </script> ";

   }else{
    echo " <script>  alert('Some Data is not Correct'); </script> ";
        header("location:../home.php");
   }
       
}


?>

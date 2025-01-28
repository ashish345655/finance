<?php

include '../connection/dbcon.php';

// extract($_POST);

if(isset($_POST['submit']))
{   
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
        $branch = $_POST['branch'];
        $status = $_POST['status'];
        $manager = $_POST['manager'];
        $inst = $_POST['inst'];
        $front_offcier=$_POST['frontofficer'];
    $query = "INSERT INTO `payement`(`name`,`course`,`Recieve`,`Date`,`ModeOfPayement`,`courseFees`,`Paid`,`Balance`,`chekcno`,`utrno`,`inst`,`manager`,`front_officer`,`status`,`branch`,`Remark`)
     VALUES ('$name','$course','$RecieveBy','$Date','$Payement','$CourseFees','$PaidFees','$BalanceFees',
     '$CheckNo','$uTRNO','$inst','$manager','$front_offcier',' $status','$branch','$Remark')";

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

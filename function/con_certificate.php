<?php

include '../connection/dbcon.php';

// extract($_POST);

if(isset($_POST['submit']))
{ 
		$name1 = $_POST['name'];
        $con1 = $_POST['con'];
        $sub1 = $_POST['sub'];
        $performance1 = $_POST['performance'];
        $attempt1 = $_POST['attempt'];
        $date1 = $_POST['date'];
        $grade1 = $_POST['grade']; 
        $branch1 = $_POST['branch'];
        $fac123 = $_POST['fac121'];
        $certificate_no1 = $_POST['certificate_no'];
        
        $query =" INSERT INTO `certificate`(`name`,`contact`, `course`, `Performance`, `Attempt`, `Grade`, `Exam_date`, `Branch`,`Faculty`, `Certificate_no`) VALUES ('$name1','$con1',upper('$sub1'),'$performance1','$attempt1','$grade1','$date1','$branch1','$fac123','$certificate_no1') ";

     $query_run = mysqli_query($con, $query);
    if($query_run){
        echo " <script>  
                alert('Certificate Apply Successfully');
                window.location.href='../certificate.php';
              </script> ";

   }else{
    echo " <script>  alert('Some Data is not Correct'); </script> ";
    header("location:../certificate.php");
   }


}
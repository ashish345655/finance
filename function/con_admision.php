<?php

include '../connection/dbcon.php';

// extract($_POST);

if(isset($_POST['submit']))
{   
        $todaysDate = date("d-m-Y");
    
        $name = $_POST['full_name'];
        $contact = $_POST['contact'];
        $p_contact = $_POST['parent_contact'];
        $lacture_date = $_POST['lacture_date'];
        $batch_time = $_POST['batch_time'];
        $course = $_POST['course']; 
        $address = $_POST['Address'];
        $branch = $_POST['branch'];
        $faculty_id = $_POST['faculty_id'];
        $password = $_POST['password']; 
        $status = $_POST['status'];
        $manager = $_POST['manager'];
        $inst = $_POST['inst'];
        $fees = $_POST['fees'];
        $check=mysqli_query($con, "SELECT * From student where contact='$contact'");
        $nums = mysqli_num_rows($check);


        if ($nums==true) {

              echo " <script>  
                alert('All ready Contact No. Exist');
                window.location.href='../add_student.php';
              </script> ";  
        }else{

    $query = "INSERT INTO `student` (`name`, `contact`, `p_contact`, `lacture_date`, `batch_time`,
     `course`, `address` , `branch`, `faculty_id`, `password`, `status`,`date12`,`manager`,`inst`,`fees`)
     VALUES (upper('$name'),'$contact','$p_contact','$lacture_date','$batch_time','$course','$address',
     '$branch','$faculty_id','$password','$status','$todaysDate','$manager','$inst',`$fees`)";
     $query_run = mysqli_query($con, $query);
            if($query_run){
                echo " <script>  
                        alert('Registration Successfully');
                        window.location.href='../active_student.php';
                      </script> ";

           }else{
            echo " <script>  alert('Some Data is not Correct'); </script> ";
            header("location:../active_student.php");
           }

        }
       
}




?>

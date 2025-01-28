<?php

include '../connection/dbcon.php';

// extract($_POST);

if(isset($_POST['submit']))
{   
        $name = $_POST['full_name'];
        $contact = $_POST['contact'];
        $p_contact = $_POST['parent_contact'];
        $quli = $_POST['quli'];
        $dob1 = $_POST['dob'];
        $a_quli = $_POST['add_quli']; 
        $add = $_POST['address'];
        $lan = $_POST['land'];
        $pin = $_POST['pin'];
        $rname = $_POST['r_name'];
        $rcont = $_POST['r_cont'];
        $courname = $_POST['cour_name'];
        $coursugg = $_POST['cour_sugg'];
        $bycome = $_POST['by_come']; 
        $prefer1 = $_POST['prefer'];
        $remark1 = $_POST['remark'];
        $branch1 = $_POST['branch'];
        $faculty_id = $_POST['faculty_id'];
        $manager = $_POST['manager'];
        $inst = $_POST['inst'];
    $query = "INSERT INTO `enquery`(`full_name`, `contact_No`, `p_Contact`, `qualification`, `dob`, `add_Qualification`, `address`, `landMark`, `pin_code`, `reference_name`, `reference_contact`, `course_Name`, `suggest_Course`, `by_Come`, `prefer`,`remark`, `branch`, `faculty_id`,`manager`,`inst`) 
    VALUES ('$name','$contact','$p_contact','$quli','$dob1','$a_quli','$add','$lan','$pin','$rname','$rcont','$courname','$coursugg','$bycome','$prefer1','$remark1','$branch1','$faculty_id','$manager','$inst')";

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

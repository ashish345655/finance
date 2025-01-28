<?php 

include '../connection/dbcon.php';

$ids = $_GET['usrid'];


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


        $query="UPDATE `enquery` SET `full_name`='$name',`contact_No`='$contact',`p_Contact`='$p_contact',`qualification`='$quli',`dob`='$dob1',`add_Qualification`='$a_quli',`address`='$add',`landMark`='$lan',`pin_code`='$pin',`reference_name`='$rname',`reference_contact`='$rcont',`course_Name`='$courname',`suggest_Course`='$coursugg',`by_Come`='$bycome',`prefer`='$prefer1',`remark`='$remark1',`branch`='$branch1',`faculty_id`='$faculty_id' WHERE `contact_No`='$contact' ";

        $result=mysqli_query($con, $query);


        if($result)
            {
              echo " <script>  
                  alert('Update Successfully');
                  window.location.href='../current_enquiry.php';
                </script> ";

            }else{

              echo " <script>  
                    alert('Something is Wrong');
                    window.location.href='../current_enquiry.php';
                  </script> ";
            }


 }







 // CREATE TABLE copy_table  AS SELECT * FROM another_table;

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

    $querys = "INSERT INTO `enquery_record`(`full_name`, `contact_No`, `p_Contact`, `qualification`, `dob`, `add_Qualification`, `address`, `landMark`, `pin_code`, `reference_name`, `reference_contact`, `course_Name`, `suggest_Course`, `by_Come`, `prefer`,`remark`, `branch`, `faculty_id`) VALUES ('$name','$contact','$p_contact','$quli','$dob1','$a_quli','$add','$lan','$pin','$rname','$rcont','$courname','$coursugg','$bycome','$prefer1','$remark1','$branch1','$faculty_id')";

     $query_run = mysqli_query($con, $querys);

 }






?>
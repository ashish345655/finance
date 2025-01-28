<?php

include '../connection/dbcon.php';

extract($_POST);

if(isset($_POST['readrecord']) ) {

    $data = '<table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Time</th>
                    <th>Action</th>
                  </tr>
                 </thead>';

    $disply_qy = "SELECT * FROM `batch` order by `id` DESC";
    $disply_res = mysqli_query($con, $disply_qy);

    if(mysqli_num_rows($disply_res) > 0){
        $i=1;

        while($row = mysqli_fetch_array($disply_res)){

            $data .= '<tr>
                        <td>'. $i .' </td>
                        <td>'.$row['time1'].'</td>
                        <td>
                        <button onclick="deleteButton('.$row['id'].')"  class="deleteStudentBtn btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>';
                    $i++;
             }
        }
        $data .='</table>';
        echo $data;

}

if(isset($_POST['time12']))
{
    $query = "INSERT INTO batch (time1) VALUES ('$time12')";
    $query_run = mysqli_query($con, $query);
    header("location:../view_batch.php");
       
}

    

    if(isset($_POST['deleteid'])){
        $id = $_POST["deleteid"];
        $sql = "DELETE FROM batch WHERE id = $id";
        $query_run = mysqli_query($con, $sql);
    }
   

?>
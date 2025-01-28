<?php

include '../connection/dbcon.php';
$name=$_POST['name'];
$sql = "SELECT * FROM student where name='$name'";
$data = [];
$result = $con->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $rowData = [
        'id' => $row['id'],
        'full_name' => $row['name'],
        'contact_No' => $row['contact'],
        'p_Contact' => $row['p_contact'],    
        'course_Name' => $row['course'],       
        'date' => $row['date12'],
        'fees'=>$row['fees'],

    ];
    $data[] = $rowData;
  }
  echo json_encode($data);
}

?>

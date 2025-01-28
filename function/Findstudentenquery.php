<?php

include '../connection/dbcon.php';
$name=$_POST['name'];
$sql = "SELECT * FROM enquery where full_name='$name'";
$data = [];
$result = $con->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $rowData = [
        'id' => $row['id'],
        'full_name' => $row['full_name'],
        'contact_No' => $row['contact_No'],
        'p_Contact' => $row['p_Contact'],
        'qualification' => $row['qualification'],
        'dob' => $row['dob'],
        'add_Qualification' => $row['add_Qualification'],
        'address' => $row['address'],
        'landMark' => $row['landMark'],
        'pin_code' => $row['pin_code'],
        'reference_name' => $row['reference_name'],
        'reference_contact' => $row['reference_contact'],
        'course_Name' => $row['course_Name'],
        'suggest_Course' => $row['suggest_Course'],
        'by_Come' => $row['by_Come'],
        'prefer' => $row['prefer'],
        'remark' => $row['remark'],
        'branch' => $row['branch'],
        'faculty_id' => $row['faculty_id'],
        'date' => $row['date'],
        'manager' => $row['manager'],
        'inst' => $row['inst']
    ];
    $data[] = $rowData;
  }
  echo json_encode($data);
}

?>

<?php
// Include the database connection
include '../connection/dbcon.php';

// Check if the necessary POST parameters are set
if (isset($_POST['Considerinmonth']) && isset($_POST['Considerinyear']) && isset($_POST['id']) && isset($_POST['status'])) {

    // Get the raw data from $_POST
    $status = $_POST['status'];
    $considerinmonth = $_POST['Considerinmonth'];
    $considerinyear = $_POST['Considerinyear'];
    $id = $_POST['id'];

    // Create the SQL UPDATE query
    $query = "UPDATE payement SET ConsiderInMonth = '$considerinmonth', ConsiderInYear = '$considerinyear', status = '$status' WHERE id = $id";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the update was successful
    if ($result) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

} else {
    echo 'Missing required parameters.';
}
?>

<?php
// Include the database connection
include '../connection/dbcon.php';

// Check if the necessary POST parameters are set
if (isset($_POST['Considerinmonth']) && isset($_POST['Considerinyear'])) {

    // Get the raw data from $_POST
    
    $considerinmonth = $_POST['Considerinmonth'];
    $considerinyear = $_POST['Considerinyear'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $course = $_POST['course'];


    // Create the SQL UPDATE query
    $query = "UPDATE student SET month = '$considerinmonth', year = '$considerinyear' WHERE name = '$name' AND course = '$course' AND contact = '$contact'";

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

<?php
// Include the database connection file
include 'connection/dbcon.php';

// Set the ID for the query (you can modify this as needed)
$id = 1; // or dynamically set $id based on your needs

// Query to fetch data based on ID
$selectqy = "SELECT * FROM payement WHERE id='$id' ORDER BY id ASC";
$qy = mysqli_query($con, $selectqy);

$data = [];

if ($qy && mysqli_num_rows($qy) > 0) {
    $data = mysqli_fetch_assoc($qy);
} else {
    $data = ['error' => 'No data found'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payement data</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <h2 class="mb-4">Payement data</h2>
        <?php if (isset($data['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $data['error']; ?>
            </div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $value): ?>
                        <tr>
                            <td><?php echo ucfirst(str_replace('_', ' ', $key)); ?></td>
                            <td><?php echo !empty($value) ? $value : '<em>None</em>'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

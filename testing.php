<?php
include 'connection/dbcon.php';

$selectqy = "SELECT * FROM payement ORDER BY id ASC";
$qy = mysqli_query($con, $selectqy);

if ($qy && mysqli_num_rows($qy) > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead><tr><th>Mode of Payment</th><th>Details</th></tr></thead><tbody>";

    while ($res = mysqli_fetch_assoc($qy)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($res['ModeOfPayement'], ENT_QUOTES, 'UTF-8') . "</td>";

        switch ($res['ModeOfPayement']) {
            case 'SWIPE':
                echo "<td>" . htmlspecialchars($res['swipe'], ENT_QUOTES, 'UTF-8') . "</td>";
                break;
            case 'SCAN/ONLINE':
                echo "<td>" . htmlspecialchars($res['ScanOnline'], ENT_QUOTES, 'UTF-8') . "</td>";
                break;
            case 'CASH':
                echo "<td>" . htmlspecialchars($res['Paid'], ENT_QUOTES, 'UTF-8') . "</td>";
                break;
            case 'CHECK':
                echo "<td>" . htmlspecialchars($res['Chno'], ENT_QUOTES, 'UTF-8') . "</td>";
                break;
            case 'BAJA BANK LOAN':
                echo "<td>" . htmlspecialchars($res['utrno'], ENT_QUOTES, 'UTF-8') . "</td>";
                break;
            default:
                echo "<td>Unknown Payment Mode</td>";
                break;
        }

        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No records found</p>";
}
?>
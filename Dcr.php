<?php 
include('include/header.php');
include('include/topbar.php');
include('include/sidebar.php');
?>
<style>
    #paymentDataTable_filter {
        margin-top: 2%;
    }

    .paginate_button {
        margin-left: 10px;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DCR Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">DCR Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="filter-wrapper mb-4">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                        <select id="considerMonth" class="form-control">
  <option value="">Select from month</option>
  <option value="January">January</option>
  <option value="February">February</option>
  <option value="March">March</option>
  <option value="April">April</option>
  <option value="May">May</option>
  <option value="June">June</option>
  <option value="July">July</option>
  <option value="August">August</option>
  <option value="September">September</option>
  <option value="October">October</option>
  <option value="November">November</option>
  <option value="December">December</option>
</select>
                        </div>
                    </div>
                  
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                         
                        <select id="considerYear" name="year" class="form-control">
    <option value="">Select Year</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030</option>
    <option value="2031">2031</option>
    <option value="2032">2032</option>
    <option value="2033">2033</option>
    <option value="2034">2034</option>
    <option value="2035">2035</option>
    <option value="2036">2036</option>
    <option value="2037">2037</option>
    <option value="2038">2038</option>
    <option value="2039">2039</option>
    <option value="2040">2040</option>
</select>


                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                           
                            <select class="form-control" onchange="filterbybranch(this)">
<?php 
$sql = "SELECT * FROM branch";
$result = $con->query($sql);
echo !empty($_GET['branch']) 
    ? '<option value="' . $_GET['branch'] . '">' . ($_GET['branch'] == 'VASAI WEST NEW' ? 'Vasai New' : ($_GET['branch'] == 'I-TECH VASAI WEST' ? 'Vasai Old' : $_GET['branch'])) . '</option>'
    : '<option value="">Select option</option>'; // Default option

// Loop through the database results and populate the select
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Check and modify option text based on value
        $optionText = $row['branch'];
        if ($row['branch'] == "VASAI WEST NEW") {
            $optionText = "Vasai New";
        } elseif ($row['branch'] == "I-TECH VASAI WEST") {
            $optionText = "Vasai Old";
        }

        echo '<option value="' . $row['branch'] . '">' . $optionText . '</option>';
    }
} else {
    echo '<option value="">No options available</option>';
}
?>
                            </select>
                        </div>
                    </div>  
                    <div class="col-md-4 mb-2">
                        <button id="filterByDate" class="btn btn-primary">Filter by Date</button>
                        <button id="resetFilters" class="btn btn-secondary reset-button">Reset Filters</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Payment</h3>
                    
                </div>
                <div class="total-fees-paid" style="margin-left: 2%;
    margin-top: 1%;">
                        <h5>Total Fees Paid : <span id="filteredTotalFeesPaid">0.00</span></h5>
                    </div>
                <div class="card-body table-responsive">
                    <table id="paymentDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                <th>Date</th>
                                <th>Receipt No</th>
                                <th>Counselled By</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Course Fees</th>
                                <th>Fees Paid</th>
                                <th>Balance Fees</th>
                                <th>Mode of Payment</th>
                                <th>UTR No</th>
                                <th>Cheque No</th>
                                <th>Loan Applied Fees</th>
                                <th>Consider in month</th>
                                <th>Consider in year</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th><input type="text" placeholder="search by date (dd-mm-yyyy)" /></th>
                                <th><input type="text" placeholder="Search by receipt"/></th>
                                <th><input type="text" placeholder="Search by received by"/></th>
                                <th><input type="text" Placeholder="Search by name"/></th>
                                <th><input type="text" placeholder="search by Course"/></th>
                                <th><input type="text" placeholder="search by Course Fees"/></th>
                                <th><input type="text" placeholder="search by Fees Paid"/></th>
                                <th><input type="text" placeholder="search by Balance Fees"/></th>
                                <th>
                                    <select id="modeOfPaymentFilter" >
                                        <option value="">Select Payment Mode</option>
                                        <?php
                                        include 'connection/dbcon.php';
                                        $paymentModesQuery = "SELECT modeofpay FROM modeofpay";
                                        $result = mysqli_query($con, $paymentModesQuery);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row['modeofpay']}'>{$row['modeofpay']}</option>";
                                        }
                                        ?>
                                    </select>
                                </th>
                                <th><input type="text" placeholder="search by UTR NO"/></th>
                                <th><input type="text" placeholder="search by Cheque NO"/></th>
                                <th><input type="text" placeholder="search by Loan Fees"/></th>
                                 <th><input type="text" placeholder="search by consider in month"/></th>
                                  <th><input type="text" placeholder="search by consider in year"/></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">

<?php
include 'connection/dbcon.php';
$selectqy = "SELECT * FROM payement 
WHERE inst = '" . $_SESSION['institute'] . "' 
AND status = 'ACTIVE'";

// Check if 'branch' is set in the URL
if (!empty($_GET['branch'])) {
    $branch = $_GET['branch'];
    $selectqy .= " AND branch = '" . $branch . "'";
}

// Add the ORDER BY clause
$selectqy .= " ORDER BY id DESC";
$qy = mysqli_query($con, $selectqy);
$logicalID = 1;
while ($res = mysqli_fetch_array($qy)) {
    $isLoan = stripos($res['ModeOfPayement'], 'loan') !== false;
    $feesPaid = $isLoan ? $res['totalfees'] : $res['Paid'];
    $totalFees = $isLoan ? $res['Paid'] : $res['totalfees'];
?>
                            <tr>
                                <td><?php echo $logicalID++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($res['Dates'])); ?></td>
                                <td><?php 
                                    if (!empty($res['Receipt'])) {
                                     echo $res['Receipt'];
                                    } elseif (!empty($res['manualreceipt'])) {
                                        echo $res['manualreceipt'];
                                    }
                                    ?></td>
                                <td><?php echo $res['front_officer']; ?></td>
                                <td><?php echo $res['name']; ?></td>
                                <td><?php echo $res['course']; ?></td>
                                <td><?php echo $res['courseFees']; ?></td>
                                <td><?php echo $feesPaid; ?></td>
                                <td><?php echo $res['Balance']; ?></td>
                                <td><?php echo $res['ModeOfPayement']; ?></td>
                                <td><?php echo $res['utrno']; ?></td>
                                <td><?php echo $res['Chno']; ?></td>
                                <td><?php echo $totalFees; ?></td>
                                 <td><?php echo $res['ConsiderInMonth']; ?></td>
                                  <td><?php echo $res['ConsiderInYear']; ?></td>
                            </tr>
<?php
}
?> 

                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </section>

    <!-- Include DataTable scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>



    

    <script>
 document.title='Dcr-Report--'
$(document).ready(function () {
    const table = $('#paymentDataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: 'Copy',
                exportOptions: {
                    columns: ':visible', // Export all visible columns
                    format: {
                        body: function (data, row, column, node) {
                            return data; // You can customize the data formatting here
                        }
                    }
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    columns: ':visible', // Export all visible columns
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "Sr no", "Date", "Receipt No", "Counselled By",
                                "Name", "Course", "Course Fees", "Fees Paid",
                                "Balance Fees", "Mode of Payment", "UTR No",
                                "Cheque No", "Loan Applied Fees"
                            ];
                            return headers[columnIdx]; // Use custom headers
                        }
                    }
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                exportOptions: {
                    columns: ':visible', // Export all visible columns
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "Sr no", "Date", "Receipt No", "Counselled By",
                                "Name", "Course", "Course Fees", "Fees Paid",
                                "Balance Fees", "Mode of Payment", "UTR No",
                                "Cheque No", "Loan Applied Fees"
                            ];
                            return headers[columnIdx]; // Use custom headers
                        }
                    }
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    columns: ':visible', // Export all visible columns
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "Sr no", "Date", "Receipt No", "Counselled By",
                                "Name", "Course", "Course Fees", "Fees Paid",
                                "Balance Fees", "Mode of Payment", "UTR No",
                                "Cheque No", "Loan Applied Fees"
                            ];
                            return headers[columnIdx]; // Use custom headers
                        }
                    }
                }
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: ':visible', // Export all visible columns
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "Sr no", "Date", "Receipt No", "Counselled By",
                                "Name", "Course", "Course Fees", "Fees Paid",
                                "Balance Fees", "Mode of Payment", "UTR No",
                                "Cheque No", "Loan Applied Fees"
                            ];
                            return headers[columnIdx]; // Use custom headers
                        }
                    }
                }
            }
        ],
        ordering: true,
       order: [[0, 'asc'], [1, 'desc']], // Sort date column in descending order (index 1)
        paging: true,
        pageLength: 10,
        lengthChange: true,
        language: {
            paginate: {
                previous: "Previous",
                next: "Next"
            }
        },
        initComplete: function () {
            const api = this.api();

            // Function to calculate and update total fees paid based on the filtered rows
            const updateFilteredTotalFeesPaid = () => {
                let totalFeesPaid = 0;

                // Iterate over the filtered rows
                api.rows({ filter: 'applied' }).every(function () {
                    const data = this.data();

                    // Extract the "Fees Paid" value from the column (7th column, index 7)
                    const feesPaidText = data[7]; // Fees Paid is in the 8th column (index 7)
                    const feesPaid = parseFloat(feesPaidText) || 0; // Convert to float, fallback to 0 if NaN
                    totalFeesPaid += feesPaid;
                });

                // Update the filtered total display
                $('#filteredTotalFeesPaid').text(totalFeesPaid.toFixed(2));
            };

            // Initial calculation of total fees paid when page loads
            updateFilteredTotalFeesPaid();

            // Attach event listeners for column filters
            $('#paymentDataTable input').on('keyup change', function () {
                api.search(this.value).draw();
                updateFilteredTotalFeesPaid(); // Update total fees paid when filter is applied
            });
        }
    });
function updateFilteredTotalFeesPaid() {
            let totalFeesPaid = 0;

            // Iterate over the filtered rows
            table.rows({ filter: 'applied' }).every(function () {
                const data = this.data();
                const feesPaidText = data[7]; // Fees Paid is in the 8th column (index 7)
                const feesPaid = parseFloat(feesPaidText) || 0;
                totalFeesPaid += feesPaid;
            });

            // Update the filtered total display
            $('#filteredTotalFeesPaid').text(totalFeesPaid.toFixed(2));
        }
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        const selectedConsiderMonth = $('#considerMonth').val().trim();
        const selectedConsiderYear = $('#considerYear').val().trim();

        const considerMonthColumn = data[13]?.trim(); // "Consider in month" column (index 13)
        const considerYearColumn = data[14]?.trim(); // "Consider in year" column (index 14)

        // Skip rows where "Consider in Month" or "Consider in Year" is empty
        if (!considerMonthColumn || !considerYearColumn) {
            return false;
        }

        // Apply filter logic: check if selected filters match the data in the respective columns
        const isConsiderMonthMatch = !selectedConsiderMonth || considerMonthColumn === selectedConsiderMonth;
        const isConsiderYearMatch = !selectedConsiderYear || considerYearColumn === selectedConsiderYear;

        // Return true if both filters match or are not applied
        return isConsiderMonthMatch && isConsiderYearMatch;
    });

    // Event listener for the Filter button
    $('#filterByDate').on('click', function () {
        table.draw();
         updateFilteredTotalFeesPaid(); // Redraw the table with filters applied
    });

    // Event listener for Reset button
    $('#resetFilters').on('click', function () {
        window.location.href='Dcr.php'
        $('#considerMonth').val('');  // Reset the "Consider in Month" filter
        $('#considerYear').val('');   // Reset the "Consider in Year" filter
       table.search('').draw();
            updateFilteredTotalFeesPaid();// Redraw the table with all data
    });
});
function filterbybranch(e) {
    var branch = e.value; // Get the value of the selected branch
    var currentUrl = window.location.href; // Get the current URL
    var newUrl;

    // Check if the URL already has query parameters
    if (currentUrl.includes("?")) {
        // If "branch" parameter already exists, replace it
        if (currentUrl.includes("branch=")) {
            newUrl = currentUrl.replace(/(branch=)[^&]*/, "$1" + branch);
        } else {
            // Append the "branch" parameter to existing query parameters
            newUrl = currentUrl + "&branch=" + branch;
        }
    } else {
        // Add the "branch" parameter to the URL
        newUrl = currentUrl + "?branch=" + branch;
    }

    // Redirect to the new URL
    window.location.href = newUrl;
}
</script>



<?php 
include('include/footer.php');
?>

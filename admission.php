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
                    <h1 class="m-0">Admission Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Admission Report</li>
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
                            <label class="input-group-text" for="fromDate">From Date</label>
                            <input type="date" id="fromDate" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                            <label class="input-group-text" for="toDate">To Date</label>
                            <input type="date" id="toDate" class="form-control">
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
                        <button id="filterByDates" class="btn btn-primary">Filter by Date</button>
                        <button id="resetFilters" class="btn btn-secondary reset-button">Reset Filters</button>
                    </div>


                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Admission</h3>
                </div>
                <div class="card-body table-responsive">
                    <table id="paymentDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>EDIT</th>
                                <th>ID</th>
                                <th>Admission Date</th>
                                <th>Name</th>
                                <th>Counselled By</th>
                                <th>Contact No</th>
                                <th>Parent No</th>
                                <th>Course</th>
                                <th>Batch</th>
                                <th>Address</th>
                                <th>Fees</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Consider in month</th>
                                <th>Consider in year</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                            <th></th>
                                <th></th> <!-- Removed search input for ID -->
                                <th><input type="text" placeholder="Search by Date" class="column_search" data-column="1" /></th>
                                <th><input type="text" placeholder="Search by Name" class="column_search" data-column="2" /></th>
                                <th><input type="text" placeholder="Search by Counselled By" class="column_search" data-column="3" /></th>
                                <th><input type="text" placeholder="Search by Contact" class="column_search" data-column="4" /></th>
                                <th><input type="text" placeholder="Search by Parent Contact" class="column_search" data-column="5" /></th>
                                <th><input type="text" placeholder="Search by Course" class="column_search" data-column="6" /></th>
                                <th><input type="text" placeholder="Search by Batch" class="column_search" data-column="7" /></th>
                                <th><input type="text" placeholder="Search by Address" class="column_search" data-column="8" /></th>
                                <th><input type="text" placeholder="Search by Fees" class="column_search" data-column="9" /></th>
                                <th><input type="text" placeholder="Search by Paid" class="column_search" data-column="10" /></th>
                                <th><input type="text" placeholder="Search by Balance" class="column_search" data-column="11" /></th>
                                <th><input type="text" placeholder="Search by month" class="column_search" data-column="12" /></th>
                                <th><input type="text" placeholder="Search by year" class="column_search" data-column="13" /></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
<?php
include 'connection/dbcon.php';
$selectqy = "SELECT 
    t1.id AS student_id, 
    t1.name, 
    t1.contact, 
    t1.p_contact, 
    t1.lacture_date, 
    t1.batch_time, 
    t1.course AS student_course, 
    t1.address, 
    t1.branch AS student_branch, 
    t1.faculty_id, 
    t1.password, 
    t1.status AS student_status, 
    t1.id_card, 
    t1.remark AS student_remark, 
    t1.date12, 
    t1.inst AS student_inst, 
    t1.manager AS student_manager, 
    t1.fees AS fees , 
    t1.frontname,
    t1.fees as feescour ,
    t1.PayementType, 
    t1.transfercenter, 
    t1.Activestatus, 
    t1.Emailid,
    t1.month,
    t1.year, 
    t1.date12,
    SUM(t2.Paid) AS total_paid, 
    MIN(t2.Balance) AS last_balance, 
    MAX(t2.Dates) AS last_payment_date, 
    t2.ModeOfPayement, 
    t2.courseFees as coursefee, 
    t2.utrno, 
    t2.inst AS payment_inst, 
    t2.manager AS payment_manager, 
    t2.front_officer, 
    t2.status AS payment_status, 
    t2.branch AS payment_branch, 
    t2.Remark AS payment_remark, 
    t2.files, 
    t2.Approved, 
    t2.Receipt, 
    t2.contact AS payment_contact, 
    t2.ScanOnline, 
    t2.Chno, 
    t2.checkpay, 
    t2.swipe, 
    t2.applicantno, 
    t2.totalfees, 
    t2.namepay, 
    t2.manualreceipt, 
    t2.bankname, 
    t2.Dateofcheck 
FROM 
    student t1 
LEFT JOIN 
    payement t2 ON t1.name_contactid = t2.name_contactid
WHERE 
    t1.inst = '".$_SESSION['institute']."' 
    AND t1.branch IN (" . 
(!empty($_GET['branch']) 
    ? "'" . $_GET['branch'] . "'" 
    : "'VASAI WEST NEW','I-TECH NALLASOPARA-WEST','I-TECH NALLASOPARA-EAST','I-TECH-NERUL','I-TECH VASAI WEST'") 
. ")
    AND t1.Activestatus != 'olddata'
    AND t1.status LIKE '%ACTIVE%'
GROUP BY 
    t1.id -- Group only by the primary identifier of the student
ORDER BY 
    t1.name;
"; 
$qy = mysqli_query($con, $selectqy);
$logicalID = 1; // Start logical ID from 1
while ($res = mysqli_fetch_array($qy)) {
?>
                            <tr>
                            <td><a href="EditAdmission.php?name=<?php echo $res['name']; ?>&contact=<?php echo $res['contact']; ?>&course=<?php echo $res['student_course']; ?>">Edit</a></td>

                                <td><?php echo $logicalID++; ?></td> <!-- Increment logical ID -->
                                <td><?php echo $res['date12']; ?></td>
                                <td><?php echo $res['name']; ?></td>
                                <td><?php echo $res['frontname']; ?></td>
                                <td><?php echo $res['contact']; ?></td>
                                <td><?php echo $res['p_contact']; ?></td>
                                <td><?php echo $res['student_course']; ?></td>
                                <td><?php echo $res['batch_time']; ?></td>
                                <td><?php echo $res['address']; ?></td>
                                <td><?php echo $res['feescour']; ?></td>
                                <td><?php echo $res['total_paid']; ?></td>
                                <td><?php echo $res['last_balance']; ?></td>
                                <td><?php echo $res['month']; ?></td>
                                <td><?php echo $res['year']; ?></td>
                                <td><?php echo 'Action'; ?></td>
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

    <script>
    $(document).ready(function () {
        // Initialize DataTable
      const table = $('#paymentDataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                title: 'Admission Report',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "EDIT","ID", "Admission Date", "Name", "Counselled By", 
                                "Contact No", "Parent No", "Course", "Batch", 
                                "Address", "Fees", "Paid", "Balance", 
                                 "Action"
                            ];
                            return headers[columnIdx];
                        }
                    }
                }
            },
            {
                extend: 'csv',
                title: 'Admission Report',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "EDIT","ID", "Admission Date", "Name", "Counselled By", 
                                "Contact No", "Parent No", "Course", "Batch", 
                                "Address", "Fees", "Paid", "Balance", 
                                 "Action"
                            ];
                            return headers[columnIdx];
                        }
                    }
                }
            },
            {
                extend: 'excel',
                title: 'Admission Report',
                customize: function (xlsx) {
                    const sheet = xlsx.xl.worksheets['sheet1.xml'];
                    const header = '<row r="1"><c t="inlineStr" r="A1" s="1"><is><t>Admission Report</t></is></c></row>';
                    sheet.childNodes[0].childNodes[1].innerHTML = header + sheet.childNodes[0].childNodes[1].innerHTML;
                },
                exportOptions: {
                    columns: ':visible',
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "EDIT","ID", "Admission Date", "Name", "Counselled By", 
                                "Contact No", "Parent No", "Course", "Batch", 
                                "Address", "Fees", "Paid", "Balance", 
                                 "Action"
                            ];
                            return headers[columnIdx];
                        }
                    }
                }
            },
            {
                extend: 'pdf',
                title: 'Admission Report',
                customize: function (doc) {
                    doc.content.splice(0, 0, {
                        text: 'Admission Report',
                        fontSize: 14,
                        alignment: 'center',
                        margin: [0, 0, 0, 10]
                    });
                },
                exportOptions: {
                    columns: ':visible',
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "EDIT","ID", "Admission Date", "Name", "Counselled By", 
                                "Contact No", "Parent No", "Course", "Batch", 
                                "Address", "Fees", "Paid", "Balance", 
                                 "Action"
                            ];
                            return headers[columnIdx];
                        }
                    }
                }
            },
            {
                extend: 'print',
                title: 'Admission Report',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        header: function (data, columnIdx) {
                            const headers = [
                                "EDIT","ID", "Admission Date", "Name", "Counselled By", 
                                "Contact No", "Parent No", "Course", "Batch", 
                                "Address", "Fees", "Paid", "Balance", 
                                 "Action"
                            ];
                            return headers[columnIdx];
                        }
                    }
                }
            }
        ],
        ordering: true,
        order: [[1, 'desc']],
        paging: true,
        pageLength: 10,
        lengthChange: true,
        language: {
            paginate: {
                previous: "Previous",
                next: "Next"
            }
        }
    });

        // Add custom search filter logic for date range
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var admissionDate = data[2]; // assuming 'Admission Date' is in column 1 (zero-indexed)

            if (fromDate && admissionDate < fromDate) {
                return false;
            }
            if (toDate && admissionDate > toDate) {
                return false;
            }

            return true;
        });

        // Filter by date button
        $('#filterByDates').click(function () {
            table.draw();
        });

        // Reset filters
        $('#resetFilters').click(function () {
            window.location.href='admission.php'
            $('#fromDate').val('');
            $('#toDate').val('');
            table.draw();
        });

        // Apply column-specific search filters
        $('input.column_search').on('keyup change', function () {
            var columnIndex = $(this).data('column'); // Get the column index from the data-column attribute
            table.column(columnIndex).search(this.value).draw();
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

</div>
</body>
</html>

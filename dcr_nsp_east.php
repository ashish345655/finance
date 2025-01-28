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
                    <h1 class="m-0">DCR Report NSP East</h1>
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
                        <label for="fromdate">From</label>
                        <input type="date" class="form-control" id="fromdate">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="todate">To Date</label>
                        <input type="date" class="form-control" id="todate">
                    </div>
                    <div class="col-md-4 mb-2">
                      <button id="filterByDate" class="btn btn-primary" style="margin-top: 8%;">Filter by Date</button>
                        <button id="resetFilters" class="btn btn-secondary" style="
    margin-top: 8%;
">Reset Filters</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Payment</h3>
                </div>
                <div class="total-fees-paid" style="margin-left: 2%; margin-top: 1%;">
                    <h5>Total Fees Paid : <span id="filteredTotalFeesPaid">0.00</span></h5>
                </div>
                <div class="card-body table-responsive">
                    <table id="paymentDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Edit</th> <!-- Moved Edit column to the first position -->
                                <th>Sr No</th>
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
                                <th>Consider in Month</th>
                                <th>Consider in Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'connection/dbcon.php';
                            $selectqy = "SELECT * FROM payement 
                                         WHERE inst = '".$_SESSION['institute']."' 
                                         AND branch = 'I-TECH NALLASOPARA-EAST' 
                                         AND status like '%ACTIVE%'
                                         ORDER BY id DESC"; 
                            $qy = mysqli_query($con, $selectqy);
                            $logicalID = 1;
                            while ($res = mysqli_fetch_array($qy)) {
                                $isLoan = stripos($res['ModeOfPayement'], 'loan') !== false;
                                $feesPaid = $isLoan ? $res['totalfees'] : $res['Paid'];
                                $totalFees = $isLoan ? $res['Paid'] : $res['totalfees'];
                            ?>
                                <tr>
                                    <td><a href="editdcr.php?id=<?php echo $res['id']; ?>">Edit</a></td> <!-- Moved Edit column to the first position -->
                                    <td><?php echo $logicalID++; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($res['Dates'])); ?></td>
                                    <td><?php echo $res['Receipt'] ?: $res['manualreceipt']; ?></td>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function () {
    // Get current date and first date of the month
    const currentDate = new Date();
    const firstDateOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

    // Function to format the date as "YYYY-MM-DD"
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    // Set default values for the date inputs
    $('#fromdate').val(formatDate(firstDateOfMonth));
    $('#todate').val(formatDate(currentDate));

    // Initialize the DataTable
    const table = $('#paymentDataTable').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        order: [[1, 'asc']], // Set the order to Sr No (now in the second column)
        paging: true,
        pageLength: 10
    });

    // Custom search for the date column
    $.fn.dataTable.ext.search.push(function (settings, data) {
        const fromDate = $('#fromdate').val();
        const toDate = $('#todate').val();
        const rowDate = new Date(data[2].split('-').reverse().join('-')); // Column index 2 for Date

        // Apply filter only if the rowDate is within the selected range
        return (!fromDate || rowDate >= new Date(fromDate)) && 
               (!toDate || rowDate <= new Date(toDate));
    });

    // Redraw table after custom date filter is applied
    table.draw();

    // Update filtered total fees paid
    function updateFilteredTotalFeesPaid() {
        let totalFeesPaid = 0;
        table.rows({ filter: 'applied' }).every(function () {
            const feesPaid = parseFloat(this.data()[8]) || 0;
            totalFeesPaid += feesPaid;
        });
        $('#filteredTotalFeesPaid').text(totalFeesPaid.toFixed(2));
    }

    // Apply date filter when "Filter by Date" button is clicked
    $('#filterByDate').click(function () {
        table.draw();
        updateFilteredTotalFeesPaid();
    });

    // Reset date filters
    $('#resetFilters').click(function () {
        $('#fromdate, #todate').val('');
        table.search('').draw();
        updateFilteredTotalFeesPaid();
    });

    // Individual column search functionality
    $('#paymentDataTable th').each(function (index) {
        const column = table.column(index);
        if (index !== 0 && index !== 1) { // Skip Sr No and Date columns if needed
            $(this).append(
                '<input type="text" placeholder="Search" class="column-filter" />'
            );

            $(this).find('.column-filter').on('keyup', function () {
                column.search(this.value).draw();
            });
        }
    });

    // Initial update of the total fees paid
    updateFilteredTotalFeesPaid();
});


</script>

<?php include('include/footer.php'); ?>

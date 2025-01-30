<?php 
include('include/header.php');
include('include/topbar.php');
include('include/sidebar.php');
include 'connection/dbcon.php';





$id =$_GET['id'];
$inst = $_SESSION['institute'];

$payedit = []; 
$sql = "SELECT * FROM payement where id ='$id' and inst ='$inst'"; 
$result = mysqli_query($con, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $payedit = $row;
    }
} 

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
                    <h1 class="m-0">Edit Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
        <div class="card">
  <div class="card-body">
  <form>
  <div class="row">
    <div class="col-6 mt-2">
        <label for="">Name</label>
      <input type="text" value ='<?php echo $payedit['name']  ?>' name ="name" class="form-control" placeholder="First name" readonly>
   <input type="hidden" value ="<?php echo $id ?>" id="id" >
    </div>
    <div class="col-6 mt-2">
    <label for="">Date</label>
      <input type="date" value ='<?php echo $payedit['Dates']  ?>'  name ="Date" class="form-control" placeholder="Last name" readonly>
    </div>
    <div class="col-6 mt-2">
    <label for="">Paid Fees</label>
      <input type="text" name ="Paid Feees" class="form-control"  value ='<?php echo $payedit['Paid']  ?>' placeholder="Last name" readonly>
    </div>
    <div class="col-6 mt-2">
    <label for="">Course Fees</label>
      <input type="text" name ="Coursefees" class="form-control" value ='<?php echo $payedit['courseFees']  ?>' Paidplaceholder="Last name" readonly>
    </div>
    <div class="col-6 mt-2">
    <label for="">Balance</label>
      <input type="text" name ='balance' class="form-control" value ='<?php echo $payedit['Balance']  ?>' placeholder="Last name" readonly>
    </div>
    <div class="col-6 mt-2">
    <label for="">Course</label>
      <input type="text" name ='balance' class="form-control" value ='<?php echo $payedit['course']  ?>' placeholder="Last name" readonly>
    </div>
       <div class="col-6 mt-2">
    <label for="">Update Status</label>
    <select class="form-control" id="status">
        <option value='<?php echo $payedit['status']  ?>'><?php echo $payedit['status']  ?></option>
        <option value='Disabled'>Disabled</option>
    </select>
      
    </div>
    <div class="col-6 mt-2">
    <label for="">Consider in month</label>
    <select id="Considerinmonth" class="form-control">
        <option value="<?php echo $payedit['ConsiderInMonth']  ?>"><?php echo $payedit['ConsiderInMonth']  ?></option>
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
    <div class="col-6 mt-2">
    <label for="">Consider in year</label>
    <select id="Considerinyear" name="year" class="form-control">
    <option value="<?php echo $payedit['ConsiderInYear']  ?>"><?php echo $payedit['ConsiderInYear']  ?></option>
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
  <button type="button" id="btnsumit" class="btn btn-danger mt-2" style="float:right;">Upate</button>
</form>
  </div>
</div>
        </div>
    </section>

    <!-- Incl3ude DataTable scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>



    

    <script>
 $(document).ready(function() {
    $('#btnsumit').click(function(e) {
        e.preventDefault();  
status = $('#status').val();
var currentDate = new Date();
var currentMonth = currentDate.getMonth() + 1; // getMonth() returns 0-11, so add 1
var currentYear = currentDate.getFullYear();

// Get the input values
var Considerinmonth = $('#Considerinmonth').val();
var Considerinyear = $('#Considerinyear').val();

// Convert the month name to a number (1-12)
var monthNames = ["January", "February", "March", "April", "May", "June", 
                  "July", "August", "September", "October", "November", "December"];
var inputMonth = monthNames.indexOf(Considerinmonth) + 1;

// Convert the input year to a number
var inputYear = parseInt(Considerinyear, 10);

// Validate the input
if (inputYear > currentYear || (inputYear === currentYear && inputMonth > currentMonth)) {
    alert("The month and year should not be in the future.");
}
else{
    var formData = {
            Considerinmonth: Considerinmonth,
            Considerinyear: Considerinyear,
            id:$('#id').val(),
            status:status
        };

        // AJAX request
        $.ajax({
            url: 'function/Considerdata.php',  // Server-side script that will handle the POST data
            type: 'POST',
            data: formData,  // Data to send
            success: function(response) {
                
                alert(response)
            },
            error: function(xhr, status, error) {
                // Handle errors
                $('#response').html("Error: " + error);
            }
        });
}
      
    });
});

</script>



<?php 

?>

<?php 

include('include/header.php');
include('include/topbar.php');
include('include/sidebar.php');

include 'connection/dbcon.php';

$id=$_GET['usrid'];

$sql = "SELECT * FROM payement where id='$id'";
$result = $con->query($sql);
  $row = $result->fetch_assoc();






?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">



    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">New Student</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-info col-12">
                <div class="card-header">
                    <h3 class="card-title">New Student Record Add</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="">
                    <div class="card-body">
                        <div class="form-group row">
                           
                         <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                   <input type="text" class="form-control" value="<?php echo  $row['name']; ?>" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Payment  Status</label>
                                    <select  class="form-control" name="status" required>
                                    <option value="Done">Done</option>
                                    <option value="Not Done">Not Done</option>
                                    <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                   
                     
                       



                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                        <!-- /.card-footer -->
                </form>

            </div>
            <!-- /.card-->

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>




    <!-- /.content -->
</div>


<?php
include('include/footer.php');
?>

<?php


if(isset($_POST['submit']))
{ 
		$status = $_POST['status'];
        
        $query ="Update payement set Approved='$status' where id='$id'";

     $query_run = mysqli_query($con, $query);
    if($query_run){
        echo " <script>  
                alert('Changes Apply Successfully');
                
              </script> ";

   }else{
    echo " <script>  alert('Some Data is not Correct'); </script> ";
    
   }


}
?>

<script>

</script>
<?php 

include('include/header.php');
include('include/topbar.php');
include('include/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">



    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payement </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Payement</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payement</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Mode of Pay</th>
            <th>Details</th>
            <th>View Receipt</th>
            <th>Action Button</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        include 'connection/dbcon.php';

        $selectqy = "SELECT * FROM payement  ORDER BY id ASC";
        $qy = mysqli_query($con, $selectqy);

        if ($qy && mysqli_num_rows($qy) > 0) {
            while ($res = mysqli_fetch_assoc($qy)) {
        ?>
                <tr>
                    <td><?php echo $res['id']; ?></td>
                    <td><?php echo htmlspecialchars($res['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($res['ModeOfPayement'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php
                        // Display the appropriate details based on the payment mode
                        switch ($res['ModeOfPayement']) {
                            case 'SWIPE':
                                 echo '<a href="/front_office/function/uploaded_files/' . htmlspecialchars($res['swipe'], ENT_QUOTES, 'UTF-8') . '" target="_blank">Receipt <i class="fas fa-receipt" title="Receipt"></i></a>';
                                break;
                            case 'SCAN/ONLINE':
                                 echo '<a href="/front_office/function/uploaded_files/' . htmlspecialchars($res['ScanOnline'], ENT_QUOTES, 'UTF-8') . '" target="_blank">Receipt <i class="fas fa-receipt" title="Receipt"></i></a>';
                                break;
                            case 'CASH':
                                echo htmlspecialchars($res['Paid'], ENT_QUOTES, 'UTF-8');
                                break;
                            case 'CHECK':
                                echo htmlspecialchars($res['Chno'], ENT_QUOTES, 'UTF-8');
                                break;
                            case 'BAJA BANK LOAN':
                                echo htmlspecialchars($res['utrno'], ENT_QUOTES, 'UTF-8');
                                break;
                            default:
                                echo "Unknown Payment Mode";
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <a href="Updatefiinfo.php?usrid=<?php echo $res['id']; ?>" style="text-decoration: none; color:red;">
                            <i class="fas fa-edit" title="UPDATE"></i>
                        </a>
                    </td>
                    <td>
                        <a href="Viewreceipt.php?usrid=<?php echo $res['id']; ?>" style="text-decoration: none; color:red;">
                            <i class="fas fa-eye"></i> &nbsp;&nbsp;View
                        </a>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>

                </div>
                <!-- /.card-body   active_action.php  -->
            </div>




            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>




    <!-- /.content -->
</div>


<?php
include('include/footer.php');
?>
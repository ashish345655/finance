
<?php
// Check the condition and set the session variable or the image path accordingly
$images=$_SESSION['institute']=='I TECH'?'logo.png':'speak.jpg';

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="../assets/dist/img/<?php echo $images; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b><?php echo $_SESSION['institute']; ?></b></span>
    </a>

<?php

include 'connection/dbcon.php';


?>



    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="home.php" class="d-block"><span></span></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        
       
          <li class="nav-item">
            <a href="home.php" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
              <p>
               Edit DCR Month
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="dcr_nsp_west.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DCR NSP WEST</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dcr_nsp_east.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DCR NSP EAST</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dcr_vasai_old.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DCR VASAI OLD</p>
                </a>
              </li>  <li class="nav-item">
                <a href="dcr_vasai_new.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DCR VASAI NEW</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="dcr_nerul.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DCR NERUL </p>
                </a>
              </li>
           
            </ul>
          </li>
          <li class="nav-item">
            <a href="home.php" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
              <p>
               Dcr Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="Dcr.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DCR Report details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Admissionreportwise.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admission Report</p>
                </a>
              </li>
             
             
            </ul>
          </li>
          <li class="nav-item">
                <a href="admission.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Admission Report</p>
                </a>
              </li>
          <li class="nav-header">ACTION</li>
          <!-- <li class="nav-item">
            <a href="view_batch.php" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
              <p>
               Add & View Batch
              </p>
            </a>
          </li> -->
       
          <li class="nav-item"> 
            <a href="password.php" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
              <p>
               Change Password
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
               LOGOUT
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
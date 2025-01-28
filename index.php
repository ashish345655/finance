<?php 

session_start();

// Initialize the error message variable
$error = '';

include 'connection/dbcon.php';
if (isset($_POST['submit'])) {

        $Email=$_POST['Email'];
        $Password=$_POST['Password'];


        // Use prepared statements to prevent SQL injection
        $select = $con->prepare("SELECT * FROM `finance` where username = ?  and password = ?");
        print_r($select);
        $select->bind_param("ss", $Email, $Password);
        $select->execute();
        $result = $select->get_result();
      
        if ($result->num_rows > 0) {
            $row =$result->fetch_assoc();
            // If login is successful, set the session variable and redirect to the dashboard
           $_SESSION['Email'] = $Email;
           $_SESSION['name'] = $row['name'];
           $_SESSION['institute'] = $row['inst'];
            header("location:Payementfiance.php");
            exit(); // Ensure script execution stops after the redirection
        } else {
            // If login fails, set an error message
            $error = 'Login Failed: Check Username And Password';
        }
        $select->close();
        
        
    }

 ?>

<!doctype html>

<html lang="en"> 

 <head> 

  <meta charset="UTF-8"> 

  <title>Login Page</title> 

  <link rel="stylesheet" href="../admin/css/style.css"> 
  
        <!-- title bar icon -->
      <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png">

      <script type="text/javascript">
            window.history.forward();
            function noBack()
            {
                window.history.forward();
            }
        </script>
  

 </head> 

 <body> <!-- partial:index.partial.html --> 

  <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 

   <form class="signin" method="post"> 

    <div class="content"> 

     <h2>Sign In</h2> 

        <!-- Display error message, if any -->
       <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

     <div class="form"> 

      <div class="inputBox"> 

       <input type="text" required name="Email"> <i>USER NAME</i> 

      </div> 

      <div class="inputBox"> 

       <input type="Password" required name="Password"> <i>Password</i> 

      </div> 

      <div class="links"> <a href="#">Forgot Password</a>  

      </div> 

      <div class="inputBox"> 

       <input type="submit" name="submit" value="Login">

      </div> 

     </div> 

    </div> 

   </form> 

  </section> <!-- partial --> 

 </body>

</html>



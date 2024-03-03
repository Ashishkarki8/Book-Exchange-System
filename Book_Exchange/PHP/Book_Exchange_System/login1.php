<?php 
session_start();
include "./config.php"; 
?>
<?php 
      if(isset($_POST['login'])){
      $username = mysqli_real_escape_string($conn,$_POST['username'] );   
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      $sql = "SELECT Passwords, Admin_Id, Name, Email, Image FROM admin WHERE Email ='$username'";
      $sql_2 = "SELECT Passwords, User_Id, Name, Email, Image FROM users WHERE Email ='$username'";
      $result = mysqli_query($conn, $sql);
      $result_2 = mysqli_query($conn, $sql_2);
      
      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['Passwords'];
        // Check if the user-entered password matches the hashed password in the database
        if (password_verify($password, $hashed_password)){                                                                     
          $status = "Active now";
          $sql_3 = mysqli_query($conn, "UPDATE admin SET Status = '{$status}' WHERE Admin_Id = {$row['Admin_Id']}");
          $_SESSION["Select_Admin"] = $row['Admin_Id'];
          $_SESSION["Logged_Admin_name"] = $row['Name'];
          $_SESSION["Logged_Admin_Image"] = $row['Image']; 
          header("Location:/book_exchange/php/Book_Exchange_System/Admin_Features/Admin_panel.php");
          
        } else {
          echo '<script>alert("Sorry Your Password is Incorrect")</script>';
        }
        }
        else if($result_2 && mysqli_num_rows($result_2) > 0){  
          $row_2 = mysqli_fetch_assoc($result_2);
          $hashed_password_2 = $row_2['Passwords'];
          if (password_verify($password, $hashed_password_2)){                                                                         
          $status = "Active now";
          $sql_4 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE User_Id = {$row_2['User_Id']}");
          $_SESSION["Select_user"] = $row_2['User_Id']; 
          $_SESSION["Logged_Username"] =$row_2['Name'];
          $_SESSION["Logged_Username_Image"] = $row_2['Image'];                                                
          header("Location:/book_exchange/php/Book_Exchange_System/Users_Features/User_panel.php");
        } else {
          echo '<script>alert("Sorry.Your Password is Incorrect")</script>';
          
        } 
        } 
    else {
        echo '<script>alert("Sorry. Email is not Found. Please Re-check")</script>';
    }  
    } 
?>

<?php
include_once dirname(__FILE__) . '/header.php'; ?>    <!-- To open file permison -->
<style>
    .login-image {
      height: 85%;
      object-fit: cover;
    }
    /* Added style to decrease font-size of form elements */
    form input[type="email"], form input[type="password"] {
      font-size: 0.9rem;
    }
    form label {
      font-size: 0.9rem;
    }
  </style>
<body>
  <section class="vh-100 d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mx-auto">
          <div class="card shadow-lg">
            <div class="card-body p-5">
              <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">Book Exchange System Login</h1>
              </div>
              <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Email address</label>
                  <input type="email" id="username" name="username" class="form-control form-control-lg" placeholder="Enter your email address" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter your password" required>
                </div>
                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary btn-lg mt-4">Login</button>
                </div>
              </form>
              <div class="text-center mt-5">
                <p>Don't have an account? <a href="add.php" class="link-info">Register here</a></p>
                <div class="text-center mt-5">
                <a href="../../index.html" class="btn btn-primary btn-lg">Back to Home</a>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block px-0">
          <img src="./login.jpg" alt="Login image" class="login-image" style="width: 106%;" >
        </div>
      </div>
    </div>
  </section>
</body>
</html>


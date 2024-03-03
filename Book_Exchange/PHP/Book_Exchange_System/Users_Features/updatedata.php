<?php 
    include "../header.php";
    include_once "../config.php";
    $stu_id=mysqli_real_escape_string($conn, $_POST['sid']);
    $stu_name=mysqli_real_escape_string($conn, $_POST['sname']);
    $User_email=mysqli_real_escape_string($conn, $_POST['email']);
    $User_password=mysqli_real_escape_string($conn,$_POST['password']);
    $encrypt_pass = password_hash($User_password,PASSWORD_DEFAULT);
    $stu_address=mysqli_real_escape_string($conn, $_POST['address']);
    $stu_phone=mysqli_real_escape_string($conn, $_POST['phone']);
    $check_query = "SELECT * FROM users WHERE (Email='{$User_email}' OR Phone='{$stu_phone}') AND User_id != {$stu_id}";   //
    $check_result = mysqli_query($conn, $check_query);                     
    if (mysqli_num_rows($check_result) > 0 ) {
    echo '<div class="alert alert-danger alert-dismissible fade show rounded-15 border-0" role="alert">
          The email or phone number already exists.
          <a href="./Edit_Personal_Details.php" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
      </div>';
} else {   // Update the record
    $sql = "UPDATE users SET User_Id='{$stu_id}', Name='{$stu_name}', Email='{$User_email}', Passwords='{$encrypt_pass}', Address='{$stu_address}', Phone='{$stu_phone}' WHERE User_Id='{$stu_id}'";
    $results = mysqli_query($conn, $sql);
    if (!$results) {
        $error_message = mysqli_error($conn);
        echo '<div class="alert alert-danger alert-dismissible fade show rounded-0 border-0" role="alert">
              Error: ' . $error_message . '
              <button type="button" class="btn-close" data-bs-dismiss="alert" href="./All_users.php" aria-label="Close"></button>
          </div>';
    } else {
          session_start();
          $_SESSION["Select_user"] = $stu_id; 
          $_SESSION["Logged_Username"] =$stu_name;
          session_status();
          session_write_close();
       echo '<script>alert("Update is successful")</script>';
        include "./User_panel.php";
        
    }
}

  
?>

   
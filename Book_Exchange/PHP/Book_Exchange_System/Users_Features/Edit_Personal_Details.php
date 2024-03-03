</head>
<body>
  <?php include '../header.php'; ?>
<div id="main-content">
<?php 
  session_start();
  if (!isset($_SESSION["Select_user"])) {
     session_unset();
     session_destroy();
     header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
     exit();
}
  ?>
    <?php
   include_once "../config.php";
   $sql = "SELECT * FROM users WHERE User_Id ={$_SESSION["Select_user"]}";        
   $result = mysqli_query($conn, $sql);
   if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
     ?> 
     <?php include "./header.php"   ?>
      <div class="container my-5">
        <h2>User Form</h2>
        <form class="post-form" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" method="POST" >     
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="sname" placeholder="" required value="<?php echo ($row['Name'])?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email"  class="form-control" name="email" placeholder="" required value="<?php echo($row['Email'])?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" placeholder="" required value="<?php echo($row['Passwords']) ?>" />
                </div>
         </div>

         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" placeholder="" required value="<?php echo($row['Phone']) ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" placeholder="" required value="<?php echo($row['Address']) ?>" />
                </div>  
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Select Image</label>
                <div class="col-sm-6" class="field image">
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" >  <!-- for image mathi cha -->
                </div>
         </div>
         
         <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button name="save" type="submit" class="btn btn-primary">Update</button>
            </div>
            <div class="col-sm-3  d-grid">
                 <a class="btn btn-outline-primary"  href='./User_panel.php' role="button">cancel</a>
            </div>
         </div>
        </form>
    </div>  
   <?php  } ?>
   <?php 

    if(isset($_POST['save'])){
       $stu_name=mysqli_real_escape_string($conn, $_POST['sname']);
       $User_email=mysqli_real_escape_string($conn, $_POST['email']);
       $User_password=mysqli_real_escape_string($conn,$_POST['password']);
       if($User_password == $row['Passwords']){                                     //checks if user has made any changes while updating password or not 
        $encrypt_pass = $User_password;
       }else{
        $encrypt_pass = password_hash($User_password,PASSWORD_DEFAULT);   
       }
       $stu_address=mysqli_real_escape_string($conn, $_POST['address']);
       $stu_phone=mysqli_real_escape_string($conn, $_POST['phone']);
       $check_query = "SELECT * FROM users WHERE (Email='{$User_email}' OR Phone='{$stu_phone}') AND User_id != {$_SESSION["Select_user"]}";   //
       $check_result = mysqli_query($conn, $check_query);                     
       if (mysqli_num_rows($check_result) > 0 ) {
       echo '<div class="alert alert-danger alert-dismissible fade show rounded-15 border-0" role="alert">
          The email or phone number already exists.
          <a href="./Edit_Personal_Details.php" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
      </div>';
} else {  
  if(isset($_FILES['image'])){
    $img_name = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];           
    $img_explode = explode('.',$img_name);
    $img_ext = end($img_explode);
    $extensions = ["jpeg", "png", "jpg"];
    if(in_array($img_ext, $extensions) === true){
        $types = ["image/jpeg", "image/jpg", "image/png"];
        if(in_array($img_type, $types) === true){
            $time = time();
            $new_img_name = $time.$img_name;
            if(move_uploaded_file($tmp_name,"../images/".$new_img_name)){            
                $sql_8 = "SELECT Image FROM users WHERE User_Id = {$_SESSION["Select_user"]}";
                $result = mysqli_query($conn, $sql_8);
                $row_8 = mysqli_fetch_assoc($result);
                $Delete_old_picture = $row_8['Image'];
                $file_location = "../images/" . $Delete_old_picture;
                if (file_exists($file_location)) {
                    unlink($file_location);
                }                             
                $insert_query = mysqli_query($conn, "UPDATE users SET Image='{$new_img_name}' WHERE User_Id='{$_SESSION["Select_user"]}'");
                $_SESSION["Logged_Username_Image"] =$new_img_name ;
        }
    }
    }
}         
          $sql_2 = "UPDATE users SET Name='{$stu_name}', Email='{$User_email}', Passwords='{$encrypt_pass}', Address='{$stu_address}', Phone='{$stu_phone}' WHERE User_Id='{$_SESSION["Select_user"]}'";
          $results = mysqli_query($conn, $sql_2);
          $_SESSION["Logged_Username"] =$stu_name;
          echo "<script>
                            alert('Update Sucessfull');
                            window.location.href='./Edit_Personal_Details.php';
                            </script>";
}

}
  
?>
</div> 
</body>
<?php include "./Footer.php"   ?>
</html>



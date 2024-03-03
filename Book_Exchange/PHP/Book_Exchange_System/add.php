<!-- To add the user in the database -->
<?php
include_once "config.php";
if(isset($_POST['save'])){
 
 $name = mysqli_real_escape_string($conn,$_POST["name"]);                /* obtains the value from the text field and stores insuperglobal variable ) */
 $email = mysqli_real_escape_string($conn,$_POST["email"]);
 $password = mysqli_real_escape_string($conn,$_POST["password"]);         /* mysqli_real_escape_string removes unwanted string */
 $phone = mysqli_real_escape_string($conn,$_POST["phone"]);
 $address = mysqli_real_escape_string($conn,$_POST["address"]);
 
 $sql  ="SELECT Email FROM users where Email='{$email}'";
 $sql_1 = "SELECT Phone FROM users where Phone='{$phone}'";  

 $result = mysqli_query($conn, $sql) or die("Query uncessfull");
 $result_1 = mysqli_query($conn, $sql_1) or die("Query uncessfull");

    if(mysqli_num_rows($result)>0){
        echo '<script>alert("Email already exists.Please recheck.")</script>';
    }
    elseif(mysqli_num_rows($result_1)>0){
        echo '<script>alert("Phone number already exists.Please recheck.")</script>';
        }
    else{
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
                    if(move_uploaded_file($tmp_name,"images/".$new_img_name)){                                             
                        $status = "Active now";
                        $encrypt_pass = password_hash($password,PASSWORD_DEFAULT);
                        $insert_query = mysqli_query($conn, "INSERT INTO users (Name, Email, Passwords, Phone, Address, Image,Status)
                        VALUES ('{$name}','{$email}', '{$encrypt_pass}', '{$phone}', '{$address}' ,  '{$new_img_name}', '{$status}')");

                         echo "<script>
                            alert('User Added successfully! Please proceed for login');
                            window.location.href='./login1.php';
                            </script>";                                                                                              
                    }
                }else{
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }else{
                echo "Please upload an image file - jpeg, png, jpg";
            }
        } 
    }
    
}      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "./Users_Features/header.php"   ?>
    <div class="container my-5">
        <h2>User Form</h2>
        <form action="<?php  $_SERVER['PHP_SELF'];  ?>" method="POST" enctype="multipart/form-data">     <!-- enctype="multipart/form-data" is used for working with files -->
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" placeholder="" required values="<?php echo $name; ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email"  class="form-control" name="email" placeholder="" required values="<?php echo $email; ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" placeholder="" required values="<?php echo $password; ?>" />
                </div>
         </div>

         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" placeholder="" required values="<?php echo $phone; ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" placeholder="" required values="<?php echo $address; ?>" />
                </div>  
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Select Image</label>
                <div class="col-sm-6" class="field image">
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>  
                </div>
         </div>
         <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button name="save" type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3  d-grid">
                 <a class="btn btn-outline-primary"  href='./login1.php' role="button">cancel</a>
            </div>
         </div>
        </form>
    </div>  
</body>
<?php include "./Users_Features/footer.php"   ?>
</html>

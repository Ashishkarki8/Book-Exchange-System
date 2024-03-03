<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
  <style>
    .navbar-brand img {
      height: 20px;
    }
    .profile-img {
      width: 35px;
      height: 35px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: 70px;
    }
  </style>
</head>
<body>
  <?php session_start(); ?>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">All exchange details</a>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="./../Users_Features/logout.php" class="btn btn-danger" onclick="logout()">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container my-4" >
  <form action="<?php  $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="request_status">Request Status:</label>
    <select name="request_status" id="request_status">
    <option value="">Select any one option</option>
    <option value="Accepted">Accepted Request</option>
    <option value="Rejected">Rejected Request</option>
    <option value="Pending">Pending</option>
</select>
    <input type="submit" value="Submit">
</form>
<div class="col-sm-3 d-grid" style="margin-top: 4px;">
        <a class="btn btn-info btn-small custom-class" value="login_button" href="./Exchange_Details.php" role="button">Reload</a>
        <a class="btn btn-info btn-small custom-class" value="login_button" href="./Admin_panel.php" role="button">Back</a>
    </div>
  <?php 
     include_once "../config.php";
    $sql = "SELECT * FROM request_details";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $request_status = $_POST["request_status"];
        
        if ($request_status == "Accepted") {
            $sql = "SELECT * FROM request_details WHERE Request_Status='Accepted'";  
        }
        else if ($request_status == "Rejected") {
            $sql = "SELECT * FROM request_details WHERE Request_Status='Rejected'";  
        }
        else if ($request_status == "Pending") {
            $sql = "SELECT * FROM request_details WHERE Request_Status =' '";  
        }
        else {
        }
    }
    
    $result = mysqli_query($conn, $sql) or die("Query uncessfull");
    if(mysqli_num_rows($result)>0){                               
    ?>
    
    <table cellpadding="7px">
        <thead>
            <th>Details</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php 
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo" User having a Id " .  $row['User_Id'] . " has sent a request to  User having User Id " .  $row['Post_Owner_Id'] . " For a book post Id ". $row['Post_Id'] ." At " . $row['Requested_At']  ?></td>
                <td> <?php echo " It is " . $row['Request_Status'] ?></td>
            </tr>
                <?php } ?>
            </tbody>
    </table>
    <?php } 
    else{
        echo" <h2>No record Found</h2>";    
    }                
     ?> 
</div>
</body>
</html>

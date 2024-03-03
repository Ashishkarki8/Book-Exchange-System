<?php 
  session_start();
  if (!isset($_SESSION["Select_Admin"])) {
     session_unset();
     session_destroy();
     header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
     exit();
}
  ?>
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

  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Book Exchange System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
          <h1 style="color: white; font-family: Arial, sans-serif;">All Users</h1>
          </li>
        </ul>
      </div>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <img class="profile-img" src="../images/<?php echo($_SESSION["Logged_Admin_Image"])?>" alt="Profile Image">
          <a class="nav-link" href="#"><?php echo ($_SESSION["Logged_Admin_name"])?></a>
          <a href="./../Users_Features/logout.php" class="btn btn-danger" onclick="logout()">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="container my-4" >
        <form class="form-inline my-2 my-lg-0" method ="POST">
            <input class="form-control mr-sm-2" type="number" placeholder="Search User Id" aria-label="Search" id="search-input" placeholder="" required name="obtained_text" >
            <button class="btn btn-primary my-2 my-sm-0" type="submit" id="search-btn" name="search_btn">Search</button>
        </form> 
  <?php 
     include_once "../config.php";
    if (isset($_POST["search_btn"])) {
        $Searched_User_Id = mysqli_real_escape_string($conn,$_POST["search_btn"]);
        $sql = "SELECT * FROM users WHERE User_Id={$_POST["obtained_text"]}";        
    }
    else {
        $sql = "SELECT * FROM users";  
    }
    $result = mysqli_query($conn, $sql) or die("Query uncessfull");
    if(mysqli_num_rows($result)>0){                               
    ?>
    <table cellpadding="7px">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
            <th>Created_At</th>
            
        </thead>
        <tbody>
            <?php 
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['User_Id'] ?></td>
                <td><?php echo $row['Name'] ?></td>
                <td><?php echo $row['Email'] ?></td>
                <td><?php echo $row['Phone']?></td>
                <td><?php echo $row['Address']?></td>
                <td><?php echo $row['Status']?></td>
                <td><?php echo $row['Created_At']  ?></td> 
                <td>
                <a href='delete_users.php?delete_id=<?php  echo ($row['User_Id']); ?>' class='btn btn-danger'>Delete</a>
                </td>
            </tr>
                <?php } ?>
            </tbody>
    </table>
    <div class="col-sm-3  d-grid">
    <a class="btn btn-info btn-lg custom-class" value="login_button"  href='./Admin_panel.php' role="button">Back to home</a>
            </div>
    <?php } 
    else{
        echo" <h2>No record Found</h2>";    
        echo '
        <div class="col-sm-3 d-grid" style="margin-top: 250px;">
        <a class="btn btn-info btn-lg custom-class" value="login_button" href="./All_users.php" role="button">Refresh Once</a>
    </div>
';  
    }
     ?> 
</div>
</body>

</html>


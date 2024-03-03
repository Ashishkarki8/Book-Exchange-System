

<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .navbar-brand img {
      height: 80px;
    }
    .profile-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: 70px;
    }
    
    .navbar-nav .nav-link {
      font-size: 20px;
      transition: color 0.1s ease-in-out;
    }
    .navbar-nav .nav-link:hover {
      color: #FFFFFF;
    }
  </style>
</head>
<body>
<?php 
  session_start();
  if (!isset($_SESSION["Select_Admin"])) {
     session_unset();
     session_destroy();
     header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
     exit();
}
  ?>

 <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand">Book Exchange System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" >Admin Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./All_users.php">All Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Exchange_Details.php">All Exchange Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://mail.google.com/mail/u/0/#inbox">Received Email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Add_pdf.php">Add PDF</a>
        </li>
      </ul>
    </div>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <img class="profile-img" src="../images/<?php echo($_SESSION["Logged_Admin_Image"])?>">
        <a class="nav-link active"><?php  echo ($_SESSION["Logged_Admin_name"])?></a>
         <!-- <a class="nav-link" href="#">Logout</a> -->
         <a href="../Users_Features/logout.php" class="btn btn-danger" onclick="logout()">Logout</a>
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" href="#">Logout</a> -->
      </li>
    </ul>
  </div>
</nav>

<div class="container my-4">
  <h1 class="text-center">Welcome to your dashboard Admin, <?php  echo ($_SESSION["Logged_Admin_name"])?> !</h1>
  <p class="text-center">You can use the menus above to navigate through the site.</p>
</div>
<footer style="padding: 0px; position: absolute; bottom: 0; left: 0; width: 100%; ">
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand"></a>          
      <a  class="navbar-brand" style=" font-size: 18px;  cursor: pointer;">Admin Panel</a>   
    </div>
  </nav>
</footer>




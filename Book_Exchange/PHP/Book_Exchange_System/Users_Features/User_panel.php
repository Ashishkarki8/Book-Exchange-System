
<head>
  <title>User Dashboard</title>
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
      font-size: 18px;
      transition: color 0.1s ease-in-out;
    }
    .footer {

      bottom: 0;
      width: 100%;
       background-color: #333;
       color: #fff;
      text-align: center;
      padding: 10px;
}

  </style>
</head>
<body>
 <?php 
  session_start();
  if (!isset($_SESSION["Select_user"])) {
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
          <a class="nav-link" href="#"> User Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Edit_Personal_Details.php">Edit Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./add_books.php">Add books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Request_Books/index.php">Search and Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Request_Books/my_request.php">My Requests</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Request_Books/Received_request.php">Received Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://mail.google.com/mail/u/0/#inbox?compose=new">Contact Us</a>
        </li>
      </ul>
    </div>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <img class="profile-img" src="../images/<?php echo( $_SESSION["Logged_Username_Image"])?>">
        <a class="nav-link active" href="#"><?php  echo ($_SESSION["Logged_Username"])?></a>
         <!-- <a class="nav-link" href="#">Logout</a> -->
         <a href="./logout.php" class="btn btn-danger">Logout</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container my-4">
  <h1 class="text-center">Welcome to your dashboard, <?php  echo ($_SESSION["Logged_Username"])?> !</h1>
  <p class="text-center">You can use the menus above to navigate through the site.</p>
  <a class="btn btn-primary btn-xl text-uppercase" style="padding: 10px 20px; font-size: 16px; background-color: rgb(43, 43, 49);  margin-top: 50px; margin-left: 500px;" href="./Read_Pdf/available_pdf.php"> Read Books pdf </a>

</div>


</body>

<footer style="padding: 0px; position: absolute; bottom: 0; width: 100%;">

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Book Exchange</a>          
            <a  class="navbar-brand" style=" font-size: 18px; text-decoration: underline; cursor: pointer;">For any problem message us at : Bookexchangecompany@gmail.com</a>
                
            
        </div>
    </nav>
</footer>
  
</html>



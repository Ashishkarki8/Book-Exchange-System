<?php 
session_start();
include "../../header.php";
 if (!isset($_SESSION["Select_user"])) {
    session_unset();
    session_destroy();
    header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
    exit();
 }
$_SESSION['unique_id']=$_SESSION['Select_user']; //logeed in users
$_SESSION['Receiver_Id']=$_GET["Message_Receiver_id"];
?>
<?php include "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
             include "../../config.php";
             $sql = mysqli_query($conn, "SELECT * FROM users WHERE User_Id = {$_SESSION['unique_id']}");     //unique id means current login user Id
             if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            } 
          ?>
          <img src="../../images/<?php echo $row['Image']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['Name'] ?></span>   <!-- //fname changed to Name column name -->
            <p><?php /* echo $row['status']; */ ?></p>
          </div>
        </div>
        <!-- <a href="php/logout.php?logout_id=<?php /* echo $row['unique_id']; */ ?>" class="logout">Logout</a> -->
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button></button>
      </div>
      <div class="users-list">

      </div>
      <div class="text-center">
    <a class="read-more btn btn-primary" href="javascript:history.go(-1)">Back to Home</a>
</div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>

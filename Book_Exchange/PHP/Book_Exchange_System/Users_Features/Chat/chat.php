<?php 
  session_start();
  include_once "../../config.php";
  if (!isset($_SESSION["Select_user"])) {
    session_unset();
    session_destroy();
    header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
    exit();
 }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        $_GET['user_id'];  //ARKO USER KO DATA
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE User_Id = {$user_id}");    //send to  user  data 
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }
        ?>
        <a href="javascript:history.go(-1)" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../../images/<?php echo $row['Image']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['Name'] ?></span>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>

<?php 
$conn = mysqli_connect("localhost", "root", "", "exchange_book_app") or die("Connection failed");
if(!$conn){
  echo "Database connection error".mysqli_connect_error();
}
?>
<?php 
session_start();
session_unset();
session_destroy();
session_abort();
header("location: {$hostname}/book_exchange/php/Book_Exchange_System/login1.php");
?>
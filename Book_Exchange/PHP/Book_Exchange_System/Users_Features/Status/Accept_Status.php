<?php
include "../../config.php";
session_start();
 if (!isset($_SESSION["Select_user"])) {
    session_unset();
    session_destroy();
    header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
    exit();
 }
 
$Rq_Id=$_GET["Rq_id"];
$Decision="Accepted";
$sql ="UPDATE request_details
SET Request_Status = '{$Decision}'
WHERE Request_Id = '{$Rq_Id}'";
$result = mysqli_query($conn, $sql)  or die("Query failed") ;
echo "<script>
            alert('Accpeted Successfully');
            window.location.href='../Request_Books/Received_request.php';
                            </script>";
?>

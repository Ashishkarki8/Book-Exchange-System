<?php 
    
    include "../../config.php";
    session_start();
    if (!isset($_SESSION["Select_user"])) {
       session_unset();
       session_destroy();
       header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
       exit();
    }
    if(isset($_GET["accepted_rq_del"])){
        $sql_2 = "SELECT User_Id FROM request_details WHERE `request_Id`={$_GET["accepted_rq_del"]}";
        $result_2 = mysqli_query($conn, $sql_2);
        $row = mysqli_fetch_assoc($result_2);
        echo $chat_delete_Id = $row['User_Id'];
        $sql_3 = "DELETE FROM messages 
        WHERE (incoming_msg_id =$chat_delete_Id AND outgoing_msg_id = {$_SESSION["Select_user"]})
        OR (incoming_msg_id = {$_SESSION["Select_user"]} AND outgoing_msg_id = $chat_delete_Id) ";
        $result_3 = mysqli_query($conn, $sql_3);
        $sql = "DELETE FROM request_details WHERE `request_details`.`request_Id` = {$_GET["accepted_rq_del"]}"; 
        $result_1 = mysqli_query($conn, $sql);          
        echo "<script>
        alert('Delete sucessfull along with chat history...');
        window.location.href='./Received_request.php';
        </script>";

    }
    if(isset($_GET["id"])){
        echo $sql_2 = "SELECT Post_Owner_Id FROM request_details WHERE `request_Id`={$_GET["id"]}";
        $result_2 = mysqli_query($conn, $sql_2);
        $row = mysqli_fetch_assoc($result_2);
        $chat_delete_Id = $row['Post_Owner_Id'];
        $sql_3 = "DELETE FROM messages 
        WHERE (incoming_msg_id =$chat_delete_Id AND outgoing_msg_id = {$_SESSION["Select_user"]})
        OR (incoming_msg_id = {$_SESSION["Select_user"]} AND outgoing_msg_id = $chat_delete_Id) ";
        $result_3 = mysqli_query($conn, $sql_3);
        $sql = "DELETE FROM request_details WHERE `request_details`.`request_Id` = {$_GET["id"]}"; 
        $result = mysqli_query($conn, $sql) or die("Query uncessfull"); 
       
    echo "<script>
    alert('Delete sucessfull...');
    window.location.href='./my_request.php';
    </script>";
}
    ?>
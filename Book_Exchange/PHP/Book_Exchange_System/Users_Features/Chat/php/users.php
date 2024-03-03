<?php

//outgoing contains logged im Id  
    session_start();
    include_once "../../../config.php";
     $_SESSION['Receiver_Id'];
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users WHERE  User_Id = {$_SESSION['Receiver_Id']}";   //shows list except logged in user
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>
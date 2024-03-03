<!-- Not necessary -->
<?php
    session_start();
    
    $Message_Receiver_Id=$_POST['Receiver_id'];
    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
   include "../../../config.php";
     $sql = "SELECT * FROM users WHERE User_Id = {$Message_Receiver_Id}";
    // $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    print_r($conn);
    print_r($query);
    if(mysqli_num_rows($query) > 0){
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>
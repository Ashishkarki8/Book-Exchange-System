<!-- //users..php mah below box mah available user ma dekhauney code -->
<?php
    while($row = mysqli_fetch_assoc($query)){
         $_SESSION['unique_id'];
        //  $outgoing_id=$_SESSION['unique_id'];
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['User_Id']}
                OR outgoing_msg_id = {$row['User_Id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        // print_r($row2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
       
        // $_SESSION["Receiver_Messages"]=$row2['msg'];      //for message
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";  //might need chage
        }else{
            $you = "";
        }
        // ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['User_Id']) ? $hid_me = "hide" : $hid_me = "";
        // print($row['unique_id']);

        $output .= '<a href="chat.php?user_id='. $row['User_Id'] .'">
        <div class="content">
                    <img src="../../images/' . $row['Image'] . '" alt="">            
                    <div class="details">
                        <span>'. $row['Name'].'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                </a>';
    }
?>






 <?php
 include "../../header.php";
 session_start();
 if (!isset($_SESSION["Select_user"])) {
    session_unset();
    session_destroy();
    header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
    exit();
 }
?>

<?php include "../header.php"   ?>
<div id="main-content">
    <h2>Received Requests</h2>
    
    <?php  /* for connection */
    include "../../config.php";
    $sql = "SELECT request_details.Request_Id, request_details.User_Id, request_details.Post_Id,request_details.Request_Status, request_details.Requested_At,book_details.Owned_Book_Title, users.Name FROM request_details JOIN book_details ON request_details.Post_Id = book_details.Post_Id JOIN users ON request_details.User_Id = users.User_Id WHERE request_details.Post_Owner_Id = {$_SESSION['Select_user']};";  
    $result = mysqli_query($conn, $sql) or die("Query uncessfull");
    if(mysqli_num_rows($result)>0){                        /* kati number of rows cha database ma tei dekhaucha lincha so result print garda [num_rows] => 2 dekhaucha*/
    ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <th>Received Requests</th>           
            <th>Action</th>
            <th>Chat Now</th>
            <th>Options</th>   
        </thead>
        <tbody>
            <?php 
            while($row = mysqli_fetch_assoc($result)){                         
                             $status=$row['Request_Status'];
                             $requestId=$row['Request_Id'];
            ?>
            <tr>
                <td><?php
                echo $row['Name'].  " has requested you for exchanging your book named " . " " . $row['Owned_Book_Title'] . " at " . $row['Requested_At']?></td>
               <?php if($status==""){   ?> <td>                   
                <button style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="location.href='../Status/Accept_Status.php?Rq_id=<?php echo ($row['Request_Id']);?>'">Accept</button>
                <button style="background-color: red; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="location.href='../Status/Reject_Status.php?Rq_id=<?php echo ($row['Request_Id']);?>'">Reject</button>
                </td>
                <?php  }
                else{ ?>
                <td><?php 
                if($status=="Accepted"){
                echo "You've Accepted";}
                else{
                    echo ("You've Rejected");
                }
                ?> </td>
                 <?php }   ?>
                 <?php 
                    if($status=="Accepted"){ ?>
                        <td>
                        <button style="background-color: green; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="location.href='../Chat/users.php?Message_Receiver_id=<?php echo($row['User_Id']);?>'">Chat Now</button>
                        <td> <a href='./cancel_request.php?accepted_rq_del=<?php echo ($row['Request_Id']);?>'>Delete</a></td>
                 </td>
                 <?php  }else{
                   print "<td> Not Available</td>";
                 } ?>
            </tr>
                <?php } ?>
            </tbody>
    </table>
    <?php } 
    else{
        echo" <h2>Sorry you havent Received any requests.</h2>";     
    }
    mysqli_close($conn);                     /* connection lai close gareko */
     ?> 
</div>
</body>
<div class="col-sm-3  d-grid">
                 <a class="btn btn-info btn-lg btn-block" value="login_button"  href='./../User_panel.php' role="button">Back to Home</a>
            </div>
</div>
<?php include "../Footer.php"   ?>

</html>

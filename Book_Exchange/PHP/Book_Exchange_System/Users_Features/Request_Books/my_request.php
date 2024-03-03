
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
<?php include "../Header.php"   ?>
<div id="main-content">
    <h2>My Requests</h2>
    <?php
    include "../../config.php";
    $sql = "SELECT request_details.Request_Id, request_details.User_Id, request_details.Post_Id,request_details.Post_Owner_Id, request_details.Request_Status, request_details.Requested_At,book_details.Owned_Book_Title,users.Email, users.Name FROM request_details JOIN book_details ON request_details.Post_Id = book_details.Post_Id JOIN users ON request_details.Post_Owner_Id = users.User_Id WHERE request_details.User_Id={$_SESSION['Select_user']}";
    $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

    if (mysqli_num_rows($result) > 0) {
        ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>My All Requests</th>
                    <th>Request Status</th>
                    <th>Action</th>
                    <th>Chat Now</th>  
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $status = $row['Request_Status'];
                    $requestId = $row['Request_Id'];
                    ?>   
                    <tr>
                        <td>
                            <?php
                                if ($status == "Accepted") {
                                    echo "Your Request  of " . $row['Owned_Book_Title'] . " to " . $row['Name'] . " at " . $row['Requested_At'] ." has been Accepted. Now you can email him at ". $row['Email'];
                                } else {
                                    
                                    echo "You have sent a request to " . $row['Name'] . " for his book named " . $row['Owned_Book_Title'] . " at " . $row['Requested_At'];
                                }
                                
                            ?>
                        </td>
                        <td>
                            <?php
                                if ($status == "") {
                                    echo "request pending";
                                } else {
                                    echo ($status);
                                }
                            ?> 
                        </td>
                        <td>
                        <button type="button" class="btn btn-danger"><a href='./cancel_request.php?id=<?php echo ($row['Request_Id']);?>' style="color:white; text-decoration:none;">Cancel</a></button>
                        </td>
                        <?php if ($status == "Accepted") { ?>
                            <td>
                            <button type="button" class="btn btn-danger" style="background-color: green; color: white; border: none;">
                                <a href="../Chat/users.php?Message_Receiver_id=<?php echo ($row['Post_Owner_Id']); ?>" style="color:white; text-decoration:none;">Chat Now</a>
                            </button>  
                            </td>
                        <?php } else { ?>
                            <td>Not Available</td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else {
        echo "<h2>Sorry, you haven't sent any requests.</h2>";
    }
    mysqli_close($conn);
    ?>
</div>
</body>
<div class="col-sm-3  d-grid">
                 <a class="btn btn-info btn-lg btn-block" value="login_button"  href='../User_panel.php' role="button">Back</a>
            </div>
</div>

</html>

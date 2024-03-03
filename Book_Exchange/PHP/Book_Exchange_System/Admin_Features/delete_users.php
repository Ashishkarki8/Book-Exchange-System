
<?php
$del_id = $_GET["delete_id"];
include_once "../config.php";

// Disable MySQL foreign key checks to avoid errors when deleting
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");

$sql = "DELETE FROM users WHERE `users`.`User_Id` = $del_id;"; 
$result = mysqli_query($conn, $sql);

if ($result) {
  // If the delete was successful, re-enable foreign key checks and show a success message
  $sql_2 = "DELETE FROM book_details WHERE `book_details`.`Owner_Id` = $del_id;";
  $result_1 = mysqli_query($conn, $sql_2);
  $sql_3 = "DELETE FROM request_details
  WHERE User_Id = $del_id OR Post_Owner_Id = $del_id;";
  $result_2 = mysqli_query($conn, $sql_3);
  $sql_4 = "DELETE FROM messages
  WHERE incoming_msg_id = $del_id OR outgoing_msg_id = $del_id;;";
  $result_3 = mysqli_query($conn, $sql_4);
  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
  echo '<script>alert("Successfully Deleted")</script>';
  include('./All_users.php');
} else {
  // If there was an error, re-enable foreign key checks and show an error message
  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
  $error_message = mysqli_error($conn);
  echo '<script>alert(" Sorry You should delete the User from Database excess")</script>';
}
?>
 



<?php
session_start(); 
include "../config.php";
if (!isset($_SESSION["Select_user"])) {
   session_unset();
   session_destroy();
   header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
   exit();
}

try {
    $book_id = $_GET['Delete_book'];
    
    // Disable foreign key constraint before deleting rows
    $sql_disable_constraint = "ALTER TABLE request_details
                               DROP FOREIGN KEY request_details_ibfk_3";
    $conn->query($sql_disable_constraint);
    
    // Delete rows from request_details
    $sql_delete_request = "DELETE FROM request_details WHERE Post_Id = $book_id";
    $conn->query($sql_delete_request);
    
    // Delete rows from book_details
    $sql_delete_book = "DELETE FROM book_details WHERE Post_Id = $book_id";
    $conn->query($sql_delete_book);
    
    // Enable foreign key constraint after deleting rows
    $sql_enable_constraint = "ALTER TABLE request_details
                              ADD CONSTRAINT request_details_ibfk_3
                              FOREIGN KEY (Post_Owner_Id) REFERENCES book_details(Owner_Id)
                              ON DELETE CASCADE";
    $conn->query($sql_enable_constraint);
    
    echo "<script>
                            alert('Book deleted sucessfully');
                            window.location.href='../Users_Features/My_post.php';
                            </script>";  
  } catch (Exception $e) {
    echo "Error deleting rows: " . $e->getMessage();
  }
  



                                              
                            ?>

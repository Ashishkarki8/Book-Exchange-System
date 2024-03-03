<?php 
session_start(); 
if (!isset($_SESSION["Select_user"])) {
   session_unset();
   session_destroy();
   header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
   exit();
}
?>

<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        
                <?php
                  include ("../../config.php");
                  $post_Id=$_GET['rq_id'];
                  $post_owner_Id=$_GET['pstowner_id']; //book post haleko owner id
                  echo $selected_book=$_GET['selected_owned_book'];    //the book which i wana exchange to another user
                  session_start();
                  $sql = "SELECT * FROM `book_details` WHERE Owner_Id = {$_SESSION['Select_user']}";
                  $result = mysqli_query($conn, $sql)  or die("Query failed") ;
                    
                     
                   if(mysqli_num_rows($result)<1){  
                     echo "<script>
                            alert('Sorry!You should add atleast one book to send exchange request');
                            window.location.href='../add_books.php';
                            </script>";
                     
                    }
                    else{                        
                         $sql_3 ="INSERT Into request_details(User_Id,Post_Id,Post_Owner_Id) VALUES({$_SESSION['Select_user']},{$post_Id},{$post_owner_Id})";
                         $result = mysqli_query($conn, $sql_3)  or die("Query failed") ;
                         
                        
                         echo "<script>alert('Request successful. Please wait for a response.');
                                window.location.href='./my_request.php?selected_owned_book=".$selected_book."';
                                </script>";

                        }       
                        
                        ?>
                </span>
            </div>
        
    </div> 
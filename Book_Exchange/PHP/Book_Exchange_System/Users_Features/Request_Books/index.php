<?php
 session_start(); 
include "../../config.php";
if (!isset($_SESSION["Select_user"])) {
   session_unset();
   session_destroy();
   header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
   exit();
}
?>
<head>
	<title>Book Exchange</title>
	<!-- Add Bootstrap stylesheet -->
	 <?php include "../../header.php";?> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	
	<style>
		/* Style for the book image */
		.book-image {
			max-width: 215px;
			max-height: 215px;
			object-fit: cover;
			border: 6px solid #ddd;
			padding: 10px;
			margin: 29px;
			box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
		}
		.or-text {
         color: black;
         font-weight: 500;
		 font-weight: bold;
         
         }
		 .book-details {
			margin-top: 18px;
		margin-bottom: 18px;
		box-shadow: 0px 0px 10px gray;
		padding: 10px;
		}

	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center">All Available Books</h1>
		</div>
	</div>
    <a style="color: white; float: right;"  href="./../My_post.php" class="btn btn-danger">My Posts</a>
   
    <form class="form-inline my-2 my-lg-0" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
        <input class="form-control mr-sm-2" type="text" placeholder="Search Book" aria-label="Search" id="search-input" required name="search_text">
        <button class="btn btn-primary my-2 my-sm-0" type="submit" id="search-btn" name="search_btn">Search</button>
        
        <select class="form-control ml-2" name="book_select" required>
            <option value="" selected disabled >Yours Book</option>
            
            <?php
            $sql = "SELECT Owned_Book_Title FROM book_details WHERE Owner_Id ='{$_SESSION["Select_user"]}'";
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
                print_r($result);
                echo "<option value='" . $row["Owned_Book_Title"] . "'>" . $row["Owned_Book_Title"] . "</option>";
            }
            ?>
            
        </select>
        
    </form>
    <div style="height: 10px;"></div>
        <form class="form-inline my-9 my-lg-0" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-inline">
        <input class="form-control mr-sm-9" type="text" placeholder="Search Book ISBN" aria-label="Search" id="search-input" required name="search_text_2">
        <button class="btn btn-primary my-9 my-sm-0 ml-2" type="submit" id="search-btn" name="ISBN_search_btn">Search</button>
        
        </div>
        </form>
		<?php 
           if(isset($_POST['search_btn'])) {
             $input_search = mysqli_real_escape_string($conn,$_POST['search_text'] );   //unwanted string character haru hatako form bata
             $selected_book_name= $_POST['book_select'];                                 
            $sql_2 = "SELECT * FROM book_details 
            WHERE REPLACE(Owned_Book_Title, ' ', '') LIKE REPLACE('%$input_search%', ' ', '') 
            AND (REPLACE(Wishlist_First, ' ', '') LIKE REPLACE('%$selected_book_name%', ' ', '') 
                 OR REPLACE(Wishlist_Second, ' ', '') LIKE REPLACE('%$selected_book_name%', ' ', ''))";  
            $result_2 = $conn->query($sql_2);
                if(mysqli_num_rows($result_2) > 0){
                    while($row = $result_2->fetch_assoc()) {
                        echo "<div class='row book-details'>";
                        echo "<div class='col-md-4'>";
                        echo "<img class='book-image' src='../../images/uploaded_book_images/" . $row["Book_Image"] . "'>";
                        echo "</div>";
                        echo "<div class='col-md-8'>";
                        echo "<h2>" . $row["Owned_Book_Title"] . "</h2>";
                        echo "<p><strong>Author:</strong> " . $row["Author"] . " <strong>ISBN:</strong> " . $row["Book_ISBN"] . "</p>";
                        echo "<p><strong>Category:</strong> " . $row["Book_Category"] . "</p>";
                        echo "<p><strong>Description:</strong> ". $row["Book_Description"]. "</p>";
                        echo "<p><strong>Can be Exchanged To:</strong> " . $row["Wishlist_First"] . " <span class='or-text'>Or</span> "  . $row["Wishlist_Second"] ."</p>";              
                        echo "<a class='read-more pull-right btn btn-primary' href='request.php?rq_id=" . $row['Post_Id'] . "&pstowner_id=" . $row['Owner_Id'] . "'>Request</a>";
                        
                        echo "</div>";
                        echo "</div>";
                    }
                
                }else{
                    echo "<script>
                            alert('Sorry! No result Found');
                            window.location.href='./index.php';
                            </script>";
                }

           } else if(isset($_POST['ISBN_search_btn'])) {
            $input_search_2 = $_POST['search_text_2'];     //unwanted string character haru hatako form bata
            $sql_4 = "SELECT * FROM book_details 
          WHERE REPLACE(Book_ISBN, ' ', '') LIKE REPLACE('%$input_search_2%', ' ', '')";
            $result_4 = $conn->query($sql_4);
                if(mysqli_num_rows($result_4) > 0){
                    while($row_1 = $result_4->fetch_assoc()) {
                        echo "<div class='row book-details'>";
                        echo "<div class='col-md-4'>";
                        echo "<img class='book-image' src='../../images/uploaded_book_images/" . $row_1["Book_Image"] . "'>";
                        echo "</div>";
                        echo "<div class='col-md-8'>";
                        echo "<h2>" . $row_1["Owned_Book_Title"] . "</h2>";
                        echo "<p><strong>Author:</strong> " . $row_1["Author"] . " <strong>ISBN:</strong> " . $row_1["Book_ISBN"] . "</p>";
                        echo "<p><strong>Category:</strong> " . $row_1["Book_Category"] . "</p>";
                        echo "<p><strong>Description:</strong> ". $row_1["Book_Description"]. "</p>";
                        echo "<p><strong>Can be Exchanged To:</strong> " . $row_1["Wishlist_First"] . " <span class='or-text'>Or</span> "  . $row_1["Wishlist_Second"] ."</p>";
                        echo "<a class='read-more pull-right btn btn-primary' href='request.php?rq_id=" . $row_1['Post_Id'] . "&pstowner_id=" . $row_1['Owner_Id'] . "'>Request</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                }else{
                    echo "<script>
                            alert('Sorry! No Such book ISBN Found');
                            window.location.href='./index.php';
                            </script>";}
            }   
            else if(!isset($_POST['ISBN_search_btn']) && !isset($_POST['search_btn'])) {
                $sql_3 = "SELECT * FROM `book_details` WHERE Owner_Id != {$_SESSION["Select_user"]};";
                $result_3 = $conn->query($sql_3);
                
                // Check if any rows were returned
                if ($result_3->num_rows > 0) {
                    while($row = $result_3->fetch_assoc()) {
                        echo "<div class='row book-details'>";
                        echo "<div class='col-md-4'>";
                        echo "<img class='book-image' src='../../images/uploaded_book_images/" . $row["Book_Image"] . "'>";
                        echo "</div>";
                        echo "<div class='col-md-8'>";
                        echo "<h2>" . $row["Owned_Book_Title"] . "</h2>";
                       
                        echo "<p><strong>Author:</strong> " . $row["Author"] . " <strong>ISBN:</strong> " . $row["Book_ISBN"] . "</p>";
                        echo "<p><strong>Category:</strong> " . $row["Book_Category"] . "</p>";
                        echo "<p><strong>Description:</strong> ". $row["Book_Description"]. "</p>";
                        echo "<p><strong>Can be Exchanged To:</strong> " . $row["Wishlist_First"] . " <span class='or-text'>Or</span> "  . $row["Wishlist_Second"] ."</p>";
                        echo "<a class='read-more pull-right btn btn-primary' href='request.php?rq_id=" . $row['Post_Id'] . "&pstowner_id=" . $row['Owner_Id'] . "'>Request</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                   
                    echo "<h1>No posts found.</h1>";
                }
            }
        else{ 
            echo "<p>Something went wrong try again.</p>";
        }
			
		?>
    <?php 
        
    ?>
        </div>
	</div>
</div>
<div class="col-sm-2">
  <a href="./../User_panel.php" class="btn btn-secondary btn-sm">Back to Home</a>
</div>
	
</body>


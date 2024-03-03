<?php
 session_start(); 
include "../config.php";
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
	 <?php include "../header.php";?> 
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
			<h1 class="text-center">My posts</h1>
		</div>
	</div>
		<?php 
                $sql_3 = "SELECT * FROM `book_details` WHERE Owner_Id = {$_SESSION["Select_user"]};";
                $result_3 = $conn->query($sql_3);
                if ($result_3->num_rows > 0) {
                    while($row = $result_3->fetch_assoc()) {
                        echo "<div class='row book-details'>";
                        echo "<div class='col-md-4'>";
                        echo "<img class='book-image' src='../images/uploaded_book_images/" . $row["Book_Image"] . "'>";
                        echo "</div>";
                        echo "<div class='col-md-8'>";
                        echo "<h2>" . $row["Owned_Book_Title"] . "</h2>";
                        echo "<p><strong>Author:</strong> " . $row["Author"] . " <strong>ISBN:</strong> " . $row["Book_ISBN"] . "</p>";
                        echo "<p><strong>Category:</strong> " . $row["Book_Category"] . "</p>";
                        echo "<p><strong>Description:</strong> ". $row["Book_Description"]. "</p>";
                        echo "<p><strong>Can be Exchanged To:</strong> " . $row["Wishlist_First"] . " <span class='or-text'>Or</span> "  . $row["Wishlist_Second"] ."</p>";
                        echo "<a class='read-more pull-right btn btn-primary' href='../Users_Features/Edit_Post.php?rq_id=" . $row['Post_Id'] . "&pstowner_id=" . $row['Owner_Id'] . "'>Edit</a>";
						echo '<a style="color: white; float: right;" class="btn btn-danger" href="../Users_Features/delete_post.php?Delete_book=' . $row['Post_Id'] . '">Already Exchanged</a>';
						echo "</div>";
                        echo "</div>";
                    }
                } else {
                    
                    echo "<h1>No posts found.</h1>";
                }
          
        

			// Close the database connection
			
		?>
    <?php 
              
    ?>

        </div>
	</div>
    
</div>
<div class="col-sm-2">
  <a href="../Users_Features/Request_Books/index.php" class="btn btn-secondary btn-sm">Back to Home</a>
</div>
	
</body>


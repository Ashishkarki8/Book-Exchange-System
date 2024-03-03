<?php 
  session_start();
  if (!isset($_SESSION["Select_user"])) {
     session_unset();
     session_destroy();
     header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
     exit();
}
  ?>
<?php
include_once "../config.php";
if(isset($_POST['save'])){ 
  $book_title= mysqli_real_escape_string($conn,$_POST['post_title']);
  $book_Author= mysqli_real_escape_string($conn,$_POST['Author']);
  $book_ISBN= mysqli_real_escape_string($conn,$_POST['post_ISBN']);
  $book_category= mysqli_real_escape_string($conn,$_POST['post_category']);
  $book_description= mysqli_real_escape_string($conn,$_POST['post_desc']);
  $book_wishlist= mysqli_real_escape_string($conn,$_POST['first_wishlist']);
  $book_wishlist_second= mysqli_real_escape_string($conn,$_POST['second_wishlist']);
  if(isset($_FILES['image'])){
    $img_name = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];           
     $img_explode = explode('.',$img_name);
    $img_ext = end($img_explode);
            $extensions = ["jpeg", "png", "jpg"];
            if(in_array($img_ext, $extensions) === true){
                $types = ["image/jpeg", "image/jpg", "image/png"];    
                if(in_array($img_type, $types) === true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name,"../images/uploaded_book_images/".$new_img_name)){ 
                      $sql ="INSERT Into book_details(Owned_Book_Title,Owner_Id,Book_ISBN,Author,Book_Category,Book_Description,Wishlist_First,Wishlist_Second,Book_Image)           
                       VALUES('{$book_title}', 
                        {$_SESSION["Select_user"]},'{$book_ISBN}','{$book_Author}','{$book_category}','{$book_description}','{$book_wishlist}','{$book_wishlist_second}','{$new_img_name}')";

                        if(mysqli_query($conn, $sql)){
                          echo "<script>
                            alert('Book Added successfully! Please proceed for Request');
                           
                            </script>";
                          } else{
                            echo "<script>
                            alert('Sorry something went wrong please try again');
                            window.location.href='./add_books.php';
                            </script>";            
                          }
                    }
                }else{
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }else{
                echo "Please upload an image file - jpeg, png, jpg";
            }
    }    
}      
?>

<?php  include "../header.php";  ?>
<style>
        body {
            background-image: url("../../../Images/Index/book1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            
        }
        
    form {
        color: white;
        
    }
</style>
    </style>
<body>
    <div class="container my-5">
        <h2 style="color: white;  display: inline-block;">Add Books</h2>
        <form action="<?php  $_SERVER['PHP_SELF'];  ?>" method="POST" enctype="multipart/form-data">     <!-- //enctype="multipart/form-data" yo rakhnai parcha kinaki we are dealing wioth files photo -->
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Book Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="post_title" placeholder="" required values="<?php echo $post_title; ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Author</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Author" placeholder="" required values="<?php echo $Author; ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Isbn</label>
                <div class="col-sm-6">
                    <input type="text"  class="form-control" name="post_ISBN" placeholder="" required values="<?php echo $post_ISBN; ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Book Catagory</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="post_category" placeholder="" required values="<?php echo $post_category; ?>" />
                </div>
         </div>

         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description </label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control" rows="6" name="post_desc" placeholder="Provide hint about Book Content and Released date along with its condition in Only 620 characterts" maxlength="650" required values="<?php echo $post_desc; ?>"></textarea>
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Whishlist</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="first_wishlist" placeholder="Name the book that you want in return" required values="<?php echo $first_wishlist; ?>" />
                </div>  
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Second Wishlist</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="second_wishlist" placeholder="Name the another next  book" required values="<?php echo $second_wishlist; ?>" />
                </div>
                </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Select Image</label>
                <div class="col-sm-6" class="field image">
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>  <!-- for image mathi cha -->
                </div>
         </div>
         
         <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button name="save" type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3  d-grid">
                 <a class="btn btn-outline-primary" style="color: white;"  href='./User_panel.php' role="button">cancel</a>
            </div>
         </div>
        </form>
    </div>  
</body>
</html>


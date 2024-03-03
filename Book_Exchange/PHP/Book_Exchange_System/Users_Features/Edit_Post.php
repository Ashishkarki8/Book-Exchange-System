<?php 
  session_start();
  include_once "../config.php";
  if (!isset($_SESSION["Select_user"])) {
     session_unset();
     session_destroy();
     header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
     exit();
}
  ?>
<?php
$Get_post_Id=$_GET['rq_id'];

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
                        $sql_1="SELECT Request_Status From request_details WHERE Post_Id= $Get_post_Id";
                        $result_1 = mysqli_query($conn, $sql_1);
                        $row_1 = mysqli_fetch_assoc($result_1);                      
                        if($row_1['Request_Status'] ==="Accepted"){
                            echo "<script>
                            alert('Sorry your post is accepted so you cannot modify the post');
                            window.location.href='../../Users_Features/My_post.php';
                            </script>";  
                        }else{
                            $sql ="UPDATE book_details SET Owned_Book_Title='{$book_title}',Book_ISBN='{$book_ISBN}',Author='{$book_Author}',Book_Category='{$book_category}',Book_Description='{$book_description}',Wishlist_First='{$book_wishlist}',Wishlist_Second='{$book_wishlist_second}',Book_Image='{$new_img_name}' WHERE Post_Id='$Get_post_Id'" ;
                            if(mysqli_query($conn, $sql)){
                            echo "<script>
                            alert('Update Sucessfull');
                            window.location.href='../Users_Features/My_post.php';
                            </script>";}
                        };
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


   <?php
     
   $sql = "SELECT * FROM Book_details WHERE post_Id ={$Get_post_Id}";         
   $result = mysqli_query($conn, $sql);
   if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    
    ?>
    
    <div class="container my-5">
        <h2 style="color: white;  display: inline-block;">User Form</h2>
        <form  action="<?php  $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">     <!-- //enctype="multipart/form-data" yo rakhnai parcha kinaki we are dealing wioth files photo -->
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Book Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="post_title" placeholder="" required value="<?php echo($row['Owned_Book_Title'])?>" /> 
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Author</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Author" placeholder="" required value="<?php echo ($row['Author'])?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Isbn</label>
                <div class="col-sm-6">
                    <input type="text"  class="form-control" name="post_ISBN" placeholder="" required value="<?php echo ($row['Book_ISBN'])?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Book Catagory</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="post_category" placeholder="" required value="<?php echo ($row['Book_Category'])?>" />
                </div>
         </div>

         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description </label>
                <div class="col-sm-6">
                <textarea name="post_desc" required maxlength="650" rows="6" class="form-control"><?php echo $row['Book_Description']; ?></textarea>

                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Whishlist</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="first_wishlist" placeholder="" required value="<?php echo ($row['Wishlist_First'])?>" />
                </div>  
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Second Wishlist</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="second_wishlist" placeholder="" required value="<?php echo ($row['Wishlist_Second'])?>" />
                </div>
                </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Select Image</label>
                <div class="col-sm-6" class="field image">
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required value="../images/uploaded_book_images/<?php echo ($row['Book_Image'])?>">  
                </div>
         </div>
         
         <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button name="save" type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3  d-grid">
                 <a class="btn btn-outline-primary" style="color: white;"  href='../Users_Features/My_post.php' role="button">cancel</a>
            </div>
         </div>
        </form>
    </div>
 <?php  }
 else{
    echo("Sorry you have no post");

 }
 ?>    
</body>
</html>

<?php 
  session_start();
  if (!isset($_SESSION["Select_Admin"])) {
     session_unset();
     session_destroy();
     header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
     exit();
}
  ?>
<?php
include "../config.php";
$added_by=$_SESSION["Select_Admin"];
if(isset($_POST['save'])){
 $name = mysqli_real_escape_string($conn,$_POST["name"]);   
 $author = mysqli_real_escape_string($conn,$_POST["Author"]);
 $sql  ="SELECT Name  FROM pdf_files where Name ='{$name}'";
 $file_name = $_FILES['pdfFile']['name'];
 $sql_1  ="SELECT  Path FROM pdf_files where Path ='{$file_name}'";
 $result = mysqli_query($conn, $sql) or die("Query uncessfull");
    if(mysqli_num_rows($result)>0){
        echo '<script>alert("This pdf is already uploaded exists.Please recheck.")</script>';
    }
    else{
        if(isset($_FILES['pdfFile'])){
                // Save the file to the uploads directory
                move_uploaded_file($_FILES['pdfFile']['tmp_name'], '../../../books_pdf/' . $_FILES['pdfFile']['name']);
                
                $insert_query = mysqli_query($conn, "INSERT INTO pdf_files(Name, Author,Path, Added_By)
                VALUES ('{$name}','{$author}' ,'{$file_name}','{$added_by}')");
        
                         echo "<script>
                            alert('Pdf added successfully!');
                            
                            </script>";                     
                    }
            else{
                echo "Please upload an pdf file";
            }
        } 
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Exchange</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand">Book Exchange System</a>
  </div>
</nav>
  
  <div class="container my-4" >
    <div class="container my-5">
        <h2>Add Books Pdf</h2>
        <form action="<?php  $_SERVER['PHP_SELF'];  ?>" method="POST" enctype="multipart/form-data">   
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" placeholder="" required values="<?php echo $name; ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Author</label>
                <div class="col-sm-6">
                    <input type="text"  class="form-control" name="Author" placeholder="" required values="<?php echo $Author; ?>" />
                </div>
         </div>
         <div class="row mb-3">
                <label for="pdfFile" class="col-sm-3 col-form-label">Select PDF file:</label>
                <div class="col-sm-6" class="field image">
                    <input type="file" class="form-control" name="pdfFile" id="pdfFile" accept=".pdf" required> 
                </div>
         </div>
         <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button name="save" type="submit" class="btn btn-primary">Upload</button>
            </div>
            <div class="col-sm-3  d-grid">
                 <a class="btn btn-outline-primary"  href='./Admin_panel.php' role="button">cancel</a>
            </div>
         </div>
        </form>
    </div>  
</body>
<?php include './Admin_footer.php'   ?>
</html>

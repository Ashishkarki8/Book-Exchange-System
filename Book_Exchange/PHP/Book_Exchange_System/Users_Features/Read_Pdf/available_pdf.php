<?php 
session_start();
if (!isset($_SESSION["Select_user"])) {
   session_unset();
   session_destroy();
   header("Location:/book_exchange/php/Book_Exchange_System/login1.php");
   exit();
}
// Connect to database
include "../../config.php";
include "../../header.php";
?> 
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand">Book Exchange System</a>
  </div>
</nav>
  <div class="container my-4" >
  </form>
    <div style="height: 20px;"></div>
        <form class="form-inline my-9 my-lg-0" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-inline">
        <input  type="text" placeholder="Search Book PDF Name" aria-label="Search" id="search-input" required name="search_text_2">
        <button class="btn btn-primary my-9 my-sm-0 ml-2" type="submit" id="search-btn" name="pdf_search_btn">Search</button>
        
        </div>
        </form>
</form>
<div class="col-sm-3 d-grid" style="margin-top: 5px;">
        <a class="btn btn-info btn-lg custom-class" style="padding: 0px ; margin-top: 9px; margin-left: 0px;" value="login_button" href="./available_pdf.php" role="button">Refresh Once</a>
    </div>
  <?php   
  if (isset($_POST['pdf_search_btn'])) { 
    $Searched_text = $_POST["search_text_2"];     
$sql = "SELECT * FROM pdf_files WHERE Name LIKE '%" . $Searched_text . "%'";
    $result_4 = $conn->query($sql); 
    if(mysqli_num_rows($result_4) > 0){
        echo '
            <table cellpadding="7px">
                <thead>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Uploaded At</th>
                </thead>
                <tbody>';
        while($row_1 = $result_4->fetch_assoc()) {
            echo '
                <tr>
                    <td><a href="../../../../books_pdf/'.$row_1['Path'].'" target="_blank">'.$row_1['Name'].'</a></td>
                    <td>'.$row_1['Author'].'</td>
                    <td>'.$row_1['Uploaded_on'].'</td>
                </tr>';
        }
        echo '
                </tbody>
            </table>';
    } else {
        echo "<script>
                alert('Sorry! No such PDF found.');
                window.location.href='./available_pdf.php';
              </script>";
    }
} 
    else { 
        $sql = "SELECT * FROM pdf_files;";
        $result = mysqli_query($conn, $sql) or die("Query uncessfull");                           
    ?>
    <table cellpadding="7px">
        <thead>
            <th>Name</th>
            <th>Author</th>
            <th>Uploaded At</th>
        </thead>
        <tbody>
            <?php 
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
            <td><a href="../../../../books_pdf/<?php echo$row['Path']?>" target="_blank"><?php echo  $row['Name'] ?></a></td>
            <td>  <?php  echo  $row['Author']  ?>  </a></td>
            <td><?php  echo  $row['Uploaded_on']  ?>  </a></td>
            </tr>

                <?php } ?>
            </tbody>
    </table>
    <a class="btn btn-primary btn-xl text-uppercase" style="padding: 10px 20px; font-size: 13px; background-color: rgb(43, 43, 49);  margin-top: 35px; " href="../User_panel.php"> Back </a>
    
           <?php }   ?> 
</div>
</body>
</body>
</html>

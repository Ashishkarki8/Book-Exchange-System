<?php

$old_picture = "./images/luppy.jpg";

if (file_exists($old_picture)) {
    // Delete the file
    unlink($old_picture);
    echo"Deleted";
}


?>

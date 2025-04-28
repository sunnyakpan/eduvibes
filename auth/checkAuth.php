<?php
session_start();

// check if login
if (!isset($_SESSION['user_data'])) {
    header("Location: http://localhost/tutorials/niit/ikorodu/projects/eduvibes/index.php");
    exit();
}


?>
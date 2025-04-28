<?php
session_start();
session_destroy();
header("Location: http://localhost/tutorials/niit/ikorodu/projects/eduvibes/auth/login.php");
?>

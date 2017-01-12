<?php 
 session_start();
 session_destroy();
 setcookie("isLoginUser");
 header('Location: user-login.php');
 ?>
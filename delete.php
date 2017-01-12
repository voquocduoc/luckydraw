<?php 
if(isset($_GET['name']) && $_GET['name'] != null){
	$filename = $_GET['name']; 
	unlink($filename); 
}
	header('location: admin123.php'); 
 ?>
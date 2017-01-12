<?php

include('../db.php');
//fn run is here
$iddata = (int)$_POST['id'];
 $sql = "CALL pSetResult($otp,$Hinh)('".$_SESSION['Code']."','".$iddata."')";
           mysql_set_charset('utf8',$con);
           $query=mysql_query($sql);

?>

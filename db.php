<?php
error_reporting(0);
$mysql_hostname = "103.27.237.247";  	// host MySQL
$mysql_user = "dev"; 				// username MySQL
$mysql_password = "123456";	// password MySQL
$mysql_database = "luckydraw";		// database name


$db = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("CAN NOT CONNECT DATABASE");
mysql_select_db($mysql_database, $db) or die("CAN NOT SELECT DATABASE");

mysql_query("SET NAMES 'utf8'");

?>

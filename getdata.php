<?php
if (isset($_POST['data'])){
include('db.php');
	 $intdata = (int)$_POST['data'];
	$data;

	$result_sql = mysql_query("SELECT * FROM data WHERE tinhtrang = 0 and giatri='".$intdata."'");
	$rows_data = mysql_fetch_array($result_sql);
	//data
	$rowdata = $rows_data['magiamgia'];
	if($rowdata==NULL){
		echo 'hetma';
	}else
	{
		/* update database */
	$sql = mysql_query("UPDATE data SET tinhtrang=1 WHERE magiamgia='{$rowdata}' ");
	
	echo $rowdata;
	}
	
	

}
?>

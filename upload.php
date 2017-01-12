<?php
//Các Mimes quản lý định dạng file
$mimes = array(
	'image/jpeg', 'image/png', 'image/gif'
);
sleep(2);


if (isset($_FILES['myfile'])) {
	$tile = $_POST['tile'];
	$fileName = $_FILES['myfile']['name'];
	$fileName = str_replace(" ","", $fileName);
	$fileName = str_replace("%", "", $fileName);
	$fileName = str_replace("_", "", $fileName);
	$fileName = str_replace(",", "", $fileName);
	$fileType = $_FILES['myfile']['type'];
	$fileError = $_FILES['myfile']['error'];
	$fileStatus = array(
		'status' => 0,
		'message' => ''	
	);
	if ($fileError== 1) { //Lỗi vượt dung lượng
		$fileStatus['message'] = 'Dung lượng quá giới hạn cho phép';
	} elseif (!in_array($fileType, $mimes)) { //Kiểm tra định dạng file
		$fileStatus['message'] = 'Không cho phép định dạng này';
	} else { //Không có lỗi nào
		if($_POST['tile']>0 || $_POST['giatri']>0){
		$giatri = $_POST['giatri'];
		$i= rand(0,16);
		$name_img = $i.'IMAGE_'.$tile.'_'.$giatri.'_'.$fileName;
		move_uploaded_file($_FILES['myfile']['tmp_name'], 'uploads/'.$name_img);
		$fileStatus['status'] = 1;
		$fileStatus['message'] = "Bạn đã upload $fileName thành công";
		
		}else{

			$fileStatus['message'] = "Tỉ lệ không được bỏ trống";
		}	
	}	
	echo json_encode($fileStatus);
	exit();
}

<?php 
@ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng nhập Vòng quay may mắn</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style-login.css" media="screen">
	<!-- <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> -->
	 <script type="text/javascript" src="js/function.js"></script>
	
</head>
<body>
	<?php include('db.php'); //connect database 
	header('Content-Type: text/html; charset=utf-8'); ?>
<?php if (isset($_POST["bt_login"])) {
        // lấy thông tin người dùng
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $code = trim($_POST["code"]);
        $id_user = trim($_POST['id_user']);
        $name = strip_tags($name);
        $name = addslashes($name);
        $phone = strip_tags($phone);
        $phone = addslashes($phone);
        if ($name == "" || $phone =="" ) {
            $_SESSION['error'] = "Họ tên và số điện thoại không được để trống!";
        }else{
        	header('Content-Type: text/html; charset=utf-8');
           $sql = "SELECT fValidOTP('".$code."','".$name."','".$phone."','".$id_user."')";
            mysql_set_charset('utf8',$db);
            
            $query=mysql_query($sql);
           $row=mysql_fetch_array($query);
                if($row[0] == 0){
                	 $_SESSION['error'] = "Mã đăng nhập không hợp lệ";
                } else{
                	//$_SESSION['isLoginUser'] = 'success';
                	setcookie('isLoginUser', 'success',time()+600);
                	$_SESSION['Code'] = $code;
                    header('Location: index.php');
                }               
               
           
        }
    }
    ?>

	<div class="banner">
			<img src="images/hinh.png">
		</div>
	<div class="content">
	</br>
		<div class="col-md-12">
			<div class="row">
			<?php if(isset($_SESSION['error'])){ ?>
			<span style="color: red;margin: 22px;display: block;">
				<?php  echo $_SESSION['error']; unset($_SESSION['error']); ?>
			</span>
			<?php  }?>

		<form role="form" action="user-login.php" method="post" enctype="multipart/form-data" onsubmit="return doUpload();">
		  <div class="form-group">
		  	
		  	
		  	<input class="form-control" type="text" name="name" placeholder="Họ và tên / Name">
		  	<br>
		  	<input class="form-control" type="number" name="phone" placeholder="Số điện thoại / Phone">
		  	<br>
		  	<input class="form-control" type="text" name="code" placeholder="Mã đăng nhập / Code">
		  	<br>
		   <input class="form-control" type="text" name="id_user" placeholder="Mã khách hàng / Code member">
		   </br>
		   <input type="submit"  class="btn btn-default" name="bt_login" value="Let's Go">
		   
		   </div>
		</form>
		
		</div>
		
		</div>
		</div>
		
</body>
</html>
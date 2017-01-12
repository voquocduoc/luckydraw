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
	<title>Đăng nhập chương trình quản lý</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
	<!-- <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> -->
	 <script type="text/javascript" src="js/function.js"></script>
	<script src="js/jquery-1.9.1.min.js"></script> 
	<script src="owl-carousel/owl.carousel.js"></script>
	   <!-- Owl Carousel Assets -->
    <link href="owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="owl-carousel/owl.theme.css" rel="stylesheet">

	<style type="text/css">
		.progress {
			position: relative;
		}

		.progress-text {
			position: absolute;
			width: 100%;
			height: 100%;
			text-align: right;
			padding-right: 5px;
			color: #333;
		}
	</style>
</head>
<body>
	<?php include('db.php'); //connect database ?>
<?php if (isset($_POST["bt_login"])) {
        // lấy thông tin người dùng
        $username = $_POST["username"];
        $password = $_POST["password"];
        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        if ($username == "" || $password =="") {
            $_SESSION['error'] = "username hoặc password bạn không được để trống!";
        }else{
            $sql = "select * from login where user = '$username' and pass = '$password' ";
            mysql_set_charset('utf8',$conn);
            $query=mysql_query($sql);

            if(mysql_num_rows($query) == 0){
                $_SESSION['error'] = "Tên đăng nhập/mật khẩu không chính xác, bạn vui lòng nhập lại. ";
            }
            else{

                while($row=mysql_fetch_array($query)){                    
                    $_SESSION['isLogin'] = 'success';
                    header('Location: admin123.php');
                }
            }
        }
    }
    ?><br><br>
	<div class="container">
		<div class="title">Đăng nhập</div><br>
		<div class="col-md-12">
			<div class="row">
			<?php if(isset($_SESSION['error'])){ ?>
			<span style="color: red;">
				<?php  echo $_SESSION['error']; unset($_SESSION['error']); ?>
			</span>
			<?php  }?>

		<form role="form" action="login.php" method="post" enctype="multipart/form-data" onsubmit="return doUpload();">
		  <div class="form-group">
		  	<label for="tile">Username :</label> <input class="form-control" type="text" name="username">
		  	<br>
		  	<label for="tile">Password :</label> <input class="form-control" type="password" name="password">
		  	<br>
		  	<br>
		   <input type="submit"  class="btn btn-default" name="bt_login" value="Đăng nhập">
		</form>
		<hr>
		</div>
		
		</div>
		
	</div>
 
</body>
</html>
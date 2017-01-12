<?php session_start();
if(!isset($_SESSION['isLogin']) ||  $_SESSION['isLogin'] != 'success' ){
     header('Location: login.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Mini Upload Tool</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style3.css" media="screen">
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

	<img src="images/progressbar.gif" style="display:none" />
	<div class="container">
		<div class="title">Upload hình ảnh</div>
		<div class="col-md-6">
			<div class="row">
		<form role="form" action="#" method="post" enctype="multipart/form-data" onsubmit="return doUpload();">
		  <div class="form-group">
		  	<label for="tile">Đặt tỉ lệ (%):</label> <input class="btn btn-default" type="number" name="tile" id='tile'>
		  	<br>
		  	<label for="">Giá trị giải thưởng :</label> <input class="btn btn-default" type="number" name="giatri" id='giatri'>
		  	<br>
		    <label for="myfile">File Upload</label>
		    <input type="file" class="form-control" name="myfile" id="myfile">
		  </div>	  
		  <input type="submit" class="btn btn-default" value="Upload" />
		  <input type="button" class="btn btn-default" value="Cancle" onclick="cancleUpload();"/>
		</form>
		<hr>
		</div>
		<div class="row">
			<div id="progress-group"  >
				<div class="progress">
			      <div class="progress-bar" style="width: 0%;">
			      
			      </div>
			      <div class="progress-text">
			      
			      </div>
			    </div>
			   
			</div>
		</div>
		</div>
		<div class="col-md-6">
			<?php 
			$files_and_folder = glob('uploads/*');

			 ?>
			 <div class="text-right"><a href="logout.php" title="" style="color: red">Đăng Xuất</a></div>
			<div class="row pd-lf">
				<div class="row mg-lf">
					<div class="left-top">Tên hình</div><div class="action">Action</div>

				</div>
				
				<?php foreach($files_and_folder as $get_img): ?>
						<?php $discount = mb_split("_",$get_img); ?>
						<div class="row mg-lf">
						<div class="left-top"><?php echo $discount[2].' - '.$discount[1].'%'; ?></div>
						<div class="action">
							<a href="delete.php?name=<?php echo $get_img ?>" title="<?php echo $get_img ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
						</div>
						</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div style="clear: both;"></div>
		<div class="row">
			<a href="index.php" title="Đến chương trình quay số">Đến chương trình quay số</a>
			<div class="row">
				<div class="group">
				<label>Thông tin chi tiết tỉ lệ trúng thưởng</label>
				</div>
				<?php 
				$files_and_folder = glob('uploads/*');
				 ?>
			</div>	
			<div class="row">
				 <div class="span12">
	              <div id="owl-demo" class="owl-carousel">
	                <?php foreach($files_and_folder as $get_img): ?>
						<div class="item"><img src="<?php echo $get_img ?>" style="text-align: center;">
						<p>xóa</p>
							<span><?php 
								$discount = mb_split("_",$get_img);
								echo $discount[1].' %'; ?></span>
						</div>
					<?php endforeach; ?>
	                
	                
	              </div>
	              
	            </div>
			</div>
		</div>
		
	</div>
  <script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
        autoPlay: 3000,
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]
      });

    });
    </script>
</body>
</html>
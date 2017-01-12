<?php 
@ob_start();
session_start();
if(!isset($_COOKIE['isLoginUser']) ||  $_COOKIE['isLoginUser'] != 'success' ){
     header('Location: user-login.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/Winwheel.js"></script>
        <script src="js/TweenMax.min.js"></script>
	<title>Chương trình quay số trúng thưởng</title>
</head>
<body>
<div class="title">
	<img src="images/hinh.png" alt="" style="width: 100%;">
</div>
<div class="wapper">
<div class="container-fluid margin-content">
	<?php 
		$files_and_folder = glob('uploads/*');
		 $ghepchuoi = implode(",",$files_and_folder);
		 $image_show_first = explode(",", $ghepchuoi);
		 /***** connect database ***/
		 include('db.php'); 
		$sql = "SELECT * FROM define_gift";
		$query=mysql_query($sql);
		$arr_list_rate =array();
		$arr_list_id = array();
		$arr_list_msg = array();
        while($row=mysql_fetch_array($query)){
        	$arr_list_rate[] = $row['ResultRate']*100;
        	$arr_list_id[] = $row['ID'];
        	$arr_list_msg[] = $row['Description'].":uploads/".$row['image'];
        }
        $str_rate = implode(",", $arr_list_rate);
        $str_id = implode(",", $arr_list_id);
        $str_msg = implode(",", $arr_list_msg);
?>		
		<input type="hidden" id="list_msg" value="<?php echo $str_msg ?>">
		<input type="hidden" id="list_id" value="<?php echo $str_id ?>">
		<input type="hidden" id="list_rate" value="<?php echo $str_rate ?>">
		<input type="hidden" id="savedata" value="<?php echo $ghepchuoi ?>">
<?php 

	if($_SESSION['Code']){
		 $code = $_SESSION['Code'];
		$sql = "SELECT fGetResult('".$code."')";
            mysql_set_charset('utf8',$con);
            $query=mysql_query($sql);
           $row=mysql_fetch_array($query);
                if($row[0] == -1){
                	$fn = -1;
                }else{
                	$fn = $row[0];
                }
	}

 ?>
 		<input type="hidden" id="item_code" value="<?php if($fn) echo $fn; ?>">
		<style type="text/css" media="screen">
			.image{
				       position: absolute;
    z-index: 3444;
    left: 382px;
    top: 305px;
    width: 226px;
			}
		</style>
	<div class="row">
		
		<div class="col-md-12">
			<div class="row">
				 <div align="center">
					 <table cellpadding="0" cellspacing="0" border="0">
				            <tr>
				                <td width="900" height="900" class="the_wheel" align="center" valign="center">
				                    <canvas id="canvas" width="800" height="800">
				                        <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
				                    </canvas>
				                    <img class="image" src="images/kim.png" alt="">
				                </td>
				            </tr>
				          <tr style="display: none">
				          	<td width="78" align="center" id="pw3" onClick="powerSelected(3);">High</td>
				          	<td align="center" id="pw2" onClick="powerSelected(2);">Med</td>
				          	<td align="center" id="pw1" onClick="powerSelected(1);">Low</td>
				          </tr> 
				        </table>
				        
				        <script type="text/javascript" >
							function runSpin(){
								/* tra ve gi tri trung thuong */
									var getdata = $('#savedata').val();
									var namefile = getdata.split(',');
									var list = new Array();
									var key = new Array();
									$.each(namefile, function(index, val) {
										 var sub = val.split("_");
										 list.push(parseInt(sub[1]));
										 key.push(index);
										
									});
								var list_rate_db = $('#list_rate').val().split(",");
								var key_id_db = $('#list_id').val().split(",");
								var isCode = $('#item_code').val();
									if(isCode != -1 && isCode !=""){
										return id = parseInt(isCode);
									}else{
										return result =  random(key_id_db,list_rate_db);
									}
						   			
						        }
						    function getFileShow(){
						  
								var segments_arr = new Array();
								var getdata = $('#list_msg').val().split(",");
								$.each(getdata, function(index, val) {
									var tonghop = new Array();
									var sub = val.split(":");
									tonghop['image']= sub[1];
									tonghop['text'] = sub[0];
									segments_arr.push(tonghop);
									
								
								 });
								//console.log(segments_arr);
								return segments_arr;
						    }
							function random(aa, pp){
									//var aa =new Array('0','10','20','30','40','50','100','100');
								   // var pp =new Array('0','50','10','10','10','10','5','5');
								
								    var data = new Array();
								    for (var i = 0; i < pp.length; i++){
								    		var gtri = pp[i];
								    		for(var j=0; j< pp[i] ;j++){
								    			data.push(aa[i]);
								    		}
								    }
								   var result =  Math.floor(Math.round(Math.random() * (data.length-1)));
							
								  return  data[result];
							}

						    function random2(a, p){
						    	var sum = 0;
						            for (var i = 0; i < p.length; i++) sum += p[i];
						            var x = Math.random() * sum; // do Math.random() trả về số ngẫu nhiên lớn hơn hoặc bằng 0 và nhỏ hơn 1
						            sum = 0;
						            for (var i = 0; i < p.length; i++) {
						                sum += p[i];
						                if (x < sum) return i;
						            }
						    }
						    
							</script>

				         <script>    

				            var theWheel = new Winwheel({
				                'numSegments'       : getFileShow().length,   // count item              
				                //'outerRadius'       : 200,               
				                'drawText'          : true,              
				                'textFontSize'      : 0,
				                'textOrientation'   : 'curved',
				                'textAlignment'     : 'inner',
				                'textMargin'        : '90',
				                'textFontFamily'    : 'monospace',
				                'outerRadius'  		: 200,   //thay doi khi thay doi kich thuoc anh  
				                'textStrokeStyle'   : 'black',
				                'textLineWidth'     : 3,
				                'textFillStyle'     : 'white',
				                'drawMode'          : 'segmentImage',    
				                'segments'          :                   
				                
				                   getFileShow()

				                ,
				                'animation' :          
				                {
				                    'type'     : 'spinToStop',
				                    'duration' : 5,     
				                    'spins'    : 8,    
				                    'callbackFinished' : 'alertPrize()'
				                }
				            });
				            
				            var wheelPower    = 0;
				            var wheelSpinning = false;
				            
				            function powerSelected(powerLevel)
				            {
				                if (wheelSpinning == false)
				                {
				                    // Reset all to grey incase this is not the first time the user has selected the power.
				                    document.getElementById('pw1').className = "";
				                    document.getElementById('pw2').className = "";
				                    document.getElementById('pw3').className = "";
				                    
				                    // Now light up all cells below-and-including the one selected by changing the class.
				                    if (powerLevel >= 1)
				                    {
				                        document.getElementById('pw1').className = "pw1";
				                    }
				                    if (powerLevel >= 2)
				                    {
				                        document.getElementById('pw2').className = "pw2";
				                    }
				                    if (powerLevel >= 3)
				                    {
				                        document.getElementById('pw3').className = "pw3";
				                    }
				                    
				                    // Set wheelPower var used when spin button is clicked.
				                    wheelPower = powerLevel;
				                    
				                    // Light up the spin button by changing it's source image and adding a clickable class to it.
				                    document.getElementById('spin_button').src = "images/spin_on.png";
				                    document.getElementById('spin_button').className = "clickable";
				                }
				            }
				          
				            function startSpin()
				            {
				                if (wheelSpinning == false)
				                {
				                    if (wheelPower == 1)
				                    {
				                        theWheel.animation.spins = 3;
				                    }
				                    else if (wheelPower == 2)
				                    {
				                        theWheel.animation.spins = 8;
				                    }
				                    else if (wheelPower == 3)
				                    {
				                        theWheel.animation.spins = 15;
				                    }
				                    
				                    // Disable the spin button so can't click again while wheel is spinning.
				                    // document.getElementById('spin_button').src       = "images/spin_off.png";
				                    // document.getElementById('spin_button').className = "";
									var id = runSpin();
									
				                    var stopAt = theWheel.getRandomForSegment(parseInt(id));

				                	theWheel.animation.stopAngle = stopAt;

				                    theWheel.startAnimation();
				                    
				                    wheelSpinning = true;
				                    $('#magiam').slideUp();
				                    $('#spin_button').slideUp();
				                    	/***** load ajax after run ****/
				                	jQuery.ajax({
					               	url: 'runfn/afterrun.php',
					               	type: 'POST',
					               	dataType: 'text',
					               	data: {data: id},
					               })
					               .done(function(result) {
					               console.log(done);
					               })
					               .fail(function() {
					               });

				                }
				            }
				   
			            	function resetWheel()
				            {	 //document.getElementById('spin_button').src       = "images/spin_on.png";
				            	//$('#spin_button').slideDown();
				            	$("#restart").slideUp();
				                $('#magiam').slideUp();
				                window.location="logout-user.php";
				                //theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
				                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
				                theWheel.draw();                // Call draw to render changes to the wheel.
				             
				                wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
				            }
				            
				            function alertPrize()
				            {
				            	var winningSegment = theWheel.getIndicatedSegment();
				            	$("#restart").slideDown('slow');
				                
				                if(parseInt(winningSegment.text)==0){
				                	alert('chúc bạn may mắn lần sau.');
				                	$('#magiam').slideUp();

				                }
				                else{
				                	/***** load ajax after run ****/
				                // 	jQuery.ajax({
					               // 	url: 'getdata.php',
					               // 	type: 'POST',
					               // 	dataType: 'text',
					               // 	data: {data: winningSegment.text},
					               // })
					               // .done(function(result) {
					               
					               // 	if(result =='hetma'){
					               // 		alert('Mã '+winningSegment.text+'% đã hết !');
					               // 		$("#restart").slideDown('slow');
					               // 		$('#magiam').slideUp();
					               		
					               // 	}else{
					               // 		$('#discount').val(result);
					               // 		$('#magiam').slideDown();
					               // 		//showpupop();
					               // 	}
					               // })
					               // .fail(function() {
					               // });

				                	alert(winningSegment.text);
				            		
				                };
				               //winningSegment.text
				            }
				        </script>
				</div>


		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
			</div>
		
		</div>
		
	</div>
</div>
</div>
<br>
	<div class="row auto_mg "  style="height: 100px;margin-top: 45px;">
	<div style="display: block;margin: auto;text-align: center;">
		<img id="spin_button" src="images/spin_on.png" alt="Spin" onClick="startSpin();" />
	    <img src="images/spin_lai.png" id="restart" onClick="resetWheel(); return false;" style="display: none" />
	</div>
		
	</div>
<div id="magiam" class="magiamgia form-inline" style="text-align: center;margin-top: 95px;font-size: 40px;padding-bottom: 20px;height: 50px;display: none;">
	<label for="discount" style="font-size: 40px;font-family: times;">Mã giảm giá</label>
	<input type="text" style="color: #000;
    text-align: center;
    width: 300px;
    font-size: 60px;
    height: 100px;
    border-radius: 1px;margin-right: 140px" id="discount" name="discount" class="form-control">
</div>

<!-- show pupop  -->
<div id="boxes">
  <div id="dialog" class="window">
   chúc bạn may mắn lần sau !
  </div>
  <div id="mask"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
</div>
<script type="text/javascript">
	function showpupop(){
		var id = '#dialog';
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
			
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		//transition effect
		$('#mask').fadeIn(500);	
		$('#mask').fadeTo("slow",0.9);	
			
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
		              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
			
		//transition effect
		$(id).fadeIn(2000); 
	}
	$(document).ready(function() {	
		$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();

			$('#mask').hide();
			$('.window').hide();
		});

		//if mask is clicked
		$('#mask').click(function () {
			$(this).hide();
			$('.window').hide();
		});
											
});
</script>						
</body>
</html>
<?php 
/* require the user as the parameter */
if(isset($_GET['user']) && $_GET['user'] != "" && isset($_GET['pw']) && $_GET['pw'] != "") {

	/* soak in the passed variable or set our own */
	
	$format = 'json'; //xml is the default
	$user = $_GET['user'];
 	$pw = $_GET['pw'];

	/* connect to the db */
	include('db.php');
	//fn run is here

	/* value is data input */
	
	$sql = "SELECT fGetOTP($user , $pw)";
           mysql_set_charset('utf8',$con);
           $query=mysql_query($sql);


	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
		while($post = mysql_fetch_assoc($result)) {
			$posts[] = array('post'=>$post);
		}
	}

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		echo json_encode(array('posts'=>$posts));
	}
	else {
		header('Content-type: text/xml');
		echo '<posts>';
		foreach($posts as $index => $post) {
			if(is_array($post)) {
				foreach($post as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		echo '</posts>';
	}
	/* disconnect from the db */
	@mysql_close($link);
	/* return link : http://mydomain.com/web-service.php?user=2&pw=10 */
}
else{
	echo 0;
}?>

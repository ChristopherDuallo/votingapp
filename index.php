<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/fblogin.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,500|Play|Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="main">
	<?php
		
		//error_reporting(E_ALL ^ E_NOTICE);
		require_once 'user.php';
		$app_id = '1493300637604035';
	    $app_secret = '01e59801d656f5f7cec7ab76afefb5f4';
	    $site_url = 'http://localhost/oovote/index.php';

	    

		$huyu = new fbuser($app_id, $app_secret, $site_url);
		$huyu->capture_user_info();

		

		
	?>

</div>
</body>
</html>	
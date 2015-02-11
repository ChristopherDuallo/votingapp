<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/fblogin.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,500|Play|Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="main">
	<?php
		require_once 'vote.php';

		$app_id = '1493300637604035';
	    $app_secret = '01e59801d656f5f7cec7ab76afefb5f4';
	    $site_url = 'http://localhost/oovote/index.php';

		
		if(!isset($_SESSION)){
		session_start();
		}
		$name = $_SESSION['name'];
		$fbid = $_SESSION['fbid'];

		$res = new vote($fbid);

		$res->vote_tally();


		echo '<a href="votepage.php">&larr; Vote Again</a>';
		echo '<a href="logout.php" style="float:right">Log Out &rarr;</a>';
	
		
	?>

</div>
</body>
</html>	
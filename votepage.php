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
	
	if(!isset($_SESSION)){
	session_start();
	}
	$name = $_SESSION['name'];
	$fbid = $_SESSION['fbid'];

	$kura = new vote($fbid);
	
	if($kura->can_vote_today()){ 
		echo 'You can vote 3 times every 24 hours';
		echo
		'<form name="voting" action="" method = "POST"><br>
		<input type ="radio"  name="fruit" value="apple" checked>Apple<br><br>
		<input type ="radio" name="fruit" value="mango">Mango<br><br>
		<input type ="radio" name="fruit" value="grape">Grape<br><br>
		<input type ="submit" name="vote" value="Vote" class="isset">

		</form>';

		if (isset($_POST['vote'])){
			$kura->record_vote();
		}
	}
	else{
		echo 'Your 3 votes have been cast, try again tomorrow!'; 
	}
	
	?>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/fblogin.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,500|Play|Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="main">
<?php
session_start();
session_destroy();
header("location:index.php");
?>
</div>
</body>
</html>
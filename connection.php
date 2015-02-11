<?php
$host = 'YOUR_HOST';
$dbname = 'YOUR_DBNAME';
$username = 'YOUR_USERNAME';
$password = 'YOUR_PASSWORD';

$dbh = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
$dbh -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
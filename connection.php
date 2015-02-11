<?php
$host = 'localhost';
$dbname = 'fbvoteapp';
$username = 'sysadmin';
$password = 'syspassword32';

$dbh = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
$dbh -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
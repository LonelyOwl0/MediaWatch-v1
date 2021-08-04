
<?php

$servername ="localhost";
$dbUserame = "root";
$password="";
$dbName="mediawatch";


$conn = new PDO('mysql:host='.$servername.';dbname='.$dbName,$dbUserame,$password);
$conn->exec('set names utf8');
$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);




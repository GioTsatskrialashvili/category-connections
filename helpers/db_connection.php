<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbname = 'news';

$conn = mysqli_connect($serverName, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');
if(!$conn){
    echo "connection failed";
    exit;
}

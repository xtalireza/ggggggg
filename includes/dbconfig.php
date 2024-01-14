<?php
$servername = "localhost";
$dbname = "users";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
ob_start();
if(!isset($_SESSION))
	session_start();
?>
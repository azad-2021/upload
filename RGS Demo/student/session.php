<?php 
session_start();
$_SESSION['user'];
$_SESSION['userid'];

if (!isset($_SESSION['user'])) {
	header('location:login.php');
}


?>
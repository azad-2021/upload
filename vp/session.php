<?php 
session_start();
$_SESSION['user'];
$_SESSION['userid'];

if (!isset($_SESSION['userid'])) {
	header('location:login.php');
}


?>
<?php 
include "connection.php";
$username=!empty($_POST['username'])?$_POST['username']:'';
if (!empty($username))
{
	$UserType=!empty($_POST['UserType'])?$_POST['UserType']:'';

	$query="SELECT * from user WHERE Status=1 and UserName='$username'";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result)>0)
	{
		echo 'User already exist';
	}else{

		$sql = "INSERT INTO user (UserName, UserType, Password)
		VALUES ('$username', '$UserType', 'vp@123')";

		if ($con->query($sql) === TRUE) {
			echo 1;
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

	}
}

$NewSeller=!empty($_POST['NewSeller'])?$_POST['NewSeller']:'';
if (!empty($NewSeller))
{
	$NewSellerNumber=!empty($_POST['NewSellerNumber'])?$_POST['NewSellerNumber']:'';
	$NewSellerNumber='+91'.$NewSellerNumber;
	$query="SELECT * from sellers WHERE SellerName='$NewSeller' and ContactNumber='$NewSellerNumber'";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result)>0)
	{
		echo 'Seller already exist';
	}else{

		$sql = "INSERT INTO sellers (SellerName, ContactNumber)
		VALUES ('$NewSeller', '$NewSellerNumber')";

		if ($con->query($sql) === TRUE) {
			echo 1;
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

	}
}

$NewCategory=!empty($_POST['NewCategory'])?$_POST['NewCategory']:'';
if (!empty($NewCategory))
{

	$query="SELECT * from category WHERE Category='$NewCategory'";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result)>0)
	{
		echo 'Category already exist';
	}else{

		$sql = "INSERT INTO category (Category)
		VALUES ('$NewCategory')";

		if ($con->query($sql) === TRUE) {
			echo 1;
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

	}
}

?>
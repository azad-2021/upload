<?php 
include "connection.php";

$userid=1;

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$m=date('m',strtotime($timestamp));
$y=date('y',strtotime($timestamp));

if ($m<=3) {
  $FY=($y-1).'-'.$y;

}else{
  $FY=$y.'-'.($y+1);
}


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


$NewItem=!empty($_POST['NewItem'])?$_POST['NewItem']:'';
if (!empty($NewItem))
{
	$Category=!empty($_POST['Category'])?$_POST['Category']:'';
	$SellingRate=!empty($_POST['SellingRate'])?$_POST['SellingRate']:'';
	$err=0;

	for ($i=0; $i < count($NewItem) ; $i++) { 

		$query="SELECT * from items WHERE CategoryID=$Category[$i] and ItemName='$NewItem[$i]'";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0)
		{
			echo $NewItem[$i].' already exist';
			$err=1;
			break;
		}
	}


	if ($err==0) {
		
		for ($i=0; $i < count($NewItem) ; $i++) { 

			$sql = "INSERT INTO items (ItemName, SellingRate, CategoryID, UpdatedDate, UpdatedByID)
			VALUES ('$NewItem[$i]', $SellingRate[$i], $Category[$i], '$Date', $userid)";

			if ($con->query($sql) === TRUE) {
				
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
				$err=1;
				break;
			}

		}

		if ($err==0) {
			echo 1;
		}

	}

}


$PurchaseRate=!empty($_POST['PurchaseRate'])?$_POST['PurchaseRate']:'';
if (!empty($PurchaseRate))
{
	$ItemID=!empty($_POST['ItemID'])?$_POST['ItemID']:'';
	$SellerID=!empty($_POST['SellerID'])?$_POST['SellerID']:'';
	$Qty=!empty($_POST['Qty'])?$_POST['Qty']:'';
	$PurchaseDate=!empty($_POST['PurchaseDate'])?$_POST['PurchaseDate']:'';
	$Discount=!empty($_POST['Discount'])?$_POST['Discount']:'';
	$ItemExpiry=!empty($_POST['ItemExpiry'])?$_POST['ItemExpiry']:'';
	$Amount=!empty($_POST['Amount'])?$_POST['Amount']:'';
	
	$query="SELECT * from purchase WHERE SellerID=$SellerID and ItemID=$ItemID and PurchaseDate='PurchaseDate'";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result)>0)
	{
		echo 'Purchase entry already exist';
	}else{

		$sql = "INSERT INTO purchase (ItemID, SellerID, PurchaseRate, Discount, Qty, PaidAmount, EntryByID, PurchaseDate, ExpiryDate, `TimeStamp`)
		VALUES ($ItemID, $SellerID, $PurchaseRate, $Discount, $Qty, $Amount, $userid, '$PurchaseDate', '$ItemExpiry', '$Date')";

		if ($con->query($sql) === TRUE) {
			echo 1;
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

	}
}


?>
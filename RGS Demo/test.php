<?php 
include"connection.php";
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Day = date('d',strtotime($timestamp));
//echo $Date;
if ($Day==11) {

  $query="SELECT SalaryAmount, StaffID from staff WHERE Inservice=1";
  $result = mysqli_query($con,$query);
  if(mysqli_num_rows($result)>0)
  {

    $query2="SELECT * from salarydetails WHERE SalaryOfMonth='$Date'";

    $result2 = mysqli_query($con,$query2);
    if(mysqli_num_rows($result2)>0)
    {

    }else{

      while($arr=mysqli_fetch_assoc($result)){
        $SalaryAmount=$arr['SalaryAmount'];
        $StaffID=$arr['StaffID'];

        $sql = "INSERT INTO salarydetails (StaffID, SalaryOfMonth, SalaryAmount)
        VALUES ($StaffID, '$Date', $SalaryAmount)";

        if ($con->query($sql) === TRUE) {



        } else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }


      }

    }
  }
}


$query ="SELECT sum(salarydetails.SalaryAmount), sum(salarydetails.ReceivedAmount), StaffName FROM salarydetails
join staff on salarydetails.StaffID=staff.StaffID
WHERE Inservice=1 GROUP BY salarydetails.StaffID";

$StaffArray=array();
$PendingSalaryArray=array();
$PendingSalary=0;
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_assoc($result)){
$StaffArray[]=$row['StaffName'];
$PendingSalaryArray[]=$row['sum(salarydetails.SalaryAmount)']-$row['sum(salarydetails.ReceivedAmount)'];
}

$PendingSalary=array_sum($PendingSalaryArray);

echo $PendingSalary;
?>
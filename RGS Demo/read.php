<?php
include ('connection.php');
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


$subjectlist=!empty($_POST['subjectlist'])?$_POST['subjectlist']:'';
if (!empty($subjectlist))
{


	$Data="SELECT * from subjects join class on subjects.ClassID=class.ClassID order by subjects.ClassID";
	$result=mysqli_query($con,$Data);
	if (mysqli_num_rows($result)>0)
	{   
		$Sr=1;
		while ($row=mysqli_fetch_assoc($result))
		{
			print "<tr>";
			print '<td>'.$Sr."</td>";
			print '<td>'.$row['SubjectName']."</td>";
			print '<td>'.$row['Class']."</td>";
			print '<td><buttoon type="button" class="btn btn-danger subdelete">Delete</button></td>';
			print "<tr>";             
			?>

			<?php 
			$Sr++;
		}
	}
}


$BranchID=!empty($_POST['BranchID'])?$_POST['BranchID']:'';
if (!empty($BranchID))
{
    $StudentData="SELECT StudentID, StudentName from students WHERE BranchID=$BranchID order by StudentName";
    $result = mysqli_query($con,$StudentData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Student</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['StudentID']."'>".$arr['StudentName']."</option><br>";
        }
    }
    
}

$BranchIDS=!empty($_POST['BranchIDS'])?$_POST['BranchIDS']:'';
if (!empty($BranchIDS))
{
    $StaffData="SELECT StaffID, StaffName from staff WHERE BranchID=$BranchIDS order by StaffName";
    $result = mysqli_query($con,$StaffData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Staff</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['StaffID']."'>".$arr['StaffName']."</option><br>";
        }
    }
    
}


$StudentID=!empty($_POST['StudentID'])?$_POST['StudentID']:'';
if (!empty($StudentID))
{
    $StudentData="SELECT CourseAmount from students WHERE StudentID=$StudentID";
    $result = mysqli_query($con,$StudentData);
    if(mysqli_num_rows($result)>0)
    {
        $arr=mysqli_fetch_assoc($result);
        echo $arr['CourseAmount'];
    }
    
}

$ClassIDAmount=!empty($_POST['ClassIDAmount'])?$_POST['ClassIDAmount']:'';
if (!empty($ClassIDAmount))
{
    $query="SELECT Fees from class WHERE ClassID=$ClassIDAmount";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
    	$arr=mysqli_fetch_assoc($result);
        echo $arr['Fees'];
    }
    
}


$StaffID=!empty($_POST['StaffID'])?$_POST['StaffID']:'';
if (!empty($StaffID))
{
    $query="SELECT SalaryAmount from staff WHERE StaffID=$StaffID";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
    	$arr=mysqli_fetch_assoc($result);
        echo $arr['SalaryAmount'];
    }
    
}


$StaffIDD=!empty($_POST['StaffIDD'])?$_POST['StaffIDD']:'';
if (!empty($StaffIDD))
{
    $query="SELECT * from salarydetails WHERE StaffID=$StaffIDD and (SalaryAmount-ReceivedAmount)>1";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
       while($row = mysqli_fetch_array($result)){
           print "<tr>";
           print '<td>'.$row['SalaryAmount']."</td>";
           print '<td>'.date('M-Y',strtotime($row['SalaryOfMonth']))."</td>";
           print '<td>'.$row['SalaryAmount']-$row['ReceivedAmount']."</td>";
           print '<td><input style="color:white" type="number" class="form-control" id="'.$row['ID'].'" min="0"></td>';             
           print '<td><button type="button" id2="'.$row['ID'].'" class="btn btn-primary SaveSalary">Release</button></td>';
           print "</tr>";
       }
   }

}

?>
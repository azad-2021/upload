<?php
include ('connection.php');
$Subject=!empty($_POST['subject'])?$_POST['subject']:'';
if (!empty($Subject))
{
    $ClassID=!empty($_POST['ClassID'])?$_POST['ClassID']:'';
    $sql = "INSERT INTO subjects (SubjectName, ClassID)
    VALUES ('$Subject', $ClassID)";

    if ($con->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }

}

?>
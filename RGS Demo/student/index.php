<?php 

include"connection.php";
include"session.php";
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=$_SESSION['userid'];
$TakenLeave=0;

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}





$query ="SELECT COUNT(StudentID) FROM `attendencedetails` WHERE StudentID=$userid";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$TotalWorking=$row['COUNT(StudentID)'];

$query ="SELECT COUNT(StudentID) FROM `attendencedetails` WHERE AttendanceStatus=1 and StudentID=$userid;";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$Present=$row['COUNT(StudentID)'];

if ($TotalWorking==0) {
  $Attendance=0;
}else{
  $Attendance=($Present/$TotalWorking)*100;
  $Attendance=number_format((float)$Attendance, 2, '.', '');
}
$query ="SELECT * FROM students WHERE StudentID=$userid";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$TotalFees=$row['CourseAmount'];
$PendingFees=$row['CourseAmount']-$row['ReceivedAmount'];

$AtData=array();
$AtDate=array();
$query ="SELECT AttendanceStatus, `Date` FROM u241098585_college_demo.attendencedetails WHERE StudentID=$userid order by `Date` desc Limit 7";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result)>0)
{   

  while ($row=mysqli_fetch_assoc($result))
  {
    $AtData[]=$row['AttendanceStatus'];
    $AtDate[]=date('d-M-Y',strtotime($row['Date']));
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <script src="../assets/js/sweetalert.min.js"></script>
  <style type="text/css">
    input, textarea{
      color: white;
    }

  </style>
</head>
<body>
  <div class="container-scroller">
    <?php 

    include"nav.php";
    ?>
    <!-- partial -->
    <div class="main-panel">

      <?php 

      include"modals.php";
      ?>
      <div class="content-wrapper">
        <div class="row">
          <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0"><?php echo $Attendance.' %'; ?></h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success ">
                      <span class="mdi mdi-poll icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Attendance</h6>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0"><i class="mdi mdi-currency-inr"></i><?php echo $TotalFees; ?></h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success">
                      <span class="mdi mdi-poll icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Fees</h6>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0"><i class="mdi mdi-currency-inr"></i><?php echo $PendingFees; ?></h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success ">
                      <span class="mdi mdi-poll icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Pending Fees</h6>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Your Attendance (Last 7 days)</h4>
                <canvas id="PercentageAttandance" style="height:230px"></canvas>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-xl-12">
            <h4>Fees Status</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <th>Sr No</th>
                  <th>Fees Amount</th>
                  <th>Submit Date</th>
                  <th>Receipt No</th>
                  <th>Remark</th>
                </thead>
                <tbody>
                  <?php
                  $query="SELECT * FROM feesdetails WHERE StudentID=$userid";

                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)>0){
                    $Sr=0;
                    while($row=mysqli_fetch_assoc($result)){
                      if (!empty($row['UpdatedDate'])) {
                        $UpdateDate=date('d-m-Y',strtotime($row['UpdatedDate']));
                      }else{
                        $UpdateDate='';
                      }
                      $Sr++;
                      print "<tr>";
                      print '<td>'.$Sr."</td>";
                      print '<td>'.$row['ReceivedAmount']."</td>";
                      print '<td>'.$UpdateDate."</td>";
                      print '<td>'.$row['ReceiptNo']."</td>";
                      print '<td>'.$row['Remark']."</td>";
                      print "</tr>";
                    }
                  }?>
                </tbody>
              </table>
            </div>
          </div>
          

          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2022 abc </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed and monitored by <a href="https://starlaboratories.in/" target="_blank">STAR Laboratories</a>
              </span>
            </div>
          </footer>

        </div>

      </div>

    </div>
    <script type="text/javascript">
      var AtDate= <?php print_r(json_encode($AtDate)); ?>;
      var AtData= <?php print_r(json_encode($AtData)); ?>;
    </script>
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <script src="js/chart.js"></script>
    <!-- End custom js for this page -->

    <script type="text/javascript">
      
    </script>

  </body>
  </html>

  <?php //echo $TotalWorking;
  $con->close(); ?>
<?php 

include"connection.php";
include"session.php";
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=$_SESSION['userid'];

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

$query ="SELECT * FROM staff join coordinators on staff.StaffID=coordinators.StaffID
WHERE staff.StaffID=$userid";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$TotalLeave=$row['StaffLeave'];
$TakenLeave=$row['TakenLeave'];
$BranchID=$row['BranchID'];
$Year=$row['Year'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Student Attendance</title>
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
  <link rel="stylesheet" type="text/css" href="../datatable/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../datatable/css/dataTables.bootstrap5.min.css">

  <style type="text/css">

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
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Staff Leave Status</h4>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered border-primary table-light" id="example">
                    <thead>
                      <th>Student Name</th>
                      <th>Father's Name</th>
                      <th>Lateral Entry</th>
                      <th>Today Attendance</th>
                      <th>Attendance</th>
                    </tr>
                  </thead>
                  <tbody id="StudentData">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer" style="margin-top:150px">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2022 abc </span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed and monitored by <a href="https://starlaboratories.in/" target="_blank">STAR Laboratories</a>
          </span>
        </div>
      </footer>

    </div>
  </div>
</div>


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
<script src="../datatable/js/jquery.dataTables.min.js"></script>
<script src="../datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="ajax.js"></script>
<script type="text/javascript">
  var Year=<?php echo $Year; ?>;
  var BranchIDS=<?php echo $BranchID; ?>;
  console.log(Year);
  $(document).ready(function() {

    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'Studentlist':'subjectlist', 'Year':Year, 'Branch':BranchIDS},
      success:function(result){
        $('#StudentData').html(result);
        $('#example').DataTable();
      }
    });

  });

</script>

</body>
</html>

<?php   $con->close(); ?>
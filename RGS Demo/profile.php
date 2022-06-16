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

$Data="SELECT * from user WHERE UserID=$userid";
$result=mysqli_query($con,$Data);
$rowx=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profile</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <script src="assets/js/sweetalert.min.js"></script>


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.1/css/searchPanes.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">

  <style type="text/css">
  .cen {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
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
        <center>
          <div class="row">
            <div class="col-lg-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profile</h4>
                  <form class="forms-sample">
                    <div class="form-group" style="align-items: center;">
                      <label for="username">Username</label>
                      <input type="text" style="color:white;" class="form-control" name="Username" value="<?php echo $rowx['UserName']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" style="color:white;" class="form-control" name="Email1" value="<?php echo $rowx['Email']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Change Password</label>
                      <input type="password" style="color:white;" class="form-control" name="Password" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                      <input type="password" style="color:white;" class="form-control" name="NewPassword" placeholder="New Password">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profile</h4>
                  <form class="forms-sample">
                    <div class="form-group" style="align-items: center;">
                      <label for="username">Username</label>
                      <input type="text" style="color:white;" class="form-control" name="Username" value="<?php echo $rowx['UserName']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" style="color:white;" class="form-control" name="Email1" value="<?php echo $rowx['Email']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Change Password</label>
                      <input type="password" style="color:white;" class="form-control" name="Password" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                      <input type="password" style="color:white;" class="form-control" name="NewPassword" placeholder="New Password">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </center>

        <footer class="footer" style="margin-top:200px;">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2022 abc </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed and monitored by <a href="https://starlaboratories.in/" target="_blank">STAR Laboratories</a>
            </span>
          </div>
        </footer>

      </div>
    </div>
  </div>

  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->

  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/2.0.1/js/dataTables.searchPanes.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

  <script type="text/javascript">

    $(document).ready(function() {
      $('#example').DataTable({
        searchPanes: {
          layout: 'columns-6'
        },
        dom: 'Plfrtip',
        columnDefs: [
        {
          searchPanes: {
            show: true
          },
          targets: [3, 4, 5,9,10,12]
        }
        ]
      });
    });

    $(document).on('change', '#CourseIDSt', function(){
      var CourseID= $(this).val();
      console.log(CourseID);
      if(CourseID){
        $.ajax({
          type:'POST',
          url:'search.php',
          data:{'CourseID':CourseID},
          success:function(result){
            $('#BranchIDSt').html(result);
          }
        }); 
      }else{
        $('#BranchIDSt').html('<option value="">Branch</option>'); 
      }

    });

    $(document).on('change', '#BranchIDSt', function(){
      var BranchID= $(this).val();

      if(BranchID){
        $.ajax({
          type:'POST',
          url:'read.php',
          data:{'BranchIDSt':BranchID},
          success:function(result){
            $('#StudentData').html(result);
          }
        }); 
      }

    });



    $(document).on('click', '.FeesDetails', function(){

      var StudentID=$(this).attr("id");
      var delayInMilliseconds = 1000; 

      setTimeout(function() {
        if (StudentID) {
          $.ajax({
            type:'POST',
            url:'read.php',
            data:{'StudentIDFees':StudentID},
            success:function(result){
              $('#FeesData').html(result);
            }
          });
        }
      }, delayInMilliseconds)
    });



  </script>

</body>
</html>

<?php   $con->close(); ?>
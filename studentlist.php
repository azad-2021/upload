<?php 
include 'connection.php';
//include 'session.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">School Demo</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <?php include"nav.php"; ?>
  </header><!-- End Header -->
  <?php include"sidebar.php"; ?>

  <main id="main" class="main">
    <?php include"modals.php"; ?>
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="modal fade" data-bs-backdrop="static" id="ViewBill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-corner">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Bill Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="billdata">

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <br>
          <div class="card-body">

            <center>
              <div class="pagetitle">
                <h1>Group By Bank & Zone</h1>
              </div>
            </center>
            <div class="table-responsive container">
              <table width="100%" class="table table-bordered border-primary datatable">
                <thead>
                  <tr>
                    <th style="min-width: 200px">Name</th>
                    <th style="min-width: 50px">Class</th>
                    <th style="min-width: 50px">Gender</th>
                    <th style="min-width: 150px">Father's Name</th> 
                    <th style="min-width: 150px">Mother's Name</th>
                    <th style="min-width: 180px">Aadhar Card Number</th>
                    <th style="min-width: 150px">Mobile Number</th>
                    <th style="min-width: 200px">Address</th>
                    <th style="min-width: 150px">Registration Date</th>   
                  </tr>
                </thead>
                <tbody >
                  <?php 
                  $query="SELECT * FROM students join class on students.ClassID=class.ClassID WHERE Passout=0";

                  $result=mysqli_query($con,$query);
                  while($row = mysqli_fetch_array($result)){

                    ?>
                    <tr>
                      <td><?php echo $row["StudentName"]; ?></td>
                      <td><?php echo $row["Class"]; ?></td>
                      <td><?php echo $row["Gender"]; ?></td> 
                      <td><?php echo $row["FatherName"]; ?></td> 
                      <td><?php echo $row["MotherName"]; ?></td>
                      <td><?php echo $row["AadharCardNo"]; ?></td> 
                      <td><?php echo $row["MobileNo"]; ?></td> 
                      <td><?php echo $row["Address"]; ?></td>
                      <td><?php echo $row["RegistrationDate"]; ?></td> 
                    </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
            <br><br>

          </div>
        </div>
      </div>
      <!-- End Recent Sales -->
    </div>
  </div>
  <!-- End Left side columns -->

</section>
</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright 2022 <strong><span>Ramanujan Learning Center</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    Designed by <a href="https://www.starlaboratries.in" target="_blank">STAR Laboratries</a>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: true,
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal( {
            header: function ( row ) {
              var data = row.data();
              return 'Details for '+data[0]+' '+data[1];
            }
          } ),
          renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
            tableClass: 'table'
          } )
        }
      },
      stateSave: true,
    } );
  } );

  $(document).on('click', '.view_Bills', function(){
    var Zone = $(this).attr("id");
    var Bank=$(this).attr("id2");
    var Type=$(this).attr("id3");
    console.log(Zone);
    console.log(Bank);
    $.ajax({
     url:"BillsData.php",
     method:"POST",
     data:{Zone:Zone, Bank:Bank, Type:Type},
     success:function(data){
      $('#billdata').html(data);
      $('#ViewBill').modal('show');
    }
  });
  });


</script>
</body>

</html>

<?php 
$con->close();
?>
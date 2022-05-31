<?php 

include"connection.php";

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Staff List</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">





  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <style type="text/css">
  input, textarea{
    color: white;
  }
  .table-bordered{
    border-radius: 5px;
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

        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Staff Leave Status</h4>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered border-primary table-light" id="example">
                    <thead>
                      <th>Staff Name</th>                      
                      <th>Email</th>
                      <th>Aadhaar Card No.</th>
                      <th>Mobile</th>    
                      <th>Address</th>                      
                      <th>Education Details</th>
                      <th>Salary Amount</th>
                      <th>Total Leave</th>
                      <th>Consumed Leave</th>
                      <th>Joining Date</th>
                      <th>Class Appointed</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                    $query ="SELECT * FROM u241098585_school_demo.staff WHERE Inservice=1";
                    $result = mysqli_query($con, $query);
                    while($row=mysqli_fetch_assoc($result)){

                      $StaffID=$row['StaffID'];
                      $query2 ="SELECT * FROM u241098585_school_demo.class WHERE StaffID=$StaffID";
                      $result2 = mysqli_query($con, $query2);
                      if (mysqli_num_rows($result2)>0){
                        $row2=mysqli_fetch_assoc($result2);
                        $Class=$row['Class'];
                      }else{
                        $Class='NA';
                      }                      

                        ?>
                        <tr>
                          <td><?php echo $row['StaffName']; ?></td>
                          <td><?php echo $row['Email']; ?></td>
                          <td><?php echo $row['AadharCardNo']; ?></td>
                          <td><?php echo $row['MobileNo']; ?></td>
                          <td><?php echo $row['Address']; ?></td>
                          <td><?php echo $row['EducationDetails']; ?></td>
                          <td><?php echo $row['SalaryAmount']; ?></td>
                          <td><?php echo $row['StaffLeave']; ?></td>
                          <td><?php echo $row['TakenLeave']; ?></td>                                   
                          <td><?php echo $row['EntryDate']; ?></td>
                          <td><?php echo $Class; ?></td>
                        </tr>
                        <?php 
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
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
  <script src="assets/js/chart.js"></script>
  <!-- End custom js for this page -->

  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

  <script type="text/javascript">

    $(document).ready(function () {
      $('#example').DataTable();
    });

    $(document).on('click', '.SaveSubject', function(){
      var subject = document.getElementById("subject").value;
      var ClassID= document.getElementById("SubClass").value;
      if (subject!='' && ClassID !='') {
        $.ajax({
          type:'POST',
          url:'insert.php',
          data:{'subject':subject, 'ClassID':ClassID},
          success:function(data){
            swal("success","Subject added","success"); 
            $('#AddSubject').modal('hide');
            $('#Fsubject').trigger("reset");
          }
        });
      }
    });

    $(document).on('click', '.sublist', function(){
      $.ajax({
        type:'POST',
        url:'read.php',
        data:{'subjectlist':'subjectlist'},
        success:function(result){
          $('#sublist').html(result);
        }
      });
    });



    $(document).on('change', '#FeesClass', function(){
      var ClassID=$(this).val();
      console.log(ClassID);
      if (ClassID) {
        $.ajax({
          type:'POST',
          url:'read.php',
          data:{'ClassID':ClassID},
          success:function(result){
            $('#FeesStudent').html(result);
            $.ajax({
              type:'POST',
              url:'read.php',
              data:{'ClassIDAmount':ClassID},
              success:function(result){
                document.getElementById("Fees").value=(result);
              }
            });
          }
        });
      }
    });


    $(document).on('click', '.SaveFees', function(){
      var Fees = document.getElementById("Fees").value;
      var StudentID= document.getElementById("FeesStudent").value;
      var Month = document.getElementById("FeesMonth").value;
      var Amount = document.getElementById("FeesAmount").value;
      console.log(Month);
      if (StudentID!='' && Fees !='' && Month!='' && Amount!='') {
        $.ajax({
          type:'POST',
          url:'insert.php',
          data:{'FeesAmount':Amount, 'Fees':Fees, 'Month':Month, 'StudentID':StudentID},
          success:function(result){
            swal("success","Fees Updated","success"); 
            $('#re').html(result);
            $('#AddFees').modal('hide');
            $('#FeesForm').trigger("reset");
          }
        });
      }
    });


    $(document).on('click', '.SearchStudent', function(){
      var Name = document.getElementById("FStudentName").value;
      if (Name) {
        $.ajax({
          type:'POST',
          url:'search.php',
          data:{'StudentName':Name},
          success:function(result){
            $('#StudentData').html(result);
            $('#StudentDetails').modal('show');
          }
        });
      }
    });


    $(document).on('change', '#StaffIDS', function(){
      var StaffID=$(this).val();
      console.log(StaffID);
      if (StaffID) {
        $.ajax({
          type:'POST',
          url:'read.php',
          data:{'StaffID':StaffID},
          success:function(result){
            document.getElementById("SalaryAmount").value=(result);
          }
        });
      }
    });

    $(document).on('click', '.SaveSalary', function(){
      var Salary = document.getElementById("Salary").value;
      var StaffID= document.getElementById("StaffIDS").value;
      var Month = document.getElementById("SalaryMonth").value;
      var Amount = document.getElementById("SalaryAmount").value;
      console.log(Month);
      if (StaffID!='' && Salary !='' && Month!='' && Amount!='') {
        $.ajax({
          type:'POST',
          url:'insert.php',
          data:{'SalaryAmount':Amount, 'Salary':Salary, 'Month':Month, 'StaffID':StaffID},
          success:function(result){
            swal("success","Salary Updated","success"); 
            $('#re').html(result);
            $('#AddSalary').modal('hide');
            $('#SalaryForm').trigger("reset");
          }
        });
      }
    });
  </script>

</body>
</html>

<?php   $con->close(); ?>
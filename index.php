<?php 
include"connection.php";

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=1;

if (isset($_POST['SaveStaff'])) {
  $Name=$_POST['StaffName'];
  $Mobile=$_POST['StaffNumber'];
  $Aadhar=$_POST['StaffAadhar'];
  $Gender=$_POST['Gender'];
  $Address=$_POST['StaffAddress'];
  $Education=$_POST['StaffEducation'];
  $Email=$_POST['StaffEmail'];
  $Salary=$_POST['SalaryAmount'];

  $file_name = $_FILES['Resume']['name'];
  $file_size =$_FILES['Resume']['size'];
  $file_tmp =$_FILES['Resume']['tmp_name'];
  $file_type=$_FILES['Resume']['type'];
  $tmp = explode('.', $_FILES['Resume']['name']);
  $file_ext = strtolower(end($tmp));    
  $Resume=$Name.".".$file_ext;         
  $extensions= array("pdf");

  $errors='';
  $query ="SELECT * FROM `staff` WHERE MobileNo=$Mobile";
  $result1 = mysqli_query($con, $query);
  

  $query ="SELECT * FROM `staff` WHERE Email='$Email'";
  $result2 = mysqli_query($con, $query);

  if(in_array($file_ext,$extensions)=== false){
    $errors ='<script>alert("File must be pdf")</script>';
  }elseif($file_size > 2097152){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif($file_size == 0){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif(strlen((string)$Mobile<10)){
    $errors='<script>alert("Mobile Number Must Be 10 Digit Long")</script>';
  }elseif (mysqli_num_rows($result1)>0){
    $errors='<script>alert("Mobile Number Already Exist")</script>';
  }elseif (mysqli_num_rows($result2)>0){
    $errors='<script>alert("Email Already Exist")</script>';
  }

  if (empty($errors)) {

    $sql = "INSERT INTO staff (StaffName, MobileNo, Email, AadharCardNo, Address, EducationDetails, Password, EntryDate, EntryByID, Gender, SalaryAmount)
    VALUES ('$Name', $Mobile, '$Email', $Aadhar, '$Address', '$Education', 'ramanujan@123', '$Date', $userid, '$Gender', $Salary)";

    if ($con->query($sql) === TRUE) {
      $Upload=move_uploaded_file($file_tmp,"resume/".$Resume);
      echo '<script>alert("Staff added successfully")</script>';
      echo "<meta http-equiv='refresh' content='0'>";
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  }else{
    echo $errors;
  }
  $con->close();

}



if (isset($_POST['SaveStudent'])) {
  $Name=$_POST['StudentName'];
  $Class=$_POST['StudentClass'];
  $Father=$_POST['Father'];
  $Mother=$_POST['Mother'];
  $Gender=$_POST['Gender'];
  $Address=$_POST['Address'];
  $Aadhar=$_POST['Aadhar'];
  $Mobile=$_POST['Mobile'];

  $file_name = $_FILES['image']['name'];
  $file_size =$_FILES['image']['size'];
  $file_tmp =$_FILES['image']['tmp_name'];
  $file_type=$_FILES['image']['type'];
  $tmp = explode('.', $_FILES['image']['name']);
  $file_ext = strtolower(end($tmp));    
  $file=$Aadhar.".".$file_ext;         
  $extensions= array("jpeg", "JPEG", "jpg", "JPG");

  $errors='';

  if(in_array($file_ext,$extensions)=== false){
    $errors ='<script>alert("File must be pdf")</script>';
  }elseif($file_size > 2097152){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif($file_size == 0){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif(strlen((string)$Mobile<10)){
    $errors='<script>alert("Mobile Number Must Be 10 Digit Long")</script>';
  }

  if (empty($errors)) {

    $sql = "INSERT INTO students (StudentName, ClassID, Gender, FatherName, MotherName, AadharCardNo, MobileNo,  Address, Password, RegistrationDate, RegisteredByID )
    VALUES ('$Name', $Class, '$Gender', '$Father', '$Mother', $Aadhar, $Mobile, '$Address', 'ramanujan@123', '$Date', $userid)";

    if ($con->query($sql) === TRUE) {
      $Upload=move_uploaded_file($file_tmp,"student_pic/".$file);
      echo '<script>alert("Student added successfully")</script>';
      echo "<meta http-equiv='refresh' content='0'>";
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  }else{
    echo $errors;
  }
  $con->close();

}

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

      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total <span>| Students</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>1244</h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Total <span>|Pending Fees</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class='bx bx-rupee'></i>
                </div>
                <div class="ps-3">
                  <h6>1244</h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-4">

          <div class="card info-card customers-card">

            <div class="card-body">
              <h5 class="card-title">Total <span>|Pending Salary</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class='bx bx-rupee'></i>
                </div>
                <div class="ps-3">
                  <h6>1244</h6>
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

        <!-- Reports -->
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total <span>/Pending Fees </span></h5>

              <!-- Line Chart -->
              <div id="PendingFees"></div>

            </div>

          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pending <span>/Salary</span></h5>

              <!-- Line Chart -->
              <div id="PendingSalary"></div>

            </div>

          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Percentage <span>/Class Attendence </span></h5>

              <!-- Line Chart -->
              <div id="ClassAttendence"></div>

            </div>

          </div>
        </div>


        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Percentage <span>/Staff Attendence </span></h5>

              <!-- Line Chart -->
              <div id="StaffAttendence"></div>

            </div>

          </div>
        </div>

        <!-- End Reports -->

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <h5 class="card-title">Staff <span>| List</span></h5>

              <table class="table table-bordered border-primary datatable">
                <thead>
                  <tr>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Staff Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $query ="SELECT * FROM `staff`";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)>0){
                    $sr=1;
                    while($row=mysqli_fetch_assoc($result)){
                      if ($row['Inservice']==1) {
                        $Status='<span class="badge bg-success">Active</span>';
                      }else{
                        $Status='<span class="badge bg-danger">Deactivated</span>';
                      }
                      ?>
                      <tr>
                        <th><?php echo $sr; ?></th>
                        <td><?php echo $row['StaffName'] ?></td>
                        <td><?php echo $row['MobileNo'] ?></td>
                        <td><?php echo $row['Email'] ?></td>
                        <td><?php echo $Status ?></td>
                      </tr>
                      <?php 
                      $sr++;
                    }}
                    ?>
                  </tbody>
                </table>

              </div>

            </div>
          </div><!-- End Recent Sales -->

          <!-- Top Selling -->
          <div class="col-12">
            <div class="card top-selling overflow-auto">

              <div class="card-body pb-0">
                <h5 class="card-title">Top 10<span>| Students</span></h5>

                <table class="table table-bordered border-primary datatable">
                  <thead>
                    <tr>
                      <th scope="col">Sr. No.</th>
                      <th scope="col">Student Name</th>
                      <th scope="col">Class</th>
                      <th scope="col">Contact Number</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>ABC</td>
                      <td>1</td>
                      <td>123456789</td>
                    </tr>
                  </tbody>
                </table>

              </div>

            </div>
          </div><!-- End Top Selling -->

        </div>
      </div><!-- End Left side columns -->
      <div id="re"></div>
    </div>
  </section>

</main><!-- End #main -->

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
  var colors = ["#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff"];
  var hoverBackground='rgba(200, 200, 200, 1)';
  var hoverBorder='rgba(200, 200, 200, 1)';
  var xcolor=["#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1"];

  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }


  function limit(element)
  {
    var max_chars = 10;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }

  var options = {
    series: [{
      data:  [31, 40, 28, 51, 42, 82, 56, 100, 1100, 1200, 1245, 111]
    }],
    chart: {
      height: 350,
      type: 'bar',
      events: {
        click: function(chart, w, e) {
          console.log(chart, w, e)
        }
      }
    },
    colors: colors,
    plotOptions: {
      bar: {
        columnWidth: '45%',
        distributed: true,
      }
    },
    dataLabels: {
      enabled: false
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      labels: {
        style: {
          colors: xcolor,
          fontSize: '12px'
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#ClassAttendence"), options);
  chart.render();


  var options2 = {
    series: [{
      data:  [31, 40, 28, 51, 42, 82, 56, 100, 1100, 1200, 1245, 111]
    }],
    chart: {
      height: 350,
      type: 'bar',
      events: {
        click: function(chart, w, e) {
          console.log(chart, w, e)
        }
      }
    },
    colors: colors,
    plotOptions: {
      bar: {
        columnWidth: '45%',
        distributed: true,
      }
    },
    dataLabels: {
      enabled: false
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      labels: {
        style: {
          colors: xcolor,
          fontSize: '12px'
        }
      }
    }
  };
  var chart = new ApexCharts(document.querySelector("#PendingFees"), options2);
  chart.render();



  var options = {
    series: [{
      data:  [31, 40, 28, 51, 42, 82, 56, 100, 1100, 1200, 1245, 111]
    }],
    chart: {
      height: 350,
      type: 'bar',
      events: {
        click: function(chart, w, e) {
          console.log(chart, w, e)
        }
      }
    },
    colors: colors,
    plotOptions: {
      bar: {
        columnWidth: '45%',
        distributed: true,
      }
    },
    dataLabels: {
      enabled: false
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      labels: {
        style: {
          colors: xcolor,
          fontSize: '12px'
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#StaffAttendence"), options);
  chart.render();


  var options3 = {
    series: [{
      data:  [31, 40, 28, 51, 42, 82, 56, 100, 1100, 1200, 1245, 111]
    }],
    chart: {
      height: 350,
      type: 'bar',
      events: {
        click: function(chart, w, e) {
          console.log(chart, w, e)
        }
      }
    },
    colors: colors,
    plotOptions: {
      bar: {
        columnWidth: '45%',
        distributed: true,
      }
    },
    dataLabels: {
      enabled: false
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      labels: {
        style: {
          colors: xcolor,
          fontSize: '12px'
        }
      }
    }
  };
  var chart = new ApexCharts(document.querySelector("#PendingSalary"), options3);
  chart.render();

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
<?php include "connection.php";


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home</title>
  <?php include "header.php"; ?>
</head>
<body>

  <!-- Side Navbar -->
  <?php include "sidebar.php"; ?>
  <!-- Counts Section -->

  <section class="py-5">
    <div class="container-fluid">

      <!-- modals -->
      <?php include "modals.php"; ?>
      <!-- modal closed -->


      <div class="row">
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#numbers-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Today Billing</h3>
              <p class="text-gray-500 small"></p>
              <p class="display-6 mb-0">123</p>
            </div>
          </div>
        </div>
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#numbers-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Total Billing</h3>
              <p class="text-gray-500 small"></p>
              <p class="display-6 mb-0">123</p>
            </div>
          </div>
        </div>
        <!-- Count item widget-->
        <div class="col-xl-3 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Total items in stock</h3>
              <p class="text-gray-500 small"></p>
              <p class="display-6 mb-0">92</p>
            </div>
          </div>
        </div>


        <!-- Count item widget-->
        <div class="col-xl-3 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Income current month</h3>
              <p class="text-gray-500 small"></p>
              <p class="display-6 mb-0">92</p>
            </div>
          </div>
        </div>

        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Total income</h3>
              <p class="text-gray-500 small"></p>
              <p class="display-6 mb-0">92</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- Header Section-->
  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">


        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Sales marketing report</h2>
            <p class="text-sm text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet officiis</p>
            <canvas id="lineCahrt"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">


        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Item less than 25 in stock</h2>                       
            <canvas id="lineCahrt"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">


        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Item about to expire</h2>
            <canvas id="lineCahrt"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include "footer.php"; 

  ?>
  <script type="text/javascript">

/*
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{'username':username, 'UserType':UserType},
     success:function(result){
      if((result)==1){

        SuccessAlert('User Created');
        $('#AddUserF').trigger("reset");
        $('#AddUser').modal("hide");


      }else{

        Swal.fire({
          title: 'Error!',
          text: (result),
          icon: 'error',
          confirmButtonText: 'OK'
        })

      }
    }
  });*/


  function limit(element)
  {
    var max_chars = 10;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }

  $(document).on('click', '.close', function(){
    $('#AddUserF').trigger("reset");
    $('#AddSellerF').trigger("reset");
    $('#AddCategoryF').trigger("reset");
    $('#AddItemsF').trigger("reset");
  });


  function EmptyErrorAlert(){
    Swal.fire({
      title: 'Error!',
      text: 'Please enter all fields',
      icon: 'error',
      confirmButtonText: 'OK'
    })
  }

  function SuccessAlert(data){
    Swal.fire({
      title: 'success!',
      text: data,
      icon: 'success',
      confirmButtonText: 'OK'
    })
  }


  function AjaxPost(Page, Data, Modal, Form, Success){

    if (Modal!='NA') {

      $.ajax({
       url:Page,
       method:"POST",
       data:Data,
       success:function(result){

        if((result)==1){
          SuccessAlert(Success);
          $(Form).trigger("reset");
          $(Modal).modal("hide");

        }else{

          Swal.fire({
            title: 'Error!',
            text: (result),
            icon: 'error',
            confirmButtonText: 'OK'
          })

        }
      }
    });

    }

  }



  $(document).on('click', '.SaveUser', function(){

    var username = document.getElementById("NewUserName").value;
    var UserType = document.getElementById("UserType").value;
    var Page="insert.php";
    var Modal='#AddUser';
    var Form='#AddUserF';
    var Success='User Created';

    if (username && UserType) {
      var data={'username':username, 'UserType':UserType};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }

  });

  $(document).on('click', '.SaveSeller', function(){

    var NewSeller = document.getElementById("NewSeller").value;
    var NewSellerNumber = document.getElementById("NewSellerNumber").value;
    var Page="insert.php";
    var Modal='#AddSeller';
    var Form='#AddSellerF';
    var Success='Seller Added';

    if (NewSeller && NewSellerNumber) {
      var data={'NewSeller':NewSeller, 'NewSellerNumber':NewSellerNumber};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }
    
  });

  $(document).on('click', '.SaveCategory', function(){

    var NewCategory = document.getElementById("NewCategory").value;

    var Page="insert.php";
    var Modal='#AddCategory';
    var Form='#AddCategoryF';
    var Success='Category Added';

    if (NewCategory) {
      var data={'NewCategory':NewCategory};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }
    
  });


  $(document).on('click', '.SaveItem', function(){

    var NewItem = document.getElementById("NewItem").value;
    var Category = document.getElementById("Category").value;
    var SellingRate = document.getElementById("SellingRate").value;

    var Page="insert.php";
    var Modal='#AddItems';
    var Form='#AddItemsF';
    var Success='Item Added';

    if (NewCategory) {
      var data={'NewItem':NewItem, 'Category':Category, 'SellingRate':SellingRate};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }
    
  });

</script>
</body>
</html>
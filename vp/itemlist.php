<?php include "connection.php";

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home</title>
  <?php include "header.php"; ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
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
    </div>
  </section>
  <!-- Header Section-->
  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">
        <div class="table-responsive">
          <table class="table table-hover table-bordered border-primary" id="example">
            <thead>
              <th>Item Name</th>
              <th>Category</th>
              <th>In stock</th>
              <th>Expiry Date</th>
              <th>Purchase From</th>
              <th>Purchase Amount</th>
              <th>Purchase Discount</th>
              <th>Selling Rate</th>
              <th>Purchase Date</th>
            </thead>
            <tbody id="">
              <?php 

              $query="SELECT * FROM `purchase` 
              JOIN items on purchase.ItemID=items.ItemID
              JOIN sellers ON purchase.SellerID=sellers.SellerID
              join category on items.CategoryID=category.CategoryID";
              $result = mysqli_query($con,$query);
              if(mysqli_num_rows($result)>0)
              {

                $Sr=1;
                while ($row=mysqli_fetch_assoc($result))
                {
                  print "<tr>";
                  print '<td>'.$row['ItemName']."</td>";
                  print '<td>'.$row['Category']."</td>";
                  print '<td>0</td>';
                  print '<td>'.$row['ExpiryDate']."</td>";
                  print '<td>'.$row['SellerName']."</td>";
                  print '<td>'.$row['PaidAmount']."</td>";
                  print '<td>'.$row['Discount']."</td>";
                  print '<td>'.$row['SellingRate']."</td>";
                  print '<td>'.$row['PurchaseDate']."</td>";

                  print "<tr>";  
                }


              }

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <?php include "footer.php"; 

    ?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

    <script src="https://cdn.datatables.net/searchpanes/2.0.1/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript">


      $(document).ready(function() {
       var table = $('#example').DataTable( {
        rowReorder: {
          selector: 'td:nth-child(2)'
        },

        "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
        responsive: true

      } );
     } );

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
    $('#FindItemF').trigger("reset");
    $('#AddPurchaseF').trigger("reset");
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


  function AjaxRead(Page, Data, Modal, Form, Result){
    $.ajax({
     url:Page,
     method:"POST",
     data:Data,
     success:function(result){

      $(Result).html(result);
      if (Modal!='NA') {
        $(Modal).modal("show");
      }

    }
  });

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


    var input = document.getElementsByName('ItemArray[]');
    var input2 = document.getElementsByName('SellingRate[]');
    var input3 = document.getElementsByName('CategoryArray[]');
    var err=0;
    var item=[];
    var rate=[];
    var category=[];
    var Page="insert.php";
    var Modal='#AddItems';
    var Form='#AddItemsF';
    var Success='Item Added';


    for (var i = 0; i < input.length; i++) {

      var a = input[i];
      var b = input2[i];
      var c = input3[i];
      
      if (a.value && b.value && c.value) {
        item.push(a.value);
        rate.push(b.value);  
        category.push(c.value);           

      }else{
        EmptyErrorAlert();
        err=1;
        break;
      }
    }


    if (err==0) {
      var data={'NewItem':item, 'Category':category, 'SellingRate':rate};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }
    
  });


  $(document).on('click', '.SearchItem', function(){

    var FindItem = document.getElementById("FindItem").value;

    var Page="read.php";
    var Modal='#ResultItems';
    var Form='#AddCategoryF';
    var Result='#ItemResult';
    if (FindItem) {
      var data={'FindItem':FindItem};
      AjaxRead(Page, data, Modal, Form, Result);
      $('#FindItems').modal("hide");
      $('#FindItemF').trigger("reset");
    }else{
      EmptyErrorAlert();
    }
    
  });

  $(document).on('change', '#CategoryP', function(){

    var CategoryID=$(this).val();

    var Page="read.php";
    var Modal='NA';
    var Form='NA';
    var Result='#ItemP';
    if (FindItem) {
      var data={'CategoryIDP':CategoryID};
      AjaxRead(Page, data, Modal, Form, Result);
    }else{
      EmptyErrorAlert();
    }
    
  });


  $(document).on('click', '.SavePurchase', function(){

    var SellerID = document.getElementById("SellerID").value;
    var ItemID = document.getElementById("ItemP").value;
    var PurchaseRate = document.getElementById("PurchaseRate").value;
    var Qty = document.getElementById("Qty").value;
    var PurchaseDate = document.getElementById("PurchaseDate").value;
    var Discount = document.getElementById("Discount").value;
    var ItemExpiry = document.getElementById("ItemExpiry").value;
    var Amount = document.getElementById("Amount").value;

    var Page="insert.php";
    var Modal='#AddPurchase';
    var Form='#AddPurchaseF';
    var Success='Purchase Added';

    if (SellerID && ItemID && PurchaseRate && Qty && PurchaseDate && Discount && ItemExpiry && Amount) {
      var data={'SellerID':SellerID, 'ItemID':ItemID, 'PurchaseRate':PurchaseRate, 'Qty':Qty, 'PurchaseDate':PurchaseDate, 'Discount':Discount, 'ItemExpiry':ItemExpiry, 'Amount':Amount};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }
    
  });
  $(document).ready(function(){
/*
    var Page="read.php";
    var Modal='NA';
    var Form='NA';
    var Result='#PurchaseDataList';
    var data={'ItemList':'ItemList'};
    AjaxRead(Page, data, Modal, Form, Result);
    */
  } );
</script>
</body>
</html>
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


$(document).on('change', '#BranchIDF', function(){
  var BranchID=$(this).val();
  console.log(BranchID);
  if (BranchID) {
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'BranchID':BranchID},
      success:function(result){
        $('#FeesStudent').html(result);
      }
    });
  }else{
    $('#FeesStudent').html('<option value="">No Students</option>'); 
  }
});


$(document).on('change', '#FeesStudent', function(){
  var StudentID=$(this).val();
  console.log(StudentID);
  if (StudentID) {
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'StudentID':StudentID},
      success:function(result){
        var r = (result);

        document.getElementById("TotalAmount").value = r;

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


$(document).on('change', '#CourseID', function(){
  var CourseID= $(this).val();

  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseID':CourseID},
      success:function(result){
        $('#BranchID').html(result);
      }
    }); 
  }else{
    $('#BranchID').html('<option value="">Branch</option>'); 
  }

});

$(document).on('change', '#CourseIDF', function(){
  var CourseID= $(this).val();

  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseIDF':CourseID},
      success:function(result){
        $('#BranchIDF').html(result);
      }
    }); 
  }else{
    $('#BranchIDF').html('<option value="">Branch</option>'); 
  }

});




$(document).on('change', '#at', function(){
  var StudentID=$(this).attr("id2");
  var Attendance=$(this).val();
  console.log(StudentID);
  if (StudentID) {
    $.ajax({
      type:'POST',
      url:'insert.php',
      data:{'StudentIDAt':StudentID, "Attendance":Attendance},
      success:function(result){

        console.log((result));

      }
    });
    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      $.ajax({
        type:'POST',
        url:'read.php',
        data:{'Studentlist':'subjectlist', 'Year':Year, 'Branch':BranchIDS},
        success:function(result){
          $('#example').DataTable().clear();
          $('#example').DataTable().destroy();
          $('#StudentData').html(result);
          $('#example').DataTable();
        }
      });
    }, delayInMilliseconds);
  }
});
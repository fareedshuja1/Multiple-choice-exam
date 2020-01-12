        <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
					  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
							<?php show_msg(); ?>
                          </header>
                          <div class="panel-body">
                       
                       <table width="100%" cellpadding="10" cellspacing="" border="0">
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">Main Course <mark style="color:#F00; background-color:#FFF">*</mark></label>
  <select class="form-control m-bot15" name="mcid" onchange="GetSubC();" id="mcid" style="width: 150px">
                       <option value="">Select Option</option>
                       <?php $courses->ViewAllMainCourses(); ?>
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Sub Course <mark style="color:#F00; background-color:#FFF">*</mark></label>
  <select class="form-control m-bot15" name="scid" id="scid" style="width:150px" onchange="get_ccode();">
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Class Code <mark style="color:#F00; background-color:#FFF">*</mark></label>
                       <select class="form-control m-bot15" name="ccid" id="ccode" style="width:150px" onchange="get_ccat();">
                       </select> 
                       </td>
      
                       <td>    
              <label for="exampleInputEmail1">Select Category <mark style="color:#F00; background-color:#FFF">*</mark></label>
              <select name="cat_id" id="cat_id" class="form-control m-bot15" style="width:150px" onchange="get_cdate();">
                       </select>
                       </td>
                       
                       <td>    
                       <label for="exampleInputEmail1">Select Date <mark style="color:#F00; background-color:#FFF">*</mark></label>
                       <select name="date" id="date" class="form-control m-bot15" style="width:150px" onchange="get_etime();">
                       </select>
                       </td>
                       
                       <td>    
                       <label for="exampleInputEmail1">Select Time <mark style="color:#F00; background-color:#FFF">*</mark></label>
                       <select name="etime" id="etime" class="form-control m-bot15" style="width:150px" onchange="ShowBTN();">
                       </select>
                       </td>
                   
                       </tr>   
                        
                       </table>  
                         
                       
         <a class="btn btn-warning" data-toggle="modal" id="btnsearch" onclick="Show_Result();" style="display:none">Show Result</a>             
                     
                        </div>
 
                        </section>
                      
                      
                      <section class="panel">
                      <div class="panel-body" id="show_res">

                      </div>
                      </section>
   
                               
                  </div>
          </section>
      </section>
      
            
      
  </section>
 </body>
</html>


  <script>
  function SentEmail(id) {
 // var sql = $("#sql").val();  
  var scid = $("#scid").val();
  var ccode = $("#ccode").val();
  var cat_id = $("#cat_id").val();
  var date = $("#date").val();
  $.post("sent_mail_all.php/", {id: id,ccode: ccode,cat_id: cat_id,date: date,scid: scid}, function(page_response)
  {
  alert(page_response);
  });
  alert("An Email will be sent to the student. Please Wait!");
  }
  </script>


  <script>
  function ShowBTN() {
  $("#btnsearch").show();
  }
  </script>

  <script>
  function Show_Result() {
  var scid = $("#scid").val();
  var ccode = $("#ccode").val();
  var cat_id = $("#cat_id").val();
  var date = $("#date").val();
  var etime = $("#etime").val();
  
  $.post("get_exam_report.php/", {ccode: ccode,cat_id: cat_id,date: date,scid: scid,etime:etime}, function(page_response)
  {
  $("#show_res").html(page_response);
  });
  }
  </script>

  <script>
  function GetSubC(){
  var id = $("#mcid").val();
  
  $.post("get_scourse.php/", {id: id}, function(page_response)
  {
  $("#scid").html(page_response);
  });
  }
  </script>


  <script>
  function get_ccode(){
  var id = $("#scid").val();
  
  $.post("get_ccode.php/", {id: id}, function(page_response)
  {
  $("#ccode").html(page_response);
  });
  }
  </script>
  
  
  <script>
  function get_ccat() {
	  
	   var id = $("#ccode").val();
       var idd = $("#scid").val();
	     
  $.post("get_ccat.php/", {id: id, idd: idd}, function(data)
  {
  $("#cat_id").html(data);
  });
  
  }
  </script>



  <script>
  function get_cdate() {
	  
	   var id = $("#ccode").val();
       var idd = $("#cat_id").val();
	     
  $.post("get_cdate.php/", {id: id, idd: idd}, function(data)
  {
  $("#date").html(data);
  });
  
  }
  </script>
  

  <script>
  function get_etime() {
	  
	   var id = $("#ccode").val();
       var idd = $("#cat_id").val();
	   var date = $("#date").val();
	     
  $.post("get_etime.php/", {id: id, idd: idd, date: date}, function(data)
  {
  $("#etime").html(data);
  });
  
  }
  </script>


<script>
function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if ( charCode > 31 && (charCode < 48 || charCode > 57))
  return false;
  return true;
}
</script>

<script>
function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if ( charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

</script>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!--custom switch-->
    <script src="js/bootstrap-switch.js"></script>
    <!--custom tagsinput-->
    <script src="js/jquery.tagsinput.js"></script>
    <!--custom checkbox & radio-->
    <script type="text/javascript" src="js/ga.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    <!--script for this page-->
<!--    <script src="js/form-component.js"></script>
-->    
    <!-- Date Picker -->
     <link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
	<script>
	$(function() {
   	$("#datepicker").datepicker({
    changeMonth: true,
    changeYear: true  
   });
   
   $("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
   });
   </script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>


    <!--common script for all pages-->

    <!--script for this page only-->
    <script src="js/dynamic-table.js"></script>


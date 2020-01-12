<?php

if(isset($_POST['add-ques'])) {
	$ques->AddQuestion();
}

$year=date("Y");
$year1=$year;
$yearFirst = $year-5;
$yearEnd=$year+50;


?>
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
					  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
							<?php show_msg(); ?>
                          </header>
                          <div class="panel-body">
                       
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="" border="0">
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">Main Course</label>
                  <select class="form-control m-bot15" name="mcid" onchange="GetSubC();" id="mcid" style="width: 250px" required="required">
                       <option value="">Select Main Course</option>
                       <?php $courses->ViewAllMainCourses(); ?>
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Sub Course</label>
                       <select class="form-control m-bot15" name="scid" id="scid" style="width:250px" required="required">
                       </select>
                       </td>
                       <td><label for="exampleInputEmail1">Select Category</label>
                       <select name="cat_id" id="cat_id" class="form-control m-bot15" style="width:150px" required="required">
                       <option value="">Select Category</option>
                       <?php $general->ViewCategories_drop(); ?>
                       </select></td>
                      
                       <td style="width: 150px">
                       <label for="exampleInputEmail1">Question Year</label>
                       <select name="ques_year" id="ques_year" class="form-control m-bot15" style="width:150px">
                       <option value="<?php echo $year1 ?>"><?php echo $year1 ?></option>
                       <?php
                       for($year=$yearFirst; $year <= $yearEnd; $year++) { ?>
                       <option value="<?php echo $year ?>"><?php echo $year ?></option>
					   <?php } ?>
                       </select>
                       </td>
                    
                       
                       <td valign="top" style="width: 100px">                       
                       <label for="exampleInputEmail1">Total Options</label>
<input type="text" class="form-control" name="count" onkeypress="return isNumberKey(event)" id="count" onblur="ShowOptions();" style="width: 100px" required="required">
                       </td>
                       </tr>
                       
                       
                       <tr>
                       <td  colspan="2" valign="top">                       
                       <label for="exampleInputEmail1">Question Text</label>
                   <!--<input type="text" class="form-control" name="ques_text" style="width:550px; height:100px;" required="required">-->
                   <textarea class="form-control" name="ques_text" id="ques_text" style="resize: vertical;"></textarea>
                       </td>
                       <td valign="top" colspan="3">                       
                       <label for="exampleInputEmail1">Question Hint</label>
                       <input type="text" class="form-control" id="ques_hint"  name="ques_hint" style="width:400px">
                       
                       </td>
                       </tr>
                       
                       <table width="50%" style="position:relative; display:none;" id="tbl">
                       </table><br />
                       
                       
                       </table>  
                       
                       <a class="btn btn-warning" data-toggle="modal" id="ques_btn" href="#myModal2" style="display:none">Add Question</a>
                 
                 <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Add Question</h4>
                                          </div>
                                          <div class="modal-body">

                                              Are you sure to add new question?

                                          </div>
                                          <div class="modal-footer">
                             <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                             <button class="btn btn-warning" type="submit" name="add-ques"> Confirm</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       
                       </form>
						
                        </div>

                      </section>
   
                               
                  </div>
          </section>
      </section>
      
            
      
  </section>
 </body>
</html>

<script>
function show_btnn() {
	
	$("#ques_btn").show();
	//$(".show_opt").show();
	//$("#chop").show();
	//$('.select').attr('disabled', 'disabled');
	//$('.select').removeAttr('disabled');
	
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
function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if ( charCode > 31 && (charCode < 48 || charCode > 57))
  return false;
  return true;
}
</script>

<script>
 function ShowOptions(){
  var id = $("#count").val();
  
  $.post("get_options.php/", {id: id}, function(page_response)
  {
  $("#tbl").html(page_response);
  $("#tbl").show();

  });
  }
</script>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="js/bootstrap-switch.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script type="text/javascript" src="js/ga.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <script src="js/common-scripts.js"></script>
<!--    <script src="js/form-component.js"></script>-->    
	<link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>

    <script src="js/dynamic-table.js"></script>

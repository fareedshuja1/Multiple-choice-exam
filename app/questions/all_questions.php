<?php
$year=date("Y");
$year1=$year;
$yearFirst = $year-5;
$yearEnd=$year+50;

if(isset($_POST['edit-ques'])) {
	$id = $_POST['ques_id'];
	$ques->EditQuestion($id);
	
}
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
                       
                       <form action="index.php?folder=questions&page=all_question" method="post" enctype="multipart/form-data">
                       <table width="80%" cellpadding="5" cellspacing="" border="0">
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">Main Course</label>
                       <select class="form-control m-bot15" name="mcid" onchange="GetSubC();" id="mcid" style="width: 200px">
                       <option value="">Select Main Course</option>
                       <?php $courses->ViewAllMainCourses(); ?>
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Sub Course</label>
                       <select class="form-control m-bot15" name="scid" id="scid" style="width: 200px">
                       </select>
                       </td>
                       
                       <td><label for="exampleInputEmail1">Select Category</label>
                       <select name="cat_id" class="form-control m-bot15" style="width:200px">
                       <option value="">Select Category</option>
                       <?php $general->ViewCategories_drop(); ?>
                       </select></td>
                    
                       <td>
                       <label for="exampleInputEmail1">Question Year</label>
                       <select name="ques_year" class="form-control m-bot15" style="">
                       <option value="<?php echo $year1 ?>"><?php echo $year1 ?></option>
                       <?php
                       for($year=$yearFirst; $year <= $yearEnd; $year++) { ?>
                       <option value="<?php echo $year ?>"><?php echo $year ?></option>
					   <?php } ?>
                       </td>
                       
                       <td valign="middle" align="right">
                       <button class="btn btn-warning" type="submit" name="search-ques">Search</button>
                       </td>
                       </tr>
                       </table>  
                       </form>
						
                        </div>
                      </section>
                      
                      
                    <section class="panel">
                       <div class="panel-body">
                        <table class="table table-striped border-top" id="sample_1" width="100%">
                        <thead>
                        <tr>
                                   <th width="7%"> SNO &nbsp; </th>
                                   <th width="30%"> Course &nbsp; </th>
                                   <th width="30%"> Category &nbsp; </th>
                                  <th width="30%"> Question &nbsp; </th>
                                   <th width="7%"> Year &nbsp; </th>
                                  <th width="10%"> Status &nbsp; </th>
                                 
                                  <th width="">&nbsp;   </th>

                              </tr>
                              </thead>
                              <tbody>
                              <?php $ques->AllQuestion(); ?>
                              </tbody>
                              </table>
                            
                            </div>
                             </section>
                             
                                                                      
                  <!-- Modal 2-->
                   <div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Edit Question</h4>
                                          </div>
                                          <div class="modal-body-edit">

                                            

                                          </div>
                                          
                                      </div>
                                  </div>
                              </div>
                              <!-- modal 2-->
                             
                             
                             
                     </div>
          </section>
      </section>
      
   </section>
 </body>
</html>


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
 function editques(id){
  $.post("edit_ques.php/", {id: id}, function(page_response)
  {
  $(".modal-body-edit").html(page_response);
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
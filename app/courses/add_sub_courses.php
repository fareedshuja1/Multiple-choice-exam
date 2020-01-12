<?php
if(isset($_POST['add-scrs'])) {
	$courses->AddSubCourse();
}

if(isset($_GET['dlt'])) {
	$id = $_GET['dlt'];
	$courses->DeleteSubCourse($id);
}

if(isset($_POST['edit-scourse'])) {
	$id = $_POST['id'];
	$courses->EditSubCourse($id);
}
?>
     <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
					  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
							<?php show_msg(); 
							?>
                          </header>
                          <div class="panel-body">
                       
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">Main Course</label>
                       <select class="form-control m-bot15" name="mcid" style="">
                       <option value="">Select Main Course</option>
                       <?php $courses->ViewAllMainCourses(); ?>
                       </select>
                       </td>
                      
                       <td valign="top">
                       <label for="exampleInputEmail1">Course Title</label>
                       <input type="text" class="form-control" id="sc_title"  name="sc_title" required="required">
                       </td>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Course Duration (In Months)</label>
                       <input type="text" class="form-control" onkeypress="return isNumberKey(event)"  name="course_duration" required="required">
                       </td>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Total Course Fee (pkr)</label>
                       <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="course_fee" required="required">
                       </td>
                       </tr>
                       </table>                                            

                        
                     <a class="btn btn-warning" data-toggle="modal" href="#myModal2">Add Course</a>
                  <!-- Modal -->
                   <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Add Sub Course</h4>
                                          </div>
                                          <div class="modal-body">

                                              Are you sure to add new course?

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                              <button class="btn btn-warning" type="submit" name="add-scrs"> Confirm</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                              
                              
                       </form>

                          </div>
                      </section>
                  <section class="panel">
                       <div class="panel-body">
                          <table class="table table-striped border-top" id="sample_1">
                          <thead>
                          <tr>        
                          <th width=""> Main Course</th>
                          <th width=""> Course Title &nbsp; </th>
                          <th width=""> Course Fee &nbsp; </th>
                          <th width=""> Duration (In Months) &nbsp; </th>
                          <th width="">&nbsp;</th>
                          <th width="">&nbsp;</th>
  
                              </tr>
                              </thead>
                              <tbody>
                              <?php $courses->ViewSubCourses(); ?>
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
                                              <h4 class="modal-title">Edit Employee's Info</h4>
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
 function editscourse(id){
  $.post("edit_scourse.php/", {id: id}, function(page_response)
  {
  $(".modal-body-edit").html(page_response);
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
<!--    <script src="js/form-component.js"></script>-->    
    <!-- Date Picker -->
	<link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>


    <!--common script for all pages-->

    <!--script for this page only-->
    <script src="js/dynamic-table.js"></script>
    
     <script type="text/javascript" src="./js/lib/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="./js/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="./js/source/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
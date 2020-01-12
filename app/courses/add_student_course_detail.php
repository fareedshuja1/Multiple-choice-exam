<?php
if(isset($_POST['scd'])) {
  $id = $_POST['student_id'];
  $courses->AddStCourseDetail();
  redirect('index.php?folder=courses&page=add_student_course_detail&std='.$id.'','Record is Saved in Database','add');		

}

if(isset($_POST['edit_scd'])) {
  $id = $_POST['scd_id'];
  $student_id = $_POST['student_id'];
  $courses->EditSCD($id);
  redirect('index.php?folder=courses&page=add_student_course_detail&std='.$student_id.'','Record is Updated in Database','add');		

}

if(isset($_GET['dlt'])) {
	$id = $_GET['dlt'];
	$courses->DeleteCourseDetail($id);
}

if(isset($_GET['std'])) {
	$id = $_GET['std'];
	$query = mysql_query("SELECT `student_name`,`student_id` FROM student_info WHERE `student_id`='$id'") or die(mysql_error());
	$row = mysql_fetch_assoc($query);
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
                       
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr>
                       
                       <td valign="top">
                <label for="exampleInputEmail1">Student</label>
                <input type="text" class="form-control" name="student" value="<?php echo $row['student_name']; ?>" readonly="readonly">
                <input type="hidden" name="student_id" id="student_id" value="<?php echo $row['student_id']; ?>" />
                       </td>
                       
                                              
                       <td>
                       <label for="exampleInputEmail1">Select Class</label>
                       <select class="form-control m-bot15" name="ccid" style="width:200px" onchange="get_fee(this.value)">
                       <option value="">Select Class</option>
                       <?php echo $courses->ViewAllClasses_add(); ?>
                       </select>
                       </td>
                       
                       <td valign="top">
                       <label for="exampleInputEmail1">Form No</label>
                       <input type="text" class="form-control" id=""  name="form_no" value="" required="required">
                       </td>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Reg. No</label>
                       <input type="text" class="form-control" name="reg_no" value="">
                       </td>

                       
                       <td valign="top">
                       <label for="exampleInputEmail1">Actual Fee</label>
                       <input type="text" class="form-control show_fee" name="total_fee" readonly="readonly">
                       </td>
                       
                       <td valign="top">
                       <label for="exampleInputEmail1">Total/Discounted Fee</label>
                       <input type="text" class="form-control show_fee" name="dis_fee" onkeypress='return isNumberKey(event)' required="required">
                       </td>
                       </tr>
                       
                       <tr>
                       <td valign="top">
                       <label for="exampleInputEmail1">Paying Amount</label>
                       <input type="text" class="form-control" name="paid_amt" onkeypress='return isNumberKey(event)'>
                       </td>
                       
                                              
                       <td valign="top" colspan="5">
                       <label for="exampleInputEmail1">Paying Date &nbsp; (Year-Month-Day)</label>
    <input type="text" class="form-control cnic" style="width:200px" name="payment_date" value="<?php echo date('Y-m-d'); ?>" required="required">
                       </td>
                       
                       </tr>
                       </table>                       

                        
                       <a class="btn btn-warning" data-toggle="modal" href="#myModal2">Add Course Detail</a>
                       <!-- Modal -->
                       <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-header">
                      	       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 <h4 class="modal-title">Add Student Course Detail</h4>
                                   </div>
                                     <div class="modal-body">
                                     Are you sure to add new student course detail?
                                     </div>
                                        
                                        <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                              <button class="btn btn-warning" type="submit" name="scd"> Confirm</button>
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
                          <th width=""> Class &nbsp; </th>
                          <th width=""> Total Fee &nbsp; </th>
                          <th width=""> Discounted Fee &nbsp; </th>
                          <th width=""> Form No &nbsp; </th>
                          <th width=""> Reg. No &nbsp; </th>
                          <th width=""> Status  </th> 
                          </tr>
                          </thead>
                          <tbody>
                          <?php  $courses->ViewStCourseDetail($id); ?>
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
                                        <h4 class="modal-title">Edit Course</h4>
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
function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if ( charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

</script>

<script>
function get_fee(id) {
  $.post("files/get_fee.php/", {id:id}, function(response)
  {
  $(".show_fee").val(response);
  });
}
</script>



<script>
 function editscd(id){
  var student_id = $("#student_id").val();
  $.post("files/edit_scd.php/", {id: id,student_id:student_id}, function(page_response)
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
    
    
        <script src="js/cnic-validate.js"></script>
         <script src="js/cnic-validation.js"></script>
		 <script>
         $(document).ready(function() {
         $(".cnic").kendoMaskedTextBox({
         mask: "0000-00-00"
         });
         });
         </script>
         
<?php
if(isset($_POST['add-usr'])) {
	$user->AddUser();
}

if(isset($_POST['change-state'])) {
	$id = $_POST['id'];
	$user->DeactivaeUser($id);
}

if(isset($_POST['active-state'])) {
	$id = $_POST['id'];
	$user->ActivaeUser($id);
}

			
if(isset($_POST['change-group'])) {
	$id = $_POST['id'];
	$user->ChangeGroup($id);
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
                       
                       <form action="" method="post">
                       
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr>
                       <td>
                       <label>Select Employee</label>
                       <select class="form-control m-bot15" name="emp_id" style="">
                       <option value="">Select Option</option>
                       <?php $employees->AllEmployess_add(); ?>
                       </select>
                       </td>
                       
                       <td>      
                       <label for="">Select Group</label>
                       <select class="form-control m-bot15" name="group_id" style="">
                       <option value="">Select Option</option>
                       <?php $user->ViewGroups(); ?>
                       </select>
                       </td>
                       
                       <td valign="top">
                       <label for="">Username</label>
                       <input type="text" class="form-control" name="username" style="">
                       <input type="hidden" class="" id="" name="add-usr">
                       </td>
                       <td valign="top">
                       <label for="">Password</label>
                       <input type="password" class="form-control" id=""  name="password">
                       </td>
                       </tr>
                       <tr>
                       <td valign="bottom">
                       <button class="btn btn-warning" type="submit" name="submit">Add User</button>
                       </td>  
                       </tr>     
                       </table>
                       </form>
					
                    
                    </div>
                      </section>
                      
                   <!-- Modal 2-->
                   <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title"></h4>
                                          </div>
                                          <div class="modal-body-edit">

                                          </div>
                                          
                        </div>
                       </div>
                      </div>
                    <!-- modal 2-->
                      
                       
                       <section class="panel">
                       <div class="panel-body">
                        <table class="table table-striped border-top" id="sample_1">
                          <thead>
                          <tr>
                                  <th width="130px"> Username &nbsp; </th>
                                  <th width="150px"> Employee Name &nbsp; </th>
                                  <th> Group &nbsp; </th>
                                  <th> Status &nbsp; </th>
                                  <th> Father Name &nbsp; </th>
                                  <th> Contact &nbsp; </th>
                                  <th> Email &nbsp; </th>
                                  <th>&nbsp;   </th>
                                  <th>&nbsp;   </th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $user->ViewAllUsers(); ?>
                              </tbody>
                              </table>
                               </div>
                               
                               </section>
                  </div>
          </section>
                 
      </section>
            
  </section>
 </body>
</html>

<script>
 function Deactivate(id){
  $.post("files/deactivate_user.php/", {id: id}, function(page_response)
  {
  $(".modal-body-edit").html(page_response);
  });
 }
</script>

<script>
 function Activate(id){
  $.post("files/activate_user.php/", {id: id}, function(page_response)
  {
  $(".modal-body-edit").html(page_response);
  });
 }
</script>

<script>
 function ChangeGroup(id){
  $.post("change_group.php/", {id: id}, function(page_response)
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
<!--    <script src="js/form-component.js"></script>
-->    
    <!-- Date Picker -->
	<link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>


    <!--common script for all pages-->

    <!--script for this page only-->
    <script src="js/dynamic-table.js"></script>


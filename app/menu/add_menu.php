<?php
if(isset($_POST['add-sidemenu'])) {
	$menu->AddSideMenu();
}
if(isset($_POST['edit-side-menu'])) {
	$id = $_POST['id'];
	$menu->EditSideMenu($id);
}
if(isset($_GET['delete-sidemenu'])) {
$id=$_GET['delete-sidemenu'];
$menu->DeleteSideMenu($id);
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
                       <td>
                       <label for="exampleInputEmail1">Parent Menu</label>
                       <select class="form-control m-bot15" name="parent_id" style="">
                       <option value="">Select Parent</option>
                       <?php $menu->AllSideMenu(); ?>
                       </select>
                       </td>
                       <td valign="top">
                       <label for="exampleInputEmail1">Menu Title</label>
                       <input type="text" class="form-control" id=""  name="name">
                       </td><td valign="top">                       
                       <label for="exampleInputEmail1">Menu URL</label>
                       <input type="text" class="form-control" id="" placeholder="" name="url">
                       </td>
                       </tr></table>                       

                        
                     <a class="btn btn-warning" data-toggle="modal" href="#myModal2">Add Menu</a>
                  <!-- Modal -->
                   <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Add New Menu</h4>
                                          </div>
                                          <div class="modal-body">

                                              Are you sure to add menu?

                                          </div>
                                          <div class="modal-footer">
                             <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                             <button class="btn btn-warning" type="submit" name="add-sidemenu"> Confirm</button>
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
                                  <th width=""> Menu Title &nbsp; </th>
                                  <th width=""> Parent Menu &nbsp; </th>
                                  <th> Menu URL &nbsp; </th>
<!--                              <th width="">&nbsp;  </th> 
                                  <th width="">&nbsp;  </th> -->

  
                              </tr>
                              </thead>
                              <tbody>
                              <?php $menu->ViewSideMenu(); ?>
                              </tbody>
                              </table>
                               </div>
                               </section>
                                         
             <!-- Modal 2-->
              <div class="modal fade" id="myModalmenuedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                      	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title">Menu</h4>
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
 function editsidemenu(id){
  $.post("edit_side_menu.php/", {id: id}, function(page_response)
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
    
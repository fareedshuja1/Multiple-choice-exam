<?php
if(isset($_POST['add-emp'])) {
	$employees->AddEmployee();
	redirect('index.php?folder=employees&page=view_employees','Record is Saved in Database','add');
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
                       
                       <tr><td>
                       <label for="exampleInputEmail1">Name</label>
                       <input type="text" class="form-control" id=""  name="name" required="required">
                       </td><td>                       
                       <label for="exampleInputEmail1">Father Name</label>
                       <input type="text" class="form-control" id="" placeholder="" name="fname">
                       </td><td>                       
                       <label for="exampleInputPassword1">Address</label>
                       <input type="text" class="form-control" id=""  name="address">
                       </td></tr>
                       <tr><td>
                       <label for="exampleInputEmail1">Contact</label>
                       <input type="text" class="form-control" id=""  name="contact" required="required">
                       </td><td>                       
                       <label for="exampleInputEmail1">Email</label>
                       <input type="email" class="form-control" id="" name="email" required="required">
                       <input type="hidden" class="" id="" name="add-emp">
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Employee Type</label>
                       <select name="emp_type" class="form-control" onchange="change_label(this.value);">
                       <option value="H">Hourly Paid</option>
                       <option value="F">Fixed Paid</option>
                       </select>
                       </td>
                       </tr>
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1" id="per">Percentage Amount</label>
                       <label for="exampleInputEmail1" id="sal" style="display:none">Salary Amount</label>
                       <input type="text" class="form-control" onkeypress='return isNumberKey(event)' name="sell_amount" required="required">
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Image</label>
                       <input type="file" class="" id="exampleInputFile" name="upload">
                       </td>
                       </tr>
                       </table>                       

                        
                     <a class="btn btn-warning" data-toggle="modal" href="#myModal2">Add Employee</a>
                     
                  <!-- Modal -->
                   <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Confirmation</h4>
                                          </div>
                                          <div class="modal-body">

                                              Are you sure to add new Employee?

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                              <button class="btn btn-warning" type="submit" name="submit"> Confirm</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                              
                              
                       </form>

                          </div>
                      </section>
                      
  <!--                <section class="panel">
                       <div class="panel-body">
                          <table class="table table-striped border-top" id="sample_1">
                          <thead>
                          <tr>        
                                  <th>Image</th>
                                  <th width=""> Name &nbsp; </th>
                                  <th width=""> Father Name &nbsp; </th>
                                  <th> Contact &nbsp; </th>
                                  <th> Email &nbsp; </th>
                                  <th width=""> Emp. Type &nbsp; </th> 
                                  <th width=""> Salary / %age &nbsp; </th> 
                                    <th width="">&nbsp;  </th>
                                    <th width="">&nbsp;  </th>

                              </tr>
                              </thead>
                              <tbody>
                              <?php //$employees->ViewAllEmployees(); ?>
                              </tbody>
                              </table>
                               </div>
                               </section>-->
                                         
                                         
                                         
                  <!-- Modal 2-->
          <!--         <div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                     <div class="modal-content">
                      <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Employee's Info</h4>
                         </div>
                          <div class="modal-body-edit1"></div>
                           </div>
                            </div>
                             </div>-->
                              <!-- modal 2-->
                              
                              
                                                                       
                  <!-- Modal 3-->
     <!--              <div class="modal fade" id="myModaledit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                     <div class="modal-content">
                      <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Make Allowance</h4>
                         </div>
                          <div class="modal-body-edit2"></div>
                           </div>
                            </div>
                             </div>-->
                              <!-- Modal 3-->
                              
                              
                                                          
                              
                              
                  </div>
          </section>
      </section>      
  </section>
  
<script>
   function change_label(id) {
	   if(id == 'F') {
		   $("#sal").show();
		   $("#per").hide();
	   }
	   
	   if(id == 'H') {
		   $("#sal").hide();
		   $("#per").show();
	   }
	   
   }
</script>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>

    <script src="js/common-scripts.js"></script>
    <script src="js/dynamic-table.js"></script>

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


  </body>
</html>
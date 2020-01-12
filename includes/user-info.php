<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">Update Info</h4>
                                          </div>
                                          <div class="modal-body">

                <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                
                           <div class="form-group">
                           <label for="inputEmail1" class="col-lg-2 control-label">Name</label>
                           <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail4" name="name" value="<?php echo $_SESSION['emp_name']; ?>">
                           </div>
                           </div>
                           
                          <div class="form-group">
                           <label for="inputEmail1" class="col-lg-2 control-label">Father Name</label>
                           <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail4" name="fname" value="<?php echo $_SESSION['emp_fname']; ?>">
                           </div>
                           </div>


                           <div class="form-group">
                           <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
                           <div class="col-lg-10">
              <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $_SESSION['emp_email']; ?>">
                           </div>
                           </div>
                           
                           <div class="form-group">
                           <label for="inputEmail1" class="col-lg-2 control-label">Contact</label>
                           <div class="col-lg-10">
              <input type="text" class="form-control" id="inputEmail4" name="contact" value="<?php echo $_SESSION['emp_contact']; ?>">
              <input type="hidden" class="" id="" name="user-info">
              <input type="hidden" class="" id="" name="emp_id" value="<?php echo $_SESSION['emp_id']; ?>">
                           </div>
                           </div>
                           
                          <div class="form-group">
                           <label for="inputEmail1" class="col-lg-2 control-label">Address</label>
                           <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail4" name="address" value="<?php echo $_SESSION['emp_address']; ?>">
                           </div>
                           </div>
                           
                           
                           <div class="form-group">
                           <label for="inputEmail1" class="col-lg-2 control-label">Image</label>
                           <div class="col-lg-10">
                          <input type="file" class="" id="exampleInputFile" name="upload">
                           </div>
                           </div>
                                                  
                                                  
                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                         
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" class="btn btn-info" name="submit">Update</button>
                                                      </div>
                                                  </div>
                                              </form>

                                          </div>
                                         
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
      
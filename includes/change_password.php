<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">Change Password</h4>
                                          </div>
                                          <div class="modal-body">

       <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                
                           <div class="form-group">
                           <label for="inputEmail1" class="col-lg-2 control-label">Old Password</label>
                           <div class="col-lg-10">
       <input type="password" class="form-control" id="inputEmail4" name="old_pass" placeholder="Enter Old Password">
       <input type="hidden" name="change_pass">
       <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">

                           </div>
                           </div>
                           
                           
                           <div class="form-group">
                           <label for="inputPassword1" class="col-lg-2 control-label">New Password</label>
                           <div class="col-lg-10">
    <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Enter New Password" required="required">
                           </div>
                           </div>
                           
                               <div class="form-group">
                                 <div class="col-lg-offset-2 col-lg-10">
                                   </div>
                                     </div>
                                       <div class="form-group">
                                         <div class="col-lg-offset-2 col-lg-10">
                                            <button type="submit" class="btn btn-info" name="submit">Change</button>
                                                      </div>
                                                  </div>
                                              </form>

                                          </div>
                                         
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
      
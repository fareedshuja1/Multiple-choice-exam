<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `main_courses` WHERE `mcid` = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table cellpadding="5" cellspacing="5" width="90%" align="center">
                       <tr>
                       <td valign="top">
                       <label for="exampleInputEmail1">Course Title</label>
                       <input type="text" class="form-control" id=""  name="title" value="<?php echo $row['mc_title']; ?>">
                       <input type="hidden" class="" id=""  name="id" value="<?php echo $row['mcid']; ?>">
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Status</label>
                       <select class="form-control m-bot15" name="status" style="">
                       <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                       <option value="Active">Active</option>
                       <option value="Inactive">Inactive</option>
                       </select>
                       </td>
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-mcourse">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
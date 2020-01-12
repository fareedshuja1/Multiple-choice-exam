<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `category` WHERE `cat_id` = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table cellpadding="5" cellspacing="5" width="90%" align="center">
                       <tr>
                       <td valign="top">
                       <label for="">Category Title</label>
                       <input type="text" class="form-control" name="cat_name" value="<?php echo $row['cat_name']; ?>">
                       <input type="hidden" name="id" value="<?php echo $row['cat_id']; ?>" />
                       </td> 
                       <td>
                       <label for="">Exam Status</label>
                       <select class="form-control m-bot15" name="cat_status" style="">
                       <option value="<?php echo $row['cat_status']; ?>"><?php echo $row['cat_status']; ?></option>
                       <option value="Active">Active</option>
                       <option value="Inactive">Inactive</option>
                       </select>
                       </td> 
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-cat">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
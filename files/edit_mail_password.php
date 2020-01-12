<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `emails` WHERE `mail_id` = $id") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr>
                       <td valign="top">
                       <label>ENTER OLD PASSWORD</label>
                       <input type="password" class="form-control" name="old_pass" required="required">
                       <input type="hidden" name="id" value="<?php echo $id; ?>" />
                       </td> 
                       <td valign="top">
                       <label>ENTER NEW PASSWORD</label>
                       <input type="password" class="form-control" name="new_pass" required="required">
                       </td> 
                       </tr>     
                       </table>   
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                           <button class="btn btn-warning" type="submit" name="edit-mail-pass">CHANGE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
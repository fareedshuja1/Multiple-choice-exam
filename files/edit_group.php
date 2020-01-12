<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `um_group` WHERE `group_id` = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table cellpadding="5" cellspacing="5" width="90%" align="center">
                       <tr>
                       <td valign="top">
                       <label for="">Group Title</label>
                       <input type="text" class="form-control" name="group_name" value="<?php echo $row['group_name']; ?>">
                       <input type="hidden" name="id" value="<?php echo $row['group_id']; ?>" />
                       </td>
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-group">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
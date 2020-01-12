<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `religion` WHERE `rel_id` = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table cellpadding="5" cellspacing="5" width="90%" align="center">
                       <tr>
                       <td valign="top">
                       <label for="">RELIGION</label>
                       <input type="text" class="form-control" name="religion" required="required" value="<?php echo $row['rel_title']; ?>">
                       <input type="hidden" name="id" value="<?php echo $id; ?>" />
                       </td> 
                       </tr>     
                       <tr><td>&nbsp;</td></tr>                       
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-rel">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
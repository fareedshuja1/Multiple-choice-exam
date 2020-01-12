<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
//$query = mysql_query("SELECT * FROM `um_group`") or die(mysql_error());
//$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table cellpadding="5" cellspacing="5" width="90%" align="center">
                       <tr>
                       <td valign="top">
                       <label for="">Select Group</label>
                       <select class="form-control m-bot15" name="group_id" style="">
                       <option value="">Select Option</option>
                       <?php $user->ViewGroups(); ?>
                       </select>
                       <input type="hidden" name="id" value="<?php echo $id; ?>" />

                       </td> 
                       </tr>     
                       <tr><td>&nbsp;</td></tr>                       
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-success" type="submit" name="change-group">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
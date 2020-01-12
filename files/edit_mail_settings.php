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
                       <label>MAIL HOST</label>
                       <input type="text" class="form-control" name="mail_host" required="required" value="<?php echo $row['mail_host']; ?>">
                                            </td> 
                       <td valign="top">
                       <label>MAIL PORT</label>
                       <input type="text" class="form-control" name="mail_port" required="required" value="<?php echo $row['mail_port']; ?>">
                       </td> 
                       <td valign="top">
                       <label>SENDER NAME</label>
        <input type="text" class="form-control" name="mail_sendername" required="required" value="<?php echo $row['mail_sendername']; ?>">
                               <input type="hidden" name="id" value="<?php echo $id; ?>" />

                       </td>
                       </tr>
                       <tr>
                       <td valign="top">
                       <label>SENDER EMAIL</label>
<input type="text" class="form-control" name="mail_username" required="required" placeholder="Please Use Gmail ID" value="<?php echo $row['mail_username']; ?>" >
                       </td> 

                       <td>
                       <label>SELECT STATUS</label>
                       <select class="form-control m-bot15" name="status">
                       <option value="">Select Status</option>
                       <option value="Active">Active</option>
                       </select>
                       </td>
                       

                       </tr>     
                       </table>   
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-mail-settings">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
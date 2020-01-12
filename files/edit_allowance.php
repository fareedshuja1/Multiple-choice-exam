<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `allowance` WHERE `allow_id`='$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr>
                       <td valign="top">
                       <label for="">ALLOWANCE NAME</label>
                       <input type="text" class="form-control" name="allow_name" required="required" value="<?php echo $row['allow_name']; ?>">
                       <input type="hidden" name="allow_id" value="<?php echo $row['allow_id']; ?>" />
                       </td> 
                       <td valign="top">
                       <label for="">ALLOWANCE TYPE</label>
                       <select name="allow_type" class="form-control">
<option value="<?php echo $row['allow_type']; ?>"><?php if($row['allow_type'] == 'A') { echo 'Allowance'; } else { echo 'Increament'; } ?></option>
                       <option value="I">Increament</option>
                       <option value="A">Allowance</option>
                       </select>
                       </td> 
                       </tr>     
                       </table>  
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit_allow">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
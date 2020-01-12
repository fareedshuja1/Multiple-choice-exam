<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `employees` WHERE `emp_id` = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table cellpadding="5" cellspacing="5" width="90%" align="center">
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">Employee Type</label>
                       <select name="emp_type" class="form-control" onchange="change_label(this.value);">
<option value="<?php echo $row['emp_type']; ?>"><?php if($row['emp_type'] == 'H') { echo 'Hourly Paid'; } else { echo 'Fixed Paid'; } ?></option>
                       <option value="H">Hourly Paid</option>
                       <option value="F">Fixed Paid</option>
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Amount</label>
       <input type="text" class="form-control" onkeypress='return isNumberKey(event)' name="sell_amount" value="<?php echo $row['sal_amount']; ?>">
       <input type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>" />
                       </td>
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-emp">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                       </form>

                          </div>  
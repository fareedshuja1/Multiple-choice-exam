<?php
include("../includes/connection.php");
if(isset($_REQUEST['emp_id'])) {
$emp_id= $_REQUEST['emp_id'];
$query = mysql_query("SELECT * FROM `allowance`") or die(mysql_error());


}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table cellpadding="5" cellspacing="5" width="90%" align="center">
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">Select Allowance</label>
                       <select name="allow_id" class="form-control">
                       <?php
					   while($row=mysql_fetch_array($query)) {
						echo "<option value='$row[allow_id]'>$row[allow_name]</option>";   
					   }
                       ?>
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Start Date (Year-Month-Day)</label>
            <input type="text" onkeypress='return isNumberKey(event)' class="form-control cnic" value="<?php echo date('Y-m-d'); ?>" name="start_date">
                       </td>
                       </tr>
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">End Date (Year-Month-Day)</label>
                       <input type="text"  class="form-control cnic" name="end_date">
                       </td>
                     
                       <td>                       
                       <label for="exampleInputEmail1">Amount</label>
                       <input type="text" class="form-control" onkeypress='return isNumberKey(event)' name="amount">
                       <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>" />
                       </td>
                       </tr>
                       <tr>
                       <td>
                     <label for="exampleInputEmail1">Remarks</label>
                      <textarea name="remarks" class="form-control"></textarea>
                       </td>
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="make_allow">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                       </form>

                          </div>  
                          
                                       
             <!-- CNIC Validation -->
         <script src="js/cnic-validate.js"></script>
         <script src="js/cnic-validation.js"></script>
		 <script>
         $(document).ready(function() {
         $(".cnic").kendoMaskedTextBox({
         mask: "0000-00-00"
         });
         });
         </script>
         
  
  
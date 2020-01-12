<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT ee.`emp_name`,ee.`emp_id`,sc.`sc_title`,cc.`class_name`,cc.`start_date`,
                      cc.`end_date`,cc.`status`,cc.`ccid`,cc.`class_time`
                      FROM `sub_courses` AS sc, `class_code` AS cc, `employees` AS ee 
					  WHERE sc.scid=cc.scid AND cc.`emp_id`=ee.`emp_id` AND cc.ccid = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);


	$query2 = "SELECT * FROM `employees`";
	$result = mysql_query($query2);

}
?>
                       
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">Select Course</label>
                       <input type="text" class="form-control" name="scid" value="<?php echo $row['sc_title']; ?>" readonly="readonly" />
                       
                       </td>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Class Name</label>
                       <input type="text" class="form-control" id=""  name="class_name" value="<?php echo $row['class_name']; ?>" >
                       <input type="hidden" name="id" value="<?php echo $row['ccid']; ?>" />
                       </td>
                       </tr>
                       
                       <tr>
                       <td valign="top">
                       <label for="exampleInputEmail1">Start Date</label>
                       <input type="text" class="form-control datepicker" id="" name="s_date" value="<?php echo $row['start_date']; ?>">
                       </td>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">End Date</label>
                       <input type="text" class="form-control datepicker" id="" name="e_date" value="<?php echo $row['end_date']; ?>">
                       </td>
                       </tr>
                       
                       <tr>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Class Timing</label>
                       <input type="text" class="form-control" id="" name="class_time" value="<?php echo $row['class_time']; ?>">
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Status</label>
                       <select class="form-control m-bot15" name="status" style="">
 					   <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>                       
                       <option value="Complete">Complete</option>
                       <option value="Incomplete">Incomplete</option>
                       </select>
                       </td>
                       </tr>
                       
                       
                       <tr>
                       <td>                       
                       <label for="exampleInputEmail1">Teacher</label>
                       <select class="form-control m-bot15" name="emp_id" style="">
 					   <option value="<?php echo $row['emp_id']; ?>"><?php echo $row['emp_name']; ?></option>
                       <?php	
					   while($row2=mysql_fetch_assoc($result)) {
                       echo "<option value='$row2[emp_id]'>$row2[emp_name]</option>";
		               }
		               ?>
                       </select>
                       </td>
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-ccode">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
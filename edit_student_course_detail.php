<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `student_course_detail` AS scd, `student_info` AS si, `class_code` AS cc WHERE scd.`ccid`=cc.`ccid` AND scd.`student_id`=si.`student_id` AND scd.scd_id = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       
                      <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr><td>
                       <label for="exampleInputEmail1">Select Student</label>
                       <select class="form-control m-bot15" name="student_id" style="">
                       <option value="<?php echo $row['student_id']; ?>"><?php echo $row['student_name']; ?></option>
                       <?php echo $students->AllStudents(); ?>
                       </select>
                       </td>
                       <td>
                       <label for="exampleInputEmail1">Select Class</label>
                       <select class="form-control m-bot15" name="ccid" style="">
                       <option value="<?php echo $row['ccid']; ?>"><?php echo $row['class_name']; ?></option>
                       <?php echo $courses->ViewAllClasses(); ?>
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Status</label>
                       <select class="form-control m-bot15" name="status" style="">
					   <option value="<?php echo $row['scd_status']; ?>"><?php echo $row['scd_status']; ?></option>                       
                       <option value="Complete">Complete</option>
                       <option value="Incomplete">Incomplete</option>
                       </select>
                       </td></tr>
                       
                       <tr><td><input type="hidden" name="id" value="<?php echo $row['scd_id']; ?>" /></td></tr>

                       </table>                       

                       
                       
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-scd">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
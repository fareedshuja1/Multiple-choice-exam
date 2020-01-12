<?php
include("../includes/connection.php");
if(isset($_REQUEST['student_id'])) {
$id = $_REQUEST['id'];
$student_id = $_REQUEST['student_id'];

$query = mysql_query("SELECT * FROM `student_course_detail` AS scd WHERE scd.scd_id=$id") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       
                      <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr>
                       <td valign="top">
                       <label for="exampleInputEmail1">Form No</label>
                       <input type="text" class="form-control" name="form_no" value="<?php echo $row['form_no']; ?>" required="required">
                       <input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
                       </td>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Reg. No</label>
                       <input type="text" class="form-control" name="reg_no" value="<?php echo $row['reg_no']; ?>">
                       </td>
                       
                       <td valign="top">
                       <label for="exampleInputEmail1">Discounted Fee</label>
                       <input type="text" class="form-control show_fee" name="dis_fee" value="<?php echo $row['discounted_fee']; ?>" required="required">
                       </td>
                       </tr>
                       
                       <tr><td><input type="hidden" name="scd_id" value="<?php echo $row['scd_id']; ?>" /></td></tr>

                       </table>                       

                       
                       
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit_scd">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
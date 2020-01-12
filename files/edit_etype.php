<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `exam_type` WHERE `exam_id` = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table cellpadding="5" cellspacing="5" width="90%" align="center">
                       <tr>
                       <td valign="top">
                       <label for="">Exam Type Title</label>
                       <input type="text" class="form-control" name="exam_name" value="<?php echo $row['exam_name']; ?>">
                       <input type="hidden" name="id" value="<?php echo $row['exam_id']; ?>" />
                       </td> 
                       <td>
                       <label for="">Exam Status</label>
                       <select class="form-control m-bot15" name="exam_status" style="">
 <option value="<?php echo $row['exam_status']; ?>"><?php if($row['exam_status'] == 1) {echo "Acitve"; } else {echo "Inactive";} ?></option>
                       <option value="1">Active</option>
                       <option value="0">Inactive</option>
                       </select>
                       </td> 
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-etype">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
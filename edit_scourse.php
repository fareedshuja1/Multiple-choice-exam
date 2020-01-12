<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `sub_courses` as sc, main_courses as mc WHERE sc.mcid=mc.mcid AND sc.scid = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                       <tr>
                      
                       <td valign="top">
                       <label for="exampleInputEmail1">Course Title</label>
                       <input type="text" class="form-control" id="sc_title"  name="sc_title" value="<?php echo $row['sc_title'];?>">
                       <input type="hidden" name="id" value="<?php echo $row['scid']; ?>"
                       </td>
                       </td>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Course Fee</label>
          <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="course_fee" value="<?php echo $row['course_fee'];?>">
                       </td>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Duration (In Months)</label>
     <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="course_duration" value="<?php echo $row['course_duration'];?>">
                       </td>
                       
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-scourse">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
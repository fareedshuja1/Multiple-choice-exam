<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `student_info` AS si LEFT JOIN `nationality` AS n ON si.`nat_id`=n.`nat_id` 
		              LEFT JOIN `religion` AS r ON si.`rel_id` = r.`rel_id` WHERE si.`student_id`='$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="90%" cellpadding="3" cellspacing="" align="center">
 
                       <tr><td>
                       <label for="exampleInputEmail1">Name</label>
             <input type="text" class="form-control" name="name" value="<?php echo $row['student_name']; ?>" required="required">
                       <input type="hidden" name="stnd_id" value="<?php echo $row['student_id']; ?>">

                       </td><td>                       
                       <label for="exampleInputEmail1">Father Name</label>
          <input type="text" class="form-control" name="fname" value="<?php echo $row['student_fname']; ?>" required="required">
                       </td><td>                       
                       <label for="exampleInputPassword1">D.O.B</label>
         <input type="text" class="form-control datepicker" id="datepicker" name="dob" value="<?php echo $row['student_dob']; ?>">
                       </td></tr>
                                          
                       <tr><td>
                       <label for="exampleInputEmail1">Gender</label>
                       <select class="form-control m-bot15" name="gender" style="" required="required">
                       <?php echo "<option value='$row[student_gender]'>$row[student_gender]</option>"; ?>
                       <option value="Male">Male</option>
                       <option value="Female">Female</option>
                       </select>
                       </td><td>                       
                       <label for="exampleInputEmail1">Nationality</label>
                       <select class="form-control m-bot15" name="nationality">
                       <?php echo "<option value='$row[nat_id]'>$row[nat_title]</option>"; ?>
                       <?php echo $students->AllNationality(); ?>
                       </select>
                       </td><td>                       
                       <label for="exampleInputEmail1">Religion</label>
                       <select class="form-control m-bot15" name="religion">
                       <?php echo "<option value='$row[rel_id]'>$row[rel_title]</option>"; ?>
                       <?php echo $students->AllReligion(); ?>
                       </select>
                       </td></tr>
                       
                       <tr><td>
                       <label for="exampleInputEmail1">CNIC</label>
                <input type="text" id="cnic" name="std_nic" class="form-control" value="<?php echo $row['student_nic']; ?>"> 
                       </td><td>                       
                       <label for="exampleInputEmail1">Father CNIC</label>
                <input type="text" name="std_fnic" class="form-control" value="<?php echo $row['student_fnic']; ?>"> 
                       </td>
                       <td>
                        <label for="exampleInputPassword1">Image</label>
                       <input type="file" id="exampleInputFile" name="upload">
                       </td>
                       </tr>
                       
                       <tr><td>
                       <label for="exampleInputEmail1">Phone</label>
                       <input type="text" class="form-control" name="std_phone" value="<?php echo $row['student_phone']; ?>">
                       </td><td>                       
                       <label for="exampleInputEmail1">Cell</label>
                       <input type="text" class="form-control" name="std_cell" value="<?php echo $row['student_cell']; ?>">
                       </td><td>                       
                       <label for="exampleInputPassword1">Email</label>
   <input type="email" class="form-control" name="std_email" value="<?php echo $row['student_email']; ?>" required="required">
                       </td></tr>
                       
                       <tr>
                       <td>
                       <label for="exampleInputEmail1">Emergency Phone</label>
   <input type="text" class="form-control" name="em_phone" value="<?php echo $row['emergency_phone']; ?>" required="required">
                       </td><td>                       
                       <label for="exampleInputEmail1">Emergency Cell</label>
   <input type="text" class="form-control" name="em_cell" value="<?php echo $row['emergency_cell']; ?>" required="required">
                       </td><td>                       
                       <label for="exampleInputPassword1">Emergency Email</label>
   <input type="email" class="form-control" name="em_email" value="<?php echo $row['emergency_email']; ?>" required="required">
                       </td>
                       </tr>
                       
                       <tr>
                       <td colspan="2">                       
                       <label for="exampleInputPassword1">Address</label>
                       <input type="text" class="form-control" name="address" value="<?php echo $row['student_address']; ?>">
                       </td>
                       </tr>
                       
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                     
                       <div class="modal-footer">
                       <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                       <button class="btn btn-warning" type="submit" name="uptd-std">UPDATE</button>
                       
                                          </div>
                                      </div>
                                  </div>
                              </div>
                        <!-- modal -->
                       </form>
                      </div>  
                          
<!--    <script src="http://cdn.kendostatic.com/2014.3.1119/js/jquery.min.js"></script>-->   
        <script src="js/cnic-validate.js"></script>
        <script src="js/cnic-validation.js"></script>
<!--   <script src="http://cdn.kendostatic.com/2014.3.1119/js/kendo.all.min.js"></script> -->


   	 <script>
     $(document).ready(function() {
     $(".cnic").kendoMaskedTextBox({
     mask: "00000-0000000-0"
     });
     });
     </script>

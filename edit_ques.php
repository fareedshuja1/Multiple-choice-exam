<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `question_bank` AS qb, `question_bank_options` AS qbs, `sub_courses` AS sc
WHERE qb.`ques_id`=qbs.`ques_id` AND sc.`scid` = qb.`scid` AND qb.`ques_id` = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);

$sql = mysql_query("SELECT * FROM `question_bank_options` WHERE `ques_id` = '$id'") or die(mysql_error());
$row2 = mysql_fetch_assoc($sql);
$count = mysql_num_rows($sql);
}

$year=date("Y");
$year1=$year;
$yearFirst = $year-5;
$yearEnd=$year+50;

?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="" border="0">
                
                       <tr>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Question Hint</label>
            <input type="text" class="form-control" name="ques_hint" value="<?php echo $row['ques_hints']; ?>">
            <input type="hidden" name="ques_id" value="<?php echo $id; ?>" />
            <input type="hidden" name="count" value="<?php echo $count; ?>" />
                       </td>
                       
                        <td>
                       <label for="exampleInputEmail1">Status</label>
                       <select name="status" class="form-control m-bot15" id="" style="">
                       <option value="<?php echo $row['ques_status']; ?>"><?php echo $row['ques_status']; ?></option>
                       <option value="Active">Active</option>
                       <option value="Inactive">Inactive</option>
                       </select>
                       </td>
                       
                       </tr>
                       
                       <tr>
                       <td  colspan="3" valign="top">                       
                       <label for="exampleInputEmail1">Question Text</label>
        <textarea rows="2" cols="5" name="ques_text" class="form-control" style="resize: none;"><?php echo $row['ques_text']; ?></textarea>
                       </td>
                       </tr>
                       
                       <table width="100%" cellpadding="0" cellspacing="" border="0">
                       <?php
                       for($i=1;$i<=$count;$i++) {
						  
$qq = mysql_query("SELECT `option_text`,`correct_option` FROM `question_bank_options` WHERE `s_no`='$i' AND `ques_id`='$id'") or die(mysql_error());
	$row3 = mysql_fetch_array($qq);
	@$option = $row3['option_text']; 
	@$var1 = $row3['correct_option']; 
	if($var1 == 'C') {
	   $v = 'Correct';
	} else {
	   $v = 'Incorrect';
	}

                       echo "<tr>";
                       echo "<td valign='top' align='center'>
					   <input type='text' class='form-control' name='option_text[]' style='width: 250px' value='$option'> 
					   <input type='hidden' name='s_no[]' value='$i'>
					         </td>";
                       echo "<td>
                             <select class='form-control m-bot15' name='correct_option[]' style='width: 150px'>
                             <option value='$var1'>$v</option>
							 <option value='C'>Correct</option>
							 <option value='I'>Incorrect</option>
	                         </select>
                             </td>";
                       echo "</tr>";
                       }
                       ?>
                       </table>

                    
                       <tr><td>&nbsp;</td></tr>
                       </table>    
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-ques">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  
                          
<script>
function GetSubCo(id){
 
  $.post("get_scourse.php/", {id: id}, function(page_response)
  {
  $("#scidd").html(page_response);
  });
  }
</script>
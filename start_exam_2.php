<?php
include("includes/config.php"); 
$sid = $_SESSION['student_id'];

$ctmnts         = $_REQUEST['ctmnts'];
$ctsecs         = $_REQUEST['ctsecs'];
$ques_id        = $_REQUEST['ques_id'];
$emid           = $_REQUEST['emid'];
$std_qno        = $_REQUEST['std_qno'];
$ques_hints     = $_REQUEST['ques_hints'];
$ques_text      = $_REQUEST['ques_text'];
$s_no           = $_REQUEST['s_no'];
$correct_option = $_REQUEST['correct_option'];
$option_text    = $_REQUEST['option_text'];
$total_quess    = $_REQUEST['total_quess'];
$check          =  $_REQUEST['check'];


$select = mysql_query("SELECT qp.`s_no` FROM `question_paper` AS qp WHERE qp.`em_id` = '$emid'
                                                                    AND qp.`ques_id` = '$ques_id'
                                                                    AND qp.`student_id` = '$sid'
                                                                    AND qp.`std_qno` = '$std_qno'") or die(mysql_error());
$showres = mysql_fetch_assoc($select);

$ssno = $showres['s_no'];

if($ssno == $option_text) { $opt = 'Y'; } else { $opt = 'N'; }

if(isset($option_text)) {
$update = mysql_query("UPDATE `question_paper` SET `std_correct_ans` = '$option_text', `std_status` = '$opt', `rem_minutes`='$ctmnts',`rem_sec`='$ctsecs' 
WHERE `student_id` = '$sid'
AND `em_id` = '$emid'
AND `ques_id` = '$ques_id'
AND `std_qno` = '$std_qno'") or die(mysql_error());
}
    
$sql4 = mysql_query("SELECT  COUNT(1) AS solved_questions FROM `question_paper` AS q
WHERE q.`em_id`= $emid
AND q.`student_id`='$sid'
AND q.`std_status` IS NOT NULL") or die(mysql_error());

$exm = mysql_fetch_assoc($sql4);
$solved_ques = $exm['solved_questions'];


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




if($solved_ques < $total_quess) {

$sql_usol_q = mysql_query("SELECT qpl.`std_qno` as last_usol_q FROM `question_paper` AS qpl WHERE qpl.`em_id`=$emid AND qpl.`student_id`='$sid' AND qpl.`std_status` IS NULL ORDER BY qpl.`std_qno` DESC
LIMIT 1") or die(mysql_error());

$show_usol_q = mysql_fetch_assoc($sql_usol_q);
$last_usol_q = $show_usol_q['last_usol_q'];

									///////////////////////////////////////////////////////////

$sql_nxt_q = mysql_query("SELECT qpl.`std_qno` AS sql_nxt_q FROM `question_paper` AS qpl 
WHERE qpl.`em_id`=$emid AND qpl.`student_id`='$sid' AND qpl.`std_status` IS NULL
AND qpl.`std_qno` > $std_qno
ORDER BY qpl.`std_qno` ASC
LIMIT 1") or die(mysql_error());

$show_nxt_q = mysql_fetch_assoc($sql_nxt_q);
$last_nxt_q = $show_nxt_q['sql_nxt_q'];

									///////////////////////////////////////////////////////////


if($check == 'True') {

		$sql_nxt = mysql_query("SELECT qp.`ques_id`,qp.`std_qno`,CONCAT(CONCAT(qp.`std_qno`,'/'),
		(SELECT COUNT(1) FROM `question_paper` AS qp1 WHERE qp1.`student_id`='$sid' AND qp1.`em_id`= $emid)) AS qno
		,qb.`ques_hints`,qb.`ques_text`
		FROM `question_paper` AS qp,`question_bank` AS qb
		WHERE qp.`ques_id`=qb.`ques_id` 
		AND qp.`student_id`='$sid'
		AND qp.`em_id`= $emid
		AND qp.`std_qno` = $std_qno") or die(mysql_error());  
	
} else {

		if($last_nxt_q != $last_usol_q) {
		$sql_nxt = mysql_query("SELECT qp.`ques_id`,qp.`std_qno`,CONCAT(CONCAT(qp.`std_qno`,'/'),
		(SELECT COUNT(1) FROM `question_paper` AS qp1 WHERE qp1.`student_id`='$sid' AND qp1.`em_id`= $emid)) AS qno
		,qb.`ques_hints`,qb.`ques_text`
		FROM `question_paper` AS qp,`question_bank` AS qb
		WHERE qp.`ques_id`=qb.`ques_id` 
		AND qp.`student_id`='$sid'
		AND qp.`em_id`= $emid
		AND qp.`std_status` IS NULL
		AND qp.`std_qno` > $std_qno
		ORDER BY qp.`std_qno`
		LIMIT 1") or die(mysql_error());  
		} else {
		$sql_nxt = mysql_query("SELECT qp.`ques_id`,qp.`std_qno`,CONCAT(CONCAT(qp.`std_qno`,'/'),
		(SELECT COUNT(1) FROM `question_paper` AS qp1 WHERE qp1.`student_id`='$sid' AND qp1.`em_id`= $emid)) AS qno
		,qb.`ques_hints`,qb.`ques_text`
		FROM `question_paper` AS qp,`question_bank` AS qb
		WHERE qp.`ques_id`=qb.`ques_id` 
		AND qp.`student_id`='$sid'
		AND qp.`em_id`= $emid
		AND qp.`std_status` IS NULL
		ORDER BY qp.`std_qno`
		LIMIT 1") or die(mysql_error());  
		}
}



$show = mysql_fetch_assoc($sql_nxt); 
$ques_idd = $show['ques_id'];
$sql2 = mysql_query("SELECT qpo.`s_no`,qpo.`option_text`,qpo.`correct_option`
,(SELECT  q.`std_correct_ans` FROM `question_paper` AS q WHERE q.`ques_id`=qpo.`ques_id`
AND q.`em_id`=$emid AND q.`student_id`='$sid'
) AS std_c
FROM `question_bank_options` AS qpo 
WHERE qpo.`ques_id`= $ques_idd ORDER BY RAND()") or die(mysql_error());

} 

?>

                       <br />
                       <table border="0" cellpadding="10" style="float:left;" id="exam_detail">
                       
                       <tr>
                       <td>
                       <label for="exampleInputEmail1">Q.No</label>
 <input type="text"   class="form-control" id="qno" name="qno" readonly="readonly" style="width:80px" value="<?php echo $show['qno']; ?>">
 
 <input type="hidden" name="std_qno" id="std_qno" value="<?php echo $show['std_qno']; ?>" />
 <input type="hidden" name="ques_id" id="ques_id" value="<?php echo $show['ques_id']; ?>" />
 <input type="hidden" name="total_quess" id="total_quess" value="<?php echo $total_quess; ?>" />
 <input type="hidden" name="emid" id="emid" value="<?php echo $emid; ?>" />
                       </td>
                       </tr>
                       
					   <?php if($show['ques_hints'] == '' || $show['ques_hints'] == NULL) { ?>
                       <input type="hidden" id="ques_hints" name="ques_hints" value="" />
                       <?php } else {  ?>
                       <tr>
                       <td>
                       <label for="exampleInputEmail1">Question Hint</label>
 <input type="text" class="form-control" id="ques_hints" name="ques_hints" readonly="readonly" style="width:600px" value="<?php echo $show['ques_hints']; ?>">
                       </td>
                       </tr>
                       <?php }?>
                       
                       <tr>
                       <td>
                       <label for="exampleInputEmail1">Question</label>
   <textarea readonly="readonly" rows="4" cols="65" class="form-control" id="ques_text" name="ques_text" style="resize: vertical;"><?php echo $show['ques_text']; ?></textarea>
                       </td>
                       </tr>
                       
                       <tr>
                       <td>
                       <label for="exampleInputEmail1">Choose Answer</label><br />
                       <?php
					   if($solved_ques < $total_quess) {
					   while($r = mysql_fetch_assoc($sql2)) { ?>
                       <div class="radio">
                       <label>
        
        <input type="hidden" name="s_no" id="s_no" value="<?php echo $r['s_no']; ?>"  />
        <input type="hidden" name="correct_option" id="correct_option" value="<?php echo $r['correct_option']; ?>" />
        
        <input type="radio" name="option_text" id="option_text" <?php if($r['s_no'] == $r['std_c']) { ?> checked="checked" <?php } ?>
        value="<?php echo $r['s_no']; ?>" onclick="show_btn();">
        
                       <?php echo $r['option_text']; ?>
                       </label>
                       </div>
					   <?php }} ?>
                       </td>
                       </tr>
                       <tr>
                       <td align="right">
                       <?php if($solved_ques != $total_quess-1) { ?>
                       
<input type="button"  class="btn btn-success" name="next_ques" onclick="change_ques();" value="NEXT" id="next_btn" style="display:none" />
<input type="button"  class="btn btn-warning" name="skip_ques" onclick="change_ques();" value="SKIP" id="skip_btn" /> &nbsp;&nbsp;

<a class="btn btn-danger" data-toggle="modal" href="#myModal2">FINISH</a>

                       <?php } else { ?>
               
             <a class="btn btn-danger" data-toggle="modal" href="#myModal2">FINISH</a>
                       
                       <?php } ?>

                       </td>
                       </tr>
                       </table>
                       
          <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Finish Exam</h4>
                                          </div>
                                          <div class="modal-body">

                                              Are you sure to finish exam? You will not be able to start exam again.

                                          </div>
                                          <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
               <button data-dismiss="modal" class="btn btn-warning" type="button" onclick="exam_finish();">Confirm</button>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                         
                          <!-- Modal -->
                       
                       </form>                                              
                     
       <div id="show_solved_ques" style="float:left; margin-left: 30px; margin-top: 10px; color:#FFF; font-size:12px">
                   <table border="0" cellpadding="" cellspacing="" id="" style="" >
                     
                    <?php
	   
					$q = mysql_query("SELECT q.`std_qno`,q.`std_status`
					,IFNULL((SELECT COUNT(qper.`std_status`) FROM `question_paper` AS qper
					WHERE qper.`em_id`=q.`em_id`
					AND qper.`student_id`='$sid'
					AND UCASE(qper.`std_status`)=UCASE('Y')),0) AS cor
					,IFNULL((SELECT COUNT(qper.`std_status`) FROM `question_paper` AS qper
					WHERE qper.`em_id`=q.`em_id`
					AND qper.`student_id`='$sid'
					AND qper.`std_status` IS NOT NULL),0) AS solvedq
					FROM `question_paper` AS q 
                    WHERE q.`em_id`= $emid AND q.`student_id`= '$sid'") or die(mysql_error());
	                $count = 0;
	                $shows = 1;
					   
	                while ($shows <= $total_quess && $row = mysql_fetch_assoc($q)){ 
					if($row['solvedq'] >0){ 
					//$std_per=$row['cor']*100/$row['solvedq'];
					$std_per=$row['solvedq']*100/$total_quess;
					} else {
					$std_per=$row['cor']*100/100;
					}
      	   
		            if($count == 10) {
                    $count = 0;
                    echo "</tr> <tr>";
                    }
		   
		            if($row['std_status'] == NULL) { ?>
                    <td style='background-color:#4CC5CD;border-radius: 30px;padding: 15px;height:10px'>
                    <span onclick="Ques_Link(<?php echo $row['std_qno']; ?>);" style="cursor: pointer">
					<?php echo $row['std_qno']; ?>
                    </span>
                    </td>
		            
					<?php } else { ?>
                    <td style='background-color:#FF3030;border-radius: 30px;padding: 15px;height:10px'>
                    <span onclick="Ques_Link(<?php echo $row['std_qno']; ?>);" style="cursor: pointer">
					<?php echo $row['std_qno']; ?>
                    </span>
                    </td>
				    <?php }
				    
		            $count++;
		            $shows++;
	                }
                    
					?>
                    
                    <tr><td colspan="10">&nbsp;</td></tr>                 
                    <tr>
                    <td colspan="3"><span style="color:#4CC5CD;font-size:14px"><b>1 - UnSolved</b></span></td>
                    <td colspan="3"><span style="color:#FF3030;font-size:14px"><b>2 - Solved</b></span></td>
                    </tr>
                       

                    <tr><td colspan="10">
                      
                        <!--widget start-->
                      <br />
                 <div class="bio-chart" align="right" style="font-size:10px">
         <input class="knob" data-width="101" data-height="101" data-displayPrevious=true  data-thickness=".1"
         value="<?php echo round($std_per,2); ?>" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8">
                              </div>
                              <div class="bio-desk" style="padding-left: 20px; padding-top: 30px">
                                  <h4 class="terques">EXAM COMPLETION</h4>
                                 
                              </div>
                        
                      <!--widget end-->
                        
                        
                                  </td></tr>
                    
                   <tr><td colspan="10">&nbsp;</td></tr>
                    </table><br />
                    
                 
                    </div>
                    
   <script src="assets/jquery-knob/js/jquery.knob.js"></script>
   <script>
   $(".knob").knob({
   "readOnly":true
   });
  </script>
<?php
include("includes/header_std_2.php"); 
	  
$emid = $rslt['em_id'];
		
$sql4 = mysql_query("SELECT  COUNT(1) AS solved_questions FROM `question_paper` AS q
WHERE q.`em_id`= $emid
AND q.`student_id`='$sid'
AND q.`std_status` IS NOT NULL") or die(mysql_error());

$exm = mysql_fetch_assoc($sql4);
$solved_ques = $exm['solved_questions'];

if($solved_ques < $total_quess) {		
		
$sql = mysql_query("SELECT qp.`ques_id`,qp.`std_qno`,CONCAT(CONCAT(qp.`std_qno`,'/'),
(SELECT COUNT(1) FROM `question_paper` AS qp1 WHERE qp1.`student_id`='$sid' AND qp1.`em_id`= $emid)) AS qno
,qb.`ques_hints`,qb.`ques_text`
FROM `question_paper` AS qp,`question_bank` AS qb
WHERE qp.`ques_id`=qb.`ques_id` 
AND qp.`student_id`='$sid'
AND qp.`em_id`= $emid
AND qp.`std_status` IS NULL
ORDER BY qp.`std_qno`
LIMIT 1" )or die(mysql_error());  
		  
$show = mysql_fetch_assoc($sql);
$ques_id = $show['ques_id'];

$quer = "SELECT qpo.`s_no`,qpo.`option_text`,qpo.`correct_option` FROM `question_bank_options` AS qpo 
WHERE qpo.`ques_id`= $ques_id ORDER BY RAND()" or die(mysql_error());

$sql2 = mysql_query($quer);

} 


$queryss = mysql_query("SELECT si.`student_name`,si.`student_email`,si.`student_image` FROM `student_info` AS si
WHERE si.`student_id`='$sid'") or die(mysql_error());
$showss = mysql_fetch_assoc($queryss);

?><body style="background:url(img/BG_Img_1.gif) repeat 0 0 transparent;">

               <section class="panel" id="panel2" style="display:none;float:left; margin-left: 0px; width:100%">
                           <div id="examres" class="panel-body">
                           
                           </div>
                      </section>
                      
                       
         
         
         
      <section id="main-content" style="float:left; margin-left: 0px; width:100%;">
          
          
          <section class="wrapper" style="width:100%;" id="exam_res">
              <!-- page start-->
					  <div class="col-lg-6">
                      
                     
                      <section class="panel" id="welcome" style="background:url(img/BG_Img_1.gif) repeat 0 0 transparent;">
                        <div class="panel-body">
                       
                 <div class="row">
                 
                 
                  <aside class="profile-nav col-lg-3">
                      <section class="panel"  style="background-color:#AEC785">
                          <div class="user-heading round" style="background-color:#AEC785">
                              <a href="#">
           
           
      <?php if($showss['student_image'] == '' || $showss['student_image'] == NULL) { ?>
      <img alt="" src="no_pic.jpg" width="140px" height="140px">
      <?php } else { ?>
      <img alt="" src="img/students/<?php echo $showss['student_image']; ?>" width="140px" height="140px">
      <?php } ?>
           
                              </a>
                               <h1><?php echo $showss['student_name']; ?></h1>
                               <p><?php  echo $showss['student_email']; ?></p>
                          </div>

                      </section>
                  </aside>
                  
                  
                  
                  <aside class="profile-info col-lg-9">
                    <section class="panel">
                          <div class="bio-graph-heading">
                <b> Welcome <?php echo $showss['student_name']; ?> ! Click 'Start' To Begin Exam. We Wish You Best of Luck. :) </b>
                          </div>
                          <div class="panel-body bio-graph-info">
                              <div class="row">
                                  <div class="bio-row">
                                 <p><span style="width: 150px">Total Question </span> : <?php echo $rslt['total_ques']; ?></p>
                                  </div>
                                  <div class="bio-row">
                                 <p><span style="width: 150px">Total Minutes </span> : <?php echo $rslt['tot_minutes']; ?></p>
                                  </div>
                                  <div class="bio-row">
                              <p><span style="width: 150px"> Passing Percentage </span> : <?php echo $rslt['pass_per']; ?></p>
                                  </div>
                                  <div class="bio-row">
                               <p><span style="width: 150px"> Starting Time </span> : <?php echo $rslt['e_start_time']; ?></p>
                                  </div>
                                 
                                 
                              </div>
                          </div>
                      </section>
                      </aside>
                      
              <input type="button" id="btnct" value="START" onClick="countdownTimer()" class="btn btn-success" />

                </div>
                  </section>
                      
                
                     <section class="panel" id="ques_paper" style="display:none;">
                                             
                       <div class="panel-body" id="panelbody">
                       <br />
                       
                       <form action="" method="post" id="">
                       <table border="0" cellpadding="10" style="float:left;" id="exam_detail">
                       
                       <tr>
                       <td>
                       <label for="exampleInputEmail1">Q.No</label>
 <input type="text" class="form-control" id="qno" name="qno" readonly style="width:80px" value="<?php echo $show['qno']; ?>">
					  
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
 <input type="text" class="form-control" id="ques_hints" name="ques_hints" readonly style="width:600px" value="<?php echo $show['ques_hints']; ?>">
                       </td>
                       </tr>
                       <?php }?>
                       
                       <tr>
                       <td>
                       <label for="exampleInputEmail1">Question</label>
   <textarea readonly rows="4" cols="65" class="form-control" id="ques_text" name="ques_text" style="resize: vertical;"><?php echo $show['ques_text']; ?></textarea>
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
                <input type="radio" name="option_text" id="option_text" value="<?php echo $r['s_no']; ?>" onClick="show_btn();">
                       <?php //echo $r['option_text']."-".$r['correct_option']; ?>
                       <?php echo $r['option_text']; ?>
                       </label>
                       </div>
					   <?php }} ?>
                       </td>
                       </tr>
     
                       <tr>
                       <td align="right">
                       <?php if($solved_ques != $total_quess-1) { ?>
                       
<input type="button"  class="btn btn-success" name="next_ques" onClick="change_ques();" value="NEXT" id="next_btn" style="display:none" /> 
<input type="button"  class="btn btn-warning" name="skip_ques" onClick="change_ques();" value="SKIP" id="skip_btn" /> &nbsp;&nbsp;

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
                    <button data-dismiss="modal" class="btn btn-warning" type="button" onClick="exam_finish();">Confirm</button>
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
                    <span onClick="Ques_Link(<?php echo $row['std_qno']; ?>);" style="cursor: pointer">
					<?php echo $row['std_qno']; ?>
                    </span>
                    </td>
		            
					<?php } else { ?>
                    <td style='background-color:#FF3030;border-radius: 30px;padding: 15px;height:10px'>
                    <span onClick="Ques_Link(<?php echo $row['std_qno']; ?>);" style="cursor: pointer">
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
                     
                       
                       <div id="updet" style="display:none"></div>
                       
                                           
                       </div>
                     </section> 
                     
                     
              </div>
          </section>
      </section>
      </body>
      
      
<script>
function Ques_Link(std_qno) {
	 
	  var ques_id        = $("#ques_id").val(); 
	  var total_quess    = $("#total_quess").val();  
	  var emid           = $("#emid").val();  
	  var ques_hints     = $("#ques_hints").val();  
	  var ques_text      = $("#ques_text").val(); 
	  var s_no           = $("#s_no").val(); 
	  var correct_option = $('#correct_option').val(); 
	  var option_text    = $('input:radio[name=option_text]:checked').val(); 
	  var check          = "True";
	 
      $.post("start_exam_2.php/", {ques_id: ques_id,
	                               emid: emid,
								   total_quess: total_quess,
								   ctmnts: ctmnts,
								   ctsecs: ctsecs,
	                               std_qno: std_qno,
								   ques_hints: ques_hints,
								   ques_text: ques_text,
								   s_no: s_no,
								   correct_option: correct_option,
								   option_text: option_text,
								   check: check }, function(page_response)
    {
    $("#panelbody").html(page_response);
   
    });
}
</script>
   

<script>
function show_btn() {
$("#next_btn").show();
$("#skip_btn").hide();
}
</script>


<script>
 function change_ques() {
	 
	  var ques_id        = $("#ques_id").val(); 
	  var total_quess    = $("#total_quess").val();  
	  var emid           = $("#emid").val();  
	  var std_qno        = $("#std_qno").val();
	  var ques_hints     = $("#ques_hints").val();  
	  var ques_text      = $("#ques_text").val(); 
	  var s_no           = $("#s_no").val(); 
	  var correct_option = $('#correct_option').val(); 
	  var option_text    = $('input:radio[name=option_text]:checked').val(); 
	  var check          = "False";
	 
      $.post("start_exam_2.php/", {ques_id: ques_id,
	                               emid: emid,
								   total_quess: total_quess,
								   ctmnts: ctmnts,
								   ctsecs: ctsecs,
	                               std_qno: std_qno,
								   ques_hints: ques_hints,
								   ques_text: ques_text,
								   s_no: s_no,
								   correct_option: correct_option,
								   option_text: option_text,
								   check: check }, function(page_response)
    {
    $("#panelbody").html(page_response);
   
    });
 }
 </script>

 <script>
 function exam_finish() {
    
	  var ques_id        = $("#ques_id").val(); 
	  var total_quess    = $("#total_quess").val();  
	  var emid           = $("#emid").val();  
	  var std_qno        = $("#std_qno").val();
	  var ques_hints     = $("#ques_hints").val();  
	  var ques_text      = $("#ques_text").val(); 
	  var s_no        	 = $("#s_no").val(); 
	  var correct_option = $('#correct_option').val(); 
	  var option_text    = $('input:radio[name=option_text]:checked').val(); 
	  
      $.post("exam_result.php/", {ques_id: ques_id,
	                                emid: emid,
								    total_quess: total_quess,
								    ctmnts: ctmnts,
								    ctsecs: ctsecs,
	                                std_qno: std_qno,
								    ques_hints: ques_hints,
								    ques_text: ques_text,
								    s_no: s_no,
								    correct_option: correct_option,
								    option_text: option_text }, function(data)
    {
				$("#headr").hide();	
				$("#main-content").hide();
					
				$("#panel2").show();
				$("#examres").html(data);			  
	});
	
    
	$.post("sent_mail.php/",{emid:emid}, function(response) 
	{
		alert(response);
    });
	
 
 }
</script>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!--custom switch-->
    <script src="js/bootstrap-switch.js"></script>
    <!--custom tagsinput-->
    <script src="js/jquery.tagsinput.js"></script>
    <!--custom checkbox & radio-->
    <script type="text/javascript" src="js/ga.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    <!--script for this page-->
    <script src="js/form-component.js"></script>
    
	



<link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script src="js/dynamic-table.js"></script>



    <script src="assets/jquery-knob/js/jquery.knob.js"></script>

  <script>

      //knob
      $(".knob").knob({
    "readOnly":true
 });

  </script>
        
        
<script type="text/javascript">
  $(document).ready(function(){
    $(document).bind("contextmenu",function(e){
      //alert("For Security Reason Right Click Disabled on This Page");
      e.preventDefault();
    });
  });
</script>


<script>
setInterval(function(){ 
    
	var emid = $("#emid").val();  
	document.getElementById('showmns').innerHTML = ctmnts;
    document.getElementById('showscs').innerHTML = ctsecs;
	
	if(ctmnts != 0 && ctsecs != 0) {
	$.post("update_exam_time.php/", {emid: emid,
	                                 ctmnts: ctmnts,
									 ctsecs: ctsecs
	                                 }, function(data)
    {
		$("#updet").html(data);		  
	});
	}
	
}, 120000);
</script>
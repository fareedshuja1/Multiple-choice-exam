<?php
include("includes/config.php"); 
//require 'PHPMailer/PHPMailerAutoload.php';

if (!$_SESSION['student_id']) { redirect_to("login.php"); }

$sid = $_SESSION['student_id'] ;

//if(isset($_REQUEST['ques_id'])) {
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


$select = mysql_query("SELECT qp.`s_no` FROM `question_paper` AS qp WHERE qp.`em_id` = '$emid'
                                                                    AND qp.`ques_id` = '$ques_id'
                                                                    AND qp.`student_id` = '$sid'
                                                                    AND qp.`std_qno` = '$std_qno'") or die(mysql_error());
$showres = mysql_fetch_assoc($select);

$ssno = $showres['s_no'];

if($ssno == $option_text) { $opt = 'Y'; } else { $opt = 'N'; }


if(isset($option_text)) {

$update2 = mysql_query("UPDATE `question_paper` SET `std_correct_ans`='$option_text',`std_status`='$opt',`rem_minutes`='$ctmnts', `rem_sec`='$ctsecs' WHERE `student_id` = '$sid' AND `em_id` = '$emid' AND `ques_id` = '$ques_id' AND `std_qno` = '$std_qno'") or die(mysql_error());

} 


//}


$selection = mysql_query("SELECT s.`student_name`,s.`student_image`,s.`student_email` FROM `student_info` AS s
WHERE s.`student_id`='$sid'") or die(mysql_error());
$selection_r = mysql_fetch_assoc($selection);

$update = mysql_query("UPDATE `question_paper` SET `exam_status` = 'Y' WHERE `em_id`=$emid AND `student_id`='$sid'") or die(mysql_error());

$show_res = mysql_query("SELECT 
c.`cat_name`,cc.`class_name`,em.`total_ques`,em.`tot_minutes`,em.`pass_per`
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND q.`std_status`='Y'
) AS Correct_ans
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND q.`std_status`='N'
) AS Incorrect_ans
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND (q.`std_status` IS NULL)
) AS Unsolved
,ROUND(((SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND q.`std_status`='Y'
)*100/em.`total_ques`),2) AS Percentage
,CASE
WHEN ROUND(((SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND q.`std_status`='Y'
)*100/em.`total_ques`),2)>=em.`pass_per` THEN 'Pass'
ELSE
'Fail'
END Pass_fail
FROM `exam_master` AS em,`category` AS c,`class_code` AS cc
WHERE em.`cat_id`=c.`cat_id`
AND em.`ccid`=cc.`ccid`
AND em.`em_id`= $emid") or die(mysql_error());

$show_ress = mysql_fetch_assoc($show_res);


?>
                   <div class="col-lg-6" style="margin-top:2px">
                              <!--widget start-->
                              <section class="panel">
                                  <div class="twt-feed blue-bg">
                                      <h1><?php echo $selection_r['student_name']; ?></h1>
                                      <p><?php echo $selection_r['student_email']; ?></p>
                                      <a href="#">
              
			  <?php if($selection_r['student_image'] == '' || $selection_r['student_image'] == NULL) { ?>
              <img alt="" src="no_pic.jpg" width="140px" height="140px">
              <?php } else { ?>
              <img src="img/students/<?php echo $selection_r['student_image']; ?>" height="140px" width="140px">
              <?php } ?>

              
                                      </a>
                                  </div>
                                  <div class="weather-category twt-category" align="center">
                                      
                                  <ul>
                                   <li style="width:250px">
                                    <h5 style="font-size:16px"><b>CLASS</b></h5>
                                     <span class="label label-primary  r-activity">  <?php echo $show_ress['class_name']; ?></span>
                                      </li>
                                          
                                   <li style="width:250px">
                                    <h5 style="font-size:16px"><b>EXAM TYPE</b></h5>
                                     <span class="label label-primary  r-activity">      <?php echo $show_ress['cat_name']; ?></span>
                                      </li>
                                          
                                   <li style="width:250px">
                                    <h5 style="font-size:16px"><b>TOTAL QUESTIONS</b></h5>
                                     <span class="label label-primary  r-activity">       <?php echo $show_ress['total_ques']; ?></span>
                                      </li>
                                          
                                   <li style="width:250px">
                                    <h5 style="font-size:16px"><b>TOTAL MINUTES</b></h5>
                                     <span class="label label-primary  r-activity">       <?php echo $show_ress['tot_minutes']; ?></span>
                                      </li>
                                          
                                      </ul>
                                      </div>
                                      
                                      <div class="weather-category twt-category" align="center">
                                          <ul>
                                         <li style="width:250px">
                                              <h5 style="font-size:16px"><b>CORRECT ANSWERS</b></h5>
                                         <span class="label label-primary  r-activity">  <?php echo $show_ress['Correct_ans']; ?></span>
                                          </li>
                                         <li style="width:250px">
                                              <h5 style="font-size:16px"><b>INCORRECT ANSWERS</b></h5>
                                        <span class="label label-primary  r-activity">      <?php echo $show_ress['Incorrect_ans']; ?></span>
                                          </li>
                                        <li style="width:250px">
                                              <h5 style="font-size:16px"><b>UNSOLVED</b></h5>
                                        <span class="label label-primary  r-activity">        <?php echo $show_ress['Unsolved']; ?></span>
                                          </li>
                                         <li style="width:250px">
                                              <h5 style="font-size:16px"><b>PASSING %</b></h5>
                                           <span class="label label-primary  r-activity">     <?php echo $show_ress['pass_per']; ?></span>
                                          </li>
                                          
                                      </ul>
                                      
                                  </div>
                                  
                                  
                              </section>
                              <!--widget end-->
                          </div>
                          
                           <!--widget start-->
                      <div class="panel">
                          <div class="panel-body">
                          
                              <div class="bio-chart" align="right">
 <input class="knob" data-width="101" data-height="101" data-displayPrevious=true  data-thickness=".2" 
 value="<?php echo $show_ress['Percentage']; ?>" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8">
                              </div>
                              
                             <div class="bio-desk" style="padding-left: 20px; padding-top: 30px">
                             <?php if($show_ress['Pass_fail'] == 'Fail') { ?>
                             <h4 class="terques" style="color:#F00">You have FAILED this exam. Good luck for next exam! </h4>
							 <?php } else { ?> 
                             <h4 class="terques">Congratulations! You have PASSED this exam. Well Done!</h4>
                             <?php } ?>                                 
                             </div>
                          
                          </div>
         
         <div align="center"> <a class='btn btn-success' href='index_std.php'>Go to Main Page</a> </div>

                      </div>
                      <!--widget end-->
                      
                      
                          
                          
                        </div>
                      </section>
                      
    
 </body>
</html>
  
    <script src="assets/jquery-knob/js/jquery.knob.js"></script>

    <script>

      //knob
    $(".knob").knob({
    "readOnly":true
 });

  </script>


<?php
include("includes/config.php"); 
if (!$_SESSION['student_id']) { redirect_to("slogin.php"); }

$sid = $_SESSION['student_id'] ;

if(isset($_GET['id'])) {
$emid = $_GET['id'];
}

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

<head>
    <title>:: Online Exam RESULT ::</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
    </head>



    <div class="col-lg-6" style="margin-top:10px">
                              <!--widget start-->
                              <section class="panel">
                                  <div class="twt-feed blue-bg">
                                      <h1><?php echo $selection_r['student_name']; ?></h1>
                                      <p><?php echo $selection_r['student_email']; ?></p>
                                      <a href="#">
                                  <img src="img/students/<?php echo $selection_r['student_image']; ?>" height="140px" width="140px">
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
                             <h4 class="terques" style="color:#F00">You Have <i><?php echo $show_ress['Pass_fail']; ?></i>  The  <i><?php echo $show_ress['cat_name']; ?></i> Exam. Please Try Again Next Time. </h4>
							 <?php } else { ?> 
                             <h4 class="terques">Congratulations You Have <i><?php echo $show_ress['Pass_fail']; ?> </i> The  <i><?php echo $show_ress['cat_name']; ?></i> Exam. </h4>
                             <?php } ?>                                 
                              </div>
                          </div>
                      </div>
                      <!--widget end-->
                          
                          
                        </div>
                      </section>
                      
    
 
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
    
    <!-- Date Picker -->
	<link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script src="assets/jquery-knob/js/jquery.knob.js"></script>


    <!--common script for all pages-->

    <!--script for this page only-->
    <script src="js/dynamic-table.js"></script>
    <script>

      //knob
      $(".knob").knob();

  </script>


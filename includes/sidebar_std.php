<?php 
require_once("config.php");
$sid = $_SESSION['student_id'] ;
$query = mysql_query("SELECT CONCAT(CONCAT(cc.`class_name`,' @ '),DATE_FORMAT(em.`e_start_time`,'%l:%i %p')) AS timing, em.`em_id`,DATE_FORMAT(em.`e_start_time`,'%l:%i %p')
AS e_start_time,DATE_FORMAT(NOW(),'%l:%i %p') AS now_time
FROM `exam_master` AS em, `student_course_detail` AS scd,`class_code` AS cc
WHERE em.`ccid` = scd.`ccid`
AND em.`ccid`=cc.`ccid`
AND em.`exam_date` = CURDATE()
AND em.`em_id` NOT IN (SELECT qp.`em_id` FROM `question_paper` AS qp WHERE qp.`student_id` = '$sid'
AND qp.exam_status = 'Y')
AND scd.`student_id` IN (SELECT DISTINCT q.`student_id` FROM `question_paper` AS q WHERE q.`exam_status` IS NULL)
AND scd.`student_id` = '$sid'") or die(mysql_error());
//$count = $row['countt'];

$timing = date("Y-m-d H:i:s");
?>
      <aside>
          <div id="sidebar"  class="nav-collapse">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="">
                      <a class="" href="index_std.php">
                          <i class="icon-th"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  
                      <li class="sub-menu">
                      <a href="javascript:;" class="">
                      <i class="icon-circle-arrow-down"></i>
                      <span>Today Exams</span>
                      <span class="arrow"></span>
                      </a><ul class="sub">
                       <?php while($row = mysql_fetch_assoc($query)) { ?>
                       
                       <?php if($row['e_start_time'] <= $row['now_time']) { ?>
                       
  <li>
  <a class='' href='start_exam.php?id=<?php echo $row['em_id']; ?>' onclick="hidesidebar();"><?php echo $row['timing']; ?> Start</a></li>
                       
                       <?php } else { ?>
                       
  <li><a class='' href='' onclick="alert('Exam Time Not Start Yet. Please Wait!');"><?php echo $row['timing']; ?> Start</a></li>

                       <?php } ?>
                      
                      <?php  } ?>

                     </ul> </li>
     


                  
                  <li></li>
                  <li class="sub-menu active"></li>
                  <li></li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      
      
<script>
function hidesidebar(){
$("#sidebar").hide();
}
</script>

<?php
ob_start();
class Questions extends config {
	
	
	public function AddQuestion() {
		
        extract($_POST);
		$count = $_POST['count'];
		
    $mx_id = mysql_query("SELECT IFNULL(MAX(em.`ques_id`),0)+1 AS ques_id FROM `question_bank` AS em") or die(mysql_error());
	$max_id = mysql_fetch_assoc($mx_id);
	$mid = $max_id['ques_id'];
	
	$query = mysql_query("INSERT INTO `question_bank` SET `ques_id`='$mid',`ques_year` = '$ques_year',`ques_text` = '$ques_text',
		                `ques_hints` = '$ques_hint',`ques_status` = 'Active', `scid`= '$scid',`cat_id`='$cat_id'") or die(mysql_error());
		$id = $mid;
         
		for($i=0;$i<$count;$i++) {
			$a = $i+1;
		$sql = mysql_query("INSERT INTO `question_bank_options` SET `option_text` = '$option_text[$i]',
		                                                            `correct_option` = '$correct_option[$i]',
		                                                            `s_no` = '$a',`ques_id`='$id'") or die(mysql_error());	
		}
		
		redirect('index.php?folder=questions&page=add_question','Question is Saved in Database','add');
	}
	
	
	
	
	
		public function AllQuestion() {
	
$query = mysql_query("SELECT qb.`ques_id`,qb.`ques_text`,qb.`ques_year`,qb.`ques_status`,c.`cat_name` ,sc.`sc_title`
FROM `question_bank` AS qb,category AS c,sub_courses AS sc WHERE qb.`cat_id`=c.`cat_id` AND qb.`scid`=sc.`scid` GROUP BY qb.`ques_id`") or die(mysql_error());
	
	$i = 1;
    while($row = mysql_fetch_assoc($query)) {
							echo "<tr>";
        			    	echo "<td>$i</td>";
							echo "<td>$row[sc_title]</td>";
							echo "<td>$row[cat_name]</td>";
							echo "<td>$row[ques_text]</td>";
							
							echo "<td>$row[ques_year]</td>";
							echo "<td>$row[ques_status]</td>";
		                    echo "<td align='left'>
		      <a class='btn btn-warning' data-toggle='modal' onClick='editques($row[ques_id])' href='#myModaledit'>Edit</a></td>";
		                    echo "</tr>";
							$i++;
	                        }
		
	}
	
	
	public function EditQuestion($id) {
		extract($_POST);
		$count = $_POST['count'];
		$query = mysql_query("UPDATE `question_bank` SET `ques_text`='$ques_text',`ques_hints`='$ques_hint',`ques_status`='$status'                               WHERE `ques_id` = '$id'") or die(mysql_error());
										  
	    if($query) {
		$q = mysql_query("DELETE FROM `question_bank_options` WHERE `ques_id`='$id'") or die(mysql_error());	
		}
		
		if($q) {
		for($i=0;$i<$count;$i++) {
			$a = $i+1;
		$sql = mysql_query("INSERT INTO `question_bank_options` SET `option_text` = '$option_text[$i]',
		                                                            `correct_option` = '$correct_option[$i]',
		                                                            `s_no` = '$a',`ques_id`='$id'") or die(mysql_error());	
		}	
		}
		
		redirect('index.php?folder=questions&page=all_questions','Question has been updated','add');		
	}
	
	
	
	public function AddExamMaster() {
	
	extract($_POST);
   
	 $check = mysql_query("SELECT COUNT(1) AS tot FROM `question_bank` AS q 
						   WHERE q.`cat_id`= '$cat_id' AND q.`scid`= $scid") or die(mysql_error());
						   
	 $check_fetch = mysql_fetch_assoc($check);
	 $num = $check_fetch['tot'];
	 
	 if($total_ques <= $num) {

    $e_start_time = $exam_date." ".$shour.":".$sminute.":00";
	$e_end_time =   $exam_date." ".$ehour.":".$eminute.":00";
	
	$mx_id = mysql_query("SELECT IFNULL(MAX(em.`em_id`),0)+1 AS em_id FROM `exam_master` AS em") or die(mysql_error());
	$max_id = mysql_fetch_assoc($mx_id);
	$mid = $max_id['em_id'];
	
    $query = mysql_query("INSERT INTO `exam_master` SET `em_id`='$mid',`exam_date` = '$exam_date',`e_start_time` = '$e_start_time',
		                 `e_end_time` = '$e_end_time',`ccid` = '$ccid', `total_ques`= '$total_ques',`tot_minutes`= '$tot_minutes',                         `cat_id`='$cat_id',`pass_per`='$pass_per'") or die(mysql_error());


    
	if(!isset($_POST['colorCheckbox'])) {
		
    $q = mysql_query("SELECT scd.`student_id` FROM `student_course_detail` AS scd 
                      WHERE scd.`ccid`= $ccid AND scd.`scd_status`='Incomplete'") or die(mysql_error());
	
	while($r = mysql_fetch_assoc($q)) {
		  $std_id = $r['student_id'];		
          $rrr = mysql_query("SELECT qb.`ques_id`,qbo.`s_no` 
							FROM `question_bank` AS qb,`question_bank_options` AS qbo
							WHERE qb.`ques_id`=qbo.`ques_id`
							AND UCASE(qbo.`correct_option`)=UCASE('C')
							AND qb.`cat_id`= $cat_id
							AND qb.`scid`= $scid
							AND qb.`ques_id` NOT IN (SELECT qp.`ques_id` FROM question_paper AS qp WHERE qp.`student_id`='$std_id'
							and qp.`em_id`='$mid')
							ORDER BY RAND() LIMIT $total_ques");
		  $x =1;
		  while($sam = mysql_fetch_array($rrr)){
			  
			  $qqq = $sam['ques_id'];
			  $iiii = $sam['s_no'];
			  mysql_query("INSERT INTO `question_paper` SET `std_qno` = '$x', `em_id` ='$mid', `student_id` ='$std_id',  
				          `ques_id`='$qqq', `s_no`='$iiii'") or die(mysql_error());
			  $x++;
			  }
	     }
	     redirect('index.php?folder=questions&page=exam_master','Exam Added Succesfuly','add');	
		
	} else {
		
		  //$std_id = $student_id;		
          $rrr = mysql_query("SELECT qb.`ques_id`,qbo.`s_no` 
							FROM `question_bank` AS qb,`question_bank_options` AS qbo
							WHERE qb.`ques_id`=qbo.`ques_id`
							AND UCASE(qbo.`correct_option`)=UCASE('C')
							AND qb.`cat_id`= $cat_id
							AND qb.`scid`= $scid
							AND qb.`ques_id` NOT IN (SELECT qp.`ques_id` FROM question_paper AS qp WHERE qp.`student_id`='$stud'
							and qp.`em_id`='$mid')
							ORDER BY RAND() LIMIT $total_ques");
		  $x =1;
		  while($sam = mysql_fetch_array($rrr)){
			  
			  $qqq = $sam['ques_id'];
			  $iiii = $sam['s_no'];
			  mysql_query("INSERT INTO `question_paper` SET `std_qno` = '$x', `em_id` ='$mid', `student_id` ='$stud',  
				          `ques_id`='$qqq', `s_no`='$iiii'") or die(mysql_error());
			  $x++;
			  }
	     redirect('index.php?folder=questions&page=exam_master','Exam Added Succesfuly','add');	
			}
				
         } else {
		
redirect('index.php?folder=questions&page=exam_master','Exam cannot be added. Total number of Questions exceed the Question Bank for this course.','delete');	
    }	
	
}
	
	
	
	public function ViewExamMaster() {
	
	 $sql = mysql_query("SELECT em.`em_id`,mc.`mc_title`,sc.`sc_title`,c.`cat_name`,cc.`class_name`,em.`exam_date`
						,DATE_FORMAT(em.`e_start_time`,'%r') AS e_start_time
						,DATE_FORMAT(em.`e_end_time`,'%r') AS e_end_time,em.`total_ques`,em.`tot_minutes`,em.`pass_per`
						,CASE WHEN em.`exam_date`< CURDATE() THEN 'Previous Exam'
						WHEN em.`exam_date`= CURDATE() THEN 'Today Exam' 
						WHEN em.`exam_date`> CURDATE() THEN 'Coming Exam' END AS Exam_status
						FROM `exam_master` AS em,`category` AS c,`class_code` AS cc,`sub_courses` AS sc,`main_courses` AS mc
						WHERE em.`cat_id`=c.`cat_id`
						AND em.`ccid`=cc.`ccid`
						AND cc.`scid`=sc.`scid`
						AND sc.`mcid`=mc.`mcid`
						ORDER BY em.`exam_date` DESC") or die(mysql_error());	
								
		while($row = mysql_fetch_assoc($sql)) {
			
		$EndDate = $row['exam_date'];
        $newDate2 = date("d-m-Y", strtotime($EndDate));
		
							echo "<tr>";
							echo "<td>$row[sc_title]</td>";
							echo "<td>$row[cat_name]</td>";
							echo "<td>$row[class_name]</td>";
							echo "<td>$newDate2</td>";
							echo "<td>$row[e_start_time]</td>";
							echo "<td>$row[total_ques]</td>";
							echo "<td>$row[tot_minutes]</td>";
							echo "<td>$row[pass_per]</td>";
							echo "<td>$row[Exam_status]</td>";
							
							if($row['Exam_status'] == 'Coming Exam') {
							echo "<td align='left'>
		<a class='btn btn-success' data-toggle='modal' onClick='editemaster($row[em_id])' href='#myModaledit'>Edit</a></td>";
							} else {
							echo "<td align='left'>
		                   <a class='btn btn-danger' data-toggle='modal' href=''>LOCKED</a></td>";	
							}
		}
		
	}
	
	
	
	public function EditExamMaster($id) {
		extract($_POST);
		
		
    $newDate2 = date("Y-m-d", strtotime($exam_date)); 
	
	$e_start_time = $newDate2." ".$shour.":".$sminute.":00";
	$e_end_time =   $newDate2." ".$ehour.":".$eminute.":00";
	
	$query = mysql_query("UPDATE `exam_master` SET `exam_date` = '$newDate2',`e_start_time` = '$e_start_time',`e_end_time` = '$e_end_time',
		                 `tot_minutes`= '$tot_minutes',`pass_per`='$pass_per' WHERE `em_id` = '$id'") or die(mysql_error());
		
		redirect('index.php?folder=questions&page=exam_master','Exam Successfuly Update','add');	
	}
	
	
	
	public function SolvedQues($emid,$sid,$total_quess) {
		
    $q = mysql_query("SELECT q.`std_qno`,q.`std_status` FROM `question_paper` AS q 
                      WHERE q.`em_id`= $emid AND q.`student_id`= '$sid'") or die(mysql_error());
					   
	$count = 0;
	$shows = 1;
					   
	while ($shows <= $total_quess && $row = mysql_fetch_assoc($q)){ 
      	   if($count == 10) {
           $count = 0;
           echo "</tr> <tr>";
           }
		   
		  if($row['std_status'] == NULL) {
       	  echo "<td style='background-color:#A9D86E;border-radius: 20px;padding: 15px'>".$row['std_qno']."</td>";
		  } else {
		  echo "<td style='background-color:#FF6C60;border-radius: 20px;padding: 15px'>".$row['std_qno']."</td>";
		  }
       	  $count++;
		  $shows++;
	}
		
	}
	
	
    
}	
		
$ques = new Questions();


?>
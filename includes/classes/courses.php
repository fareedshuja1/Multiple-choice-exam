<?php
ob_start();

class Courses extends config {
		
        public function ViewMainCourse() {
		
		$query = "SELECT * FROM `main_courses` ORDER BY `mcid` DESC";
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
		echo "<tr>";
        echo "<td>$row[mc_title]</td>";
		echo "<td>$row[status]</td>";
	
echo "<td align='left'><a class='btn btn-warning' data-toggle='modal' onClick='editmcourse($row[mcid])' href='#myModaledit'>Edit</a></td>";
echo "<td align='left'><a class='btn btn-danger' data-toggle='modal' href='index.php?folder=courses&page=add_main_courses&dlt=$row[mcid]'>Delete</a></td>";
		echo "</tr>";	
		}
	    }
	
	    public function AddMainCourse() {
			
		extract($_POST);
		$title = ucwords($_POST['title']);
		$query = "INSERT INTO `main_courses` SET `mc_title` = '$title',`status` = '$status'";
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=courses&page=add_main_courses','Record is Saved in Database','add');
		}
		
		
		public function EditMainCourse($id) {
			
		extract($_POST);
		$title = ucwords($_POST['title']);
		$query = "UPDATE `main_courses` SET `mc_title` = '$title',`status` = '$status' WHERE `mcid` = $id";
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=courses&page=add_main_courses','Record has been updated','add');
		}	
		
		public function DeleteMainCourse($id) {
		$query = mysql_query("DELETE FROM `main_courses` WHERE `mcid` = $id") or die(mysql_error());
		redirect('index.php?folder=courses&page=add_main_courses','Record has been deleted','delete');
		}
		
	    
		/* ************************************************ Sub Courses ************************************************  */
		
		
		public function AddSubCourse() {
		extract($_POST);
		$sc_title = ucwords($_POST['sc_title']);
		$query = "INSERT INTO `sub_courses` SET `sc_title`='$sc_title',`mcid`='$mcid',`course_duration`= '$course_duration',`course_fee`= '$course_fee'";
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=courses&page=add_sub_courses','Record is Saved in Database','add');
		}

	    public function EditSubCourse($id) {
		extract($_POST);
		$sc_title = ucwords($_POST['sc_title']);
		$query = "UPDATE `sub_courses` SET `sc_title`='$sc_title',`course_duration`='$course_duration',`course_fee`='$course_fee' WHERE `scid` = $id";
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=courses&page=add_sub_courses','Record is Saved in Database','add');	
		}
	
		
	    public function DeleteSubCourse($id) {
		$query = mysql_query("DELETE FROM `sub_courses` WHERE `scid` = $id") or die(mysql_error());
		redirect('index.php?folder=courses&page=add_sub_courses','Record has been deleted','delete');	
		}
		
		public function ViewSubCourses() {
		$query = "SELECT * FROM `sub_courses` as sc, main_courses as mc  WHERE sc.mcid=mc.mcid";
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
		echo "<tr>";
        echo "<td>$row[mc_title]</td>";
	    echo "<td>$row[sc_title]</td>";
		echo "<td>$row[course_fee]</td>";
	    echo "<td>$row[course_duration]</td>";

echo "<td align='left'><a class='btn btn-warning' data-toggle='modal' onClick='editscourse($row[scid])' href='#myModaledit'>Edit</a></td>";
echo "<td align='left'><a class='btn btn-danger' data-toggle='modal' href='index.php?folder=courses&page=add_sub_courses&dlt=$row[scid]'>Delete</a></td>";
		echo "</tr>";	
		}	
		}
		
		
		public function ViewAllCategories() {
		$query = mysql_query("SELECT * FROM `category`") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)) {
		echo "<option value='$row[cat_id]'>$row[cat_name]</option>";
		}
		}
		
		public function ViewAllMainCourses() {
		$query = mysql_query("SELECT * FROM `main_courses`") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)) {
		echo "<option value='$row[mcid]'>$row[mc_title]</option>";
		}	
		}
		
		public function ViewAllroom() {
		$query = mysql_query("SELECT * FROM `rooms`") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)) {
		echo "<option value='$row[room_id]'>$row[room_name]</option>";
		}	
		}
		
		public function ViewAllSubCourses() {
		$query = mysql_query("SELECT * FROM `sub_courses`") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)) {
		echo "<option value='$row[scid]'>$row[sc_title]</option>";
		}	
		}


		/* ************************************************ Class Code ************************************************  */


        public function AddClassCourse() {
		extract($_POST);
		$class_name = ucwords($_POST['class_name']);
		
		$mx_id = mysql_query("SELECT IFNULL(MAX(emp.`ccid`),0)+1 AS ccid FROM `class_code` AS emp") or die(mysql_error());
	    $max_id = mysql_fetch_assoc($mx_id);
	    $mid = $max_id['ccid'];
		
		$time = $chour.":".$cminute." ".$cmoon;
		$etime = $cchour.":".$ccminute." ".$ccmoon;
			
		$query = "INSERT INTO `class_code` SET  `ccid`='$mid',`class_name`='$class_name',`scid`='$scid',
												`room_id`=$roomid,`class_etime`='$etime',
										 	    `start_date`='$s_date', `end_date`= '$e_date', 
											    `status` = 'Incomplete',`emp_id`='$emp_id',`class_time`='$time'";
												
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=courses&page=add_class_code','Record is Saved in Database','add');	
		}
		
		
		
		
		public function ViewClassCode() {
	    $query = "SELECT ee.`emp_name`,ee.`emp_id`,sc.`sc_title`,cc.`class_name`,cc.`start_date`,cc.`end_date`,cc.`status`,cc.`ccid`,cc.`class_time`
FROM `sub_courses` AS sc, `class_code` AS cc, `employees` AS ee WHERE sc.scid=cc.scid AND cc.`emp_id`=ee.`emp_id`";
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
			
        $StartDate = $row['start_date'];
        $newDate = date("d-m-Y", strtotime($StartDate));
		
		$EndDate = $row['end_date'];
        $newDate2 = date("d-m-Y", strtotime($EndDate));
			
		echo "<tr>";
        echo "<td>$row[sc_title]</td>";
	    echo "<td>$row[class_name]</td>";
		echo "<td>$row[emp_name]</td>";
	    echo "<td>$newDate</td>";
	    echo "<td>$newDate2</td>";
		echo "<td>$row[class_time]</td>";
		
        echo "<td>$row[status]</td>";
echo "<td align='left'><a class='btn btn-warning' data-toggle='modal' onClick='editccode($row[ccid])' href='#myModaledit'>Edit</a></td>";
echo "<td align='left'><a class='btn btn-danger' data-toggle='modal' href='index.php?folder=courses&page=add_class_code&dlt=$row[ccid]'>Delete</a></td>";
		echo "</tr>";	
		}	
		}
		
		public function DeleteClassCode($id) {
		$query = mysql_query("DELETE FROM `class_code` WHERE `ccid` = $id") or die(mysql_error());
		redirect('index.php?folder=courses&page=add_class_code','Record has been deleted','delete');	
		}
		
		public function EditClassCode($id) {
		extract($_POST);
		$class_name = ucwords($_POST['class_name']);
			
		$query = "UPDATE `class_code` SET `class_name`='$class_name',
		                                  `start_date`='$s_date', 
										  `end_date`= '$e_date',
										  `status` = '$status',
										  `class_time`='$class_time',
										  `emp_id`='$emp_id'
										   WHERE `ccid` = '$id'";
		
		if($status == 'Incomplete') {
		mysql_query("UPDATE `student_course_detail` AS scd SET scd.`scd_status`='Incomplete'
WHERE scd.`ccid` = '$id'") or die(mysql_error());
		} else {
		mysql_query("UPDATE `student_course_detail` AS scd SET scd.`scd_status`='Complete'
WHERE scd.`ccid` = '$id'") or die(mysql_error());
			
		}
		
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=courses&page=add_class_code','Record Updated Successfuly','add');	
		}
		
		public function ViewAllClasses() {
		$query = mysql_query("SELECT * FROM `class_code`") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)) {
		echo "<option value='$row[ccid]'>$row[class_name]</option>";
		}	
		}
		
		
		
		public function ViewAllClasses_fee() {
		$query = mysql_query("SELECT cc.`class_name`,cc.`ccid` FROM `class_code` AS cc
                              WHERE UCASE(cc.`status`) = UCASE('INCOMPLETE')") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)) {
		echo "<option value='$row[ccid]'>$row[class_name]</option>";
		}	
		}
		
		
	    public function ViewAllClasses_add() {
		$query = mysql_query("SELECT `ccid`,`class_name` FROM `class_code`
		WHERE `status`='Incomplete'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)) {
		echo "<option value='$row[ccid]'>$row[class_name]</option>";
		}	
		}
		
		
	   /* ************************************************ Student Course Detail ************************************************  */

		
		public function AddStCourseDetail($id) {
		extract($_POST);
		
		$mx_id = mysql_query("SELECT IFNULL(MAX(scd.`scd_id`),0)+1 AS scd_id FROM `student_course_detail` AS scd") or die(mysql_error());
	    $max_id = mysql_fetch_assoc($mx_id);
	    $mid = $max_id['scd_id'];
				
		$query = mysql_query("INSERT INTO `student_course_detail` SET `scd_id`='$mid',
		                                                              `student_id`='$student_id',
																	  `ccid`='$ccid',
																	  `scd_status`='Incomplete',
																	  `form_no` = '$form_no', 
																	  `reg_no` = '$reg_no',
																	  `total_fee` = '$total_fee',
																	  `discounted_fee` = '$dis_fee'") or die(mysql_error());
		
	if($paid_amt != '' || $paid_amt != NULL || $paid_amt != 0) { //start
		
		
	if($query) {		
    $max = mysql_query("SELECT CONCAT('INV-',LPAD(IFNULL(MAX(CONVERT(SUBSTRING_INDEX(l.`ledger_id`,'-',-1),UNSIGNED INTEGER)),0)+1,7,0)) 
	        		    AS num FROM `student_ledger` AS l") or die(mysql_error());
    $mx = mysql_fetch_array($max);
	$inv = $mx['num'];
		
	$sql = mysql_query("INSERT INTO `student_ledger` (`ledger_id`,`scd_id`,`paid_amt`,`payment_date`,`payment_type`)
                        VALUE ('$inv','$mid','$dis_fee','$payment_date','T')") or die(mysql_error());	
	
	if($paid_amt != NULL || $paid_amt != '') {	
				
	$sql2 = mysql_query("INSERT INTO `student_ledger` (`ledger_id`,`scd_id`,`paid_amt`,`payment_date`,`payment_type`)
                        VALUE ('$inv','$mid','$paid_amt','$payment_date','P')") or die(mysql_error());			
	}
	
	 $new_value = $dis_fee-$paid_amt;
	 $update = mysql_query("UPDATE `student_course_detail` AS scd SET `rem_fee`='$new_value' WHERE scd.`scd_id`= '$mid'") or die(mysql_error());
	
	}
			
	} else { // end
	
	$update = mysql_query("UPDATE `student_course_detail` AS scd SET `rem_fee`='$dis_fee' WHERE scd.`scd_id`= '$mid'") or die(mysql_error());
	
	}
	
	
	
}
		
		
		
		
		public function ViewStCourseDetail($id) {
		
		$query = "SELECT cc.`class_name`, scd.`scd_id`,scd.`form_no`,scd.`reg_no`,scd.`scd_status`,scd.`total_fee`,scd.`discounted_fee` 
		          FROM `student_course_detail` AS scd,`class_code` AS cc 
                  WHERE scd.`ccid`=cc.`ccid` AND scd.`student_id`='$id'";
		$result = mysql_query($query) or die(mysql_error());
		while($row=mysql_fetch_assoc($result)) {

        echo "<tr>";
	    echo "<td>$row[class_name]</td>";
		echo "<td>$row[total_fee]</td>";
		echo "<td>$row[discounted_fee]</td>";
		echo "<td>$row[form_no]</td>";
		echo "<td>$row[reg_no]</td>";
		echo "<td>$row[scd_status]</td>";
        echo "<td align='left'><a class='btn btn-warning' data-toggle='modal' onClick='editscd($row[scd_id])' href='#myModaledit'>Edit</a></td>";
//echo "<td align='left'><a class='btn btn-danger' data-toggle='modal' href='index.php?folder=courses&page=add_student_course_detail&dlt=$row[scd_id]'>Delete</a></td>";
		echo "</tr>";	
		}
	}
	
	public function DeleteCourseDetail($id) {
		$query = mysql_query("DELETE FROM `student_course_detail` WHERE `scd_id` = $id") or die(mysql_error());
		redirect('index.php?folder=courses&page=add_student_course_detail','Record has been deleted','delete');	
	}
	
	public function EditStCourseDetail($id) {
	extract($_POST);
	$query = "UPDATE `student_course_detail` SET `student_id`='$student_id',`ccid`='$ccid',`scd_status`='$status' WHERE `scd_id`=$id";
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=courses&page=add_student_course_detail','Record Updated Successfuly','add');
	}
	
	
	public function EditSCD($id) {
    extract($_POST);
	$query = "UPDATE `student_course_detail` SET `form_no` = '$form_no', 
                                                 `reg_no` = '$reg_no',
												 `discounted_fee` = '$dis_fee' WHERE `scd_id`=$id";
	$result = mysql_query($query) or die(mysql_error());
	//redirect('index.php?folder=courses&page=add_student_course_detail&std=ITALR1','Record Updated Successfuly','add');
	}
	
	
	
	                   /////////////////////////////// LEDGER / PAYMENT ///////////////////////////////////////
					   
					   
					   
	public function AddLedger() {
	extract($_POST);
	
	$new_query = mysql_query("SELECT scd.`discounted_fee`,scd.`rem_fee` FROM `student_course_detail` AS scd 
							  WHERE scd.`ccid`='$ccid'
							  AND scd.`scd_id`='$scd_id'") or die(mysql_error());
	
	$fetch = mysql_fetch_array($new_query);
	$dis_amt = $fetch['discounted_fee'];
	$rem_amt = $fetch['rem_fee'];
	
	
	if($dis_amt == $rem_amt) {
		
	$max = mysql_query("SELECT CONCAT('INV-',LPAD(IFNULL(MAX(CONVERT(SUBSTRING_INDEX(l.`ledger_id`,'-',-1),UNSIGNED INTEGER)),0)+1,7,0)) AS num 
FROM `student_ledger` AS l") or die(mysql_error());
    $mx = mysql_fetch_array($max);
	$inv = $mx['num'];
		
	$sql = mysql_query("INSERT INTO `student_ledger` (`ledger_id`,`scd_id`,`paid_amt`,`payment_date`,`payment_type`)
                        VALUE ('$inv','$scd_id','$dis_amt','$payment_date','T')") or die(mysql_error());	
						
	$sql3 = mysql_query("INSERT INTO `student_ledger` (`ledger_id`,`scd_id`,`paid_amt`,`payment_date`,`payment_type`)
                        VALUE ('$inv','$scd_id','$paid_amt','$payment_date','P')") or die(mysql_error());
	
	if($sql) {
		$new_value = $rem_amount-$paid_amt;
		$update = mysql_query("UPDATE `student_course_detail` AS scd SET `rem_fee`='$new_value' WHERE scd.`scd_id`= '$scd_id'") or die(mysql_error());	
	}
	
		
	} else {
		
	$max = mysql_query("SELECT CONCAT('INV-',LPAD(IFNULL(MAX(CONVERT(SUBSTRING_INDEX(l.`ledger_id`,'-',-1),UNSIGNED INTEGER)),0)+1,7,0)) AS num 
FROM `student_ledger` AS l") or die(mysql_error());
    $mx = mysql_fetch_array($max);
	$inv = $mx['num'];
		
	$sql = mysql_query("INSERT INTO `student_ledger` (`ledger_id`,`scd_id`,`paid_amt`,`payment_date`,`payment_type`)
                        VALUE ('$inv','$scd_id','$paid_amt','$payment_date','P')") or die(mysql_error());	
	
	if($sql) {
		$new_value = $rem_amount-$paid_amt;
		
		$update = mysql_query("UPDATE `student_course_detail` AS scd SET `rem_fee`='$new_value' WHERE scd.`scd_id`= '$scd_id'") or die(mysql_error());	
	}	
	}
	
			redirect('index.php?folder=courses&page=add_ledger','Record Inserted Successfuly','add');

	}
	
	
	
	
	
	
	public function Pending_Fee() {
		
		$query = mysql_query("SELECT DISTINCT cc.`class_name`,cc.`ccid`
							,(SELECT COUNT(1) FROM `student_course_detail` AS ss WHERE ss.`ccid`=cc.`ccid` AND ss.`rem_fee`>0) AS tot_std
							,(SELECT SUM(`rem_fee`) FROM `student_course_detail` AS si WHERE si.`ccid`=cc.`ccid` AND si.`rem_fee`>0) AS tot_rem_fee
							FROM `class_code` AS cc,`student_course_detail` AS s
							WHERE cc.`ccid`=s.`ccid`
							AND s.`rem_fee`>0") or die(mysql_error());
		
	while($row=mysql_fetch_array($query)) {
		echo "<tr>";
		echo "<td>$row[class_name]</td>";
		echo "<td>$row[tot_std]</td>";
		echo "<td>$row[tot_rem_fee]</td>";
 echo "<td align='right'><a class='btn btn-success' data-toggle='modal' href='index.php?folder=courses&page=pending_fee&ccid=$row[ccid]&cn=$row[class_name]'>Balance List</a></td>";
		echo "</tr>";		
	}
	}
	
	
	public function Pending_Fee_List($ccid) {
		$sql = mysql_query("SELECT si.`student_id`,si.`student_name`,si.`student_fname`,s.`rem_fee`
								FROM `student_course_detail` AS s,`student_info` AS si
								WHERE si.`student_id`=s.`student_id`
								AND s.`ccid`=$ccid
								AND s.rem_fee>0") or die(mysql_error());
								
	  while($row=mysql_fetch_array($sql)) {
		$sum += $row['rem_fee'];
		echo "<tr style='height:30px'>";
		echo "<td>$row[student_id]</td>";
		echo "<td>$row[student_name]</td>";
		echo "<td>$row[student_fname]</td>";
		echo "<td>$row[rem_fee]</td>";
		echo "</tr>";		
      }
	   
	   echo "<tr>
	             <td colspan='3'> </td>
				 <td> <b>Total Amount:</b> &nbsp; $sum </td>
		     </tr>";
		
	}
	
	
	public function time_table($id) {
	 
	 
	  $query = mysql_query("SELECT  c.`class_name`,r.`room_name`,c.`class_time`,c.`class_etime`
							FROM `class_code` AS c,`rooms` AS r
							WHERE c.`room_id`=r.`room_id`
							AND c.`emp_id`=$id") or die(mysql_error());
	
	  while($row=mysql_fetch_assoc($query)) {
		  
		  echo "<tr>";
		  echo "<td>$row[class_name]</td>";
		  echo "<td>$row[room_name]</td>";
		  echo "<td>$row[class_time]</td>";
		  echo "<td>$row[class_etime]</td>";
		  echo "</tr>";
		  
	  }		
	}
	
	
	
	
	
	
		
	   
}	
		
$courses = new Courses();


?>
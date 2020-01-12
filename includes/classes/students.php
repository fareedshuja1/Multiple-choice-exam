<?php
ob_start();

  ini_set('memory_limit', '512M');
  ini_set('gd.jpeg_ignore_warning', 1);
  
class Students extends config {
		
		public function ViewAllStudents() {
		
		$query = "SELECT * FROM `student_info` AS si LEFT JOIN `nationality` AS n ON si.`nat_id`=n.`nat_id` LEFT JOIN `religion` AS r ON si.`rel_id` = r.`rel_id`";
		$result = mysql_query($query);
		
		while($row=mysql_fetch_assoc($result)) {
		
		echo "<tr>";
		
		if($row['student_image'] != '') {
		echo "<td>
		<a class='fancybox-effects-d' href='img/students/$row[student_image]'>
		<img src='img/students/thumbs/$row[student_image]' height='35px' width='50px' /></a>
		</td>";
		} else {
		echo "<td>
		<a class='fancybox-effects-d' href='no_pic.jpg'>
		<img src='no_pic.jpg' height='35px' width='50px' /></a>
		</td>";	
		}
		
		echo "<td>$row[student_id]</td>";
        echo "<td>$row[student_name]</td>";
        echo "<td>$row[student_fname]</td>";
		echo "<td>$row[student_nic]</td>";
		echo "<td>$row[student_cell]</td>";
		
        echo "<td align='left'>
		<a class='btn btn-warning' data-toggle='modal' style='font-size: 11px' href='index.php?folder=courses&page=add_student_course_detail&std=$row[student_id]'> Add Course</a></td>";
		
		echo "<td align='left'>
		<a class='btn btn-warning' data-toggle='modal' style='font-size: 11px' href='index.php?folder=academics&page=add_academic&std=$row[student_id]'> Add Academic</a></td>";
		
echo "<td align='left'>
	  <a class='btn btn-success' style='font-size: 11px' data-toggle='modal' href='index.php?folder=students&page=view_students&rpass=$row[student_id]'>Reset Password</a></td>";
		
		
		echo "<td align='left'>
		<a class='btn btn-success' style='font-size: 11px' data-toggle='modal' href='index.php?folder=students&page=student_detail&std=$row[student_id]'>Details</a></td>";

echo "<td align='left'>
      <a class='btn btn-danger' data-toggle='modal' style='font-size: 11px' 
	  onClick='editstd(\"$row[student_id]\")' href='#myModaledit'>Edit</a>
	  </td>";


		echo "</tr>";	
		
		}
			
	}
	
	
	public function ResetPassword($std_id) {
	$password = md5($std_id);	
	mysql_query("UPDATE `student_info` SET `student_password` = '$password' WHERE `student_id` = '$std_id'") or die(mysql_error());	
	redirect('index.php?folder=students&page=view_students','Student\'s Password has been set. ','add');
	}
	
	

/************************************************************************************************************ */

	
       public function AddStudent() {

		extract($_POST);

		$name = ucwords($_POST['name']);
		$fname = ucwords($_POST['fname']);
		$address = ucwords($_POST['address']);
		$image =$_FILES["upload"]["name"];

        $uploadedfile =$_FILES["upload"]['tmp_name'];
        if ($image) 
        {
        $filename = stripslashes($_FILES["upload"]['name']);
        $extension = strstr($filename,".");
        $extension = strtolower($extension);

        if($extension==".jpg" || $extension==".jpeg" || $extension == ".JPG" )
        {
        $uploadedfile = $_FILES["upload"]['tmp_name'];
        $src = imagecreatefromjpeg($uploadedfile);
        }
        else if($extension==".png" || $extension == ".PNG")
        {
        $uploadedfile = $_FILES["upload"]['tmp_name'];
        $src = imagecreatefrompng($uploadedfile);
        }
        else 
        {
        $src = imagecreatefromgif($uploadedfile);
        }
      
        list($width,$height)=getimagesize($uploadedfile);
		
        $newwidth=700;
        $newheight=($height/$width)*$newwidth;
        $tmp=imagecreatetruecolor($newwidth,$newheight);
		
		$newwidth2=50;
        $newheight2=($height/$width)*$newwidth2;
        $tmp2=imagecreatetruecolor($newwidth2,$newheight2);
		
	    $whiteBackground = imagecolorallocate($tmp, 255, 255, 255); 
        imagefill($tmp,0,0,$whiteBackground);
		
		$whiteBackground2 = imagecolorallocate($tmp2, 255, 255, 255); 
        imagefill($tmp2,0,0,$whiteBackground2);
		
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2, $width,$height);

        $filename = "img/students/". $_FILES["upload"]['name'];
	    $filename2 = "img/students/thumbs/". $_FILES["upload"]['name']; 

        imagejpeg($tmp,$filename,500);
		imagejpeg($tmp2,$filename2,60);

        imagedestroy($src);
        imagedestroy($tmp);
        }
		

$q = mysql_query("SELECT IFNULL(MAX(CONVERT(SUBSTRING_INDEX(si.`student_id`,'ITALR', -1), SIGNED INTEGER)),0)+1 AS student_id FROM student_info AS si") or die(mysql_error());
      $r = mysql_fetch_assoc($q);
      $var = $r['student_id'];
	  $v = 'ITALR'.$var;
	  $password = md5($v);	
	  $date = date("Y-m-d");
	  
	 if(isset($_POST['chknat'])) { 
	 if($chknat == 'PAKISTANI' || $chknat == 'PAKISTAN') {
	 $scnic = $std_nic;
	 $fcnic = $std_fnic;
	 } else {
	 $scnic = $astd_nic;
	 $fcnic = $astd_fnic; 
	 }
	 }
	  
	  $sname = ucfirst($name);
	  $sfname = ucfirst($fname);
	  $dob = $syear."-".$smonth."-".$sday;
	  
	  $query = "INSERT INTO `student_info` SET  `student_name` = '$sname', 
		                                        `student_id` = '$v',
                             				    `student_fname` = '$sfname',
                                                `student_dob` = '$dob', 
                                                `student_gender` = '$gender',
                                                `nat_id` = '$nationality',
                                                `rel_id` = '$religion',
                                                `student_nic` = '$scnic',
                                                `student_fnic` = '$fcnic', 
                                                `student_phone` = '$std_phone', 
                                                `student_cell` = '$std_cell', 
                                                `student_email` = '$std_email',
                                                `emergency_phone` = '$em_phone', 
                                                `emergency_cell` = '$em_cell',
                                                `emergency_email` = '$em_email', 
                                                `student_address` = '$address',
									    		`student_password` = '$password',
                                                `created_date` = '$date', 
                                                `student_image` = '$image'";
				
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=students&page=view_students','Record has been saved in Database','add');
       
	   } 
	   
	
/* *********************************************************************************************************** */
	
		public function AllNationality() {
		$query = "SELECT * FROM `nationality`";
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
        echo "<option value='$row[nat_id]'>$row[nat_title]</option>";
		}
  }
  
  		public function AllReligion() {
		$query = "SELECT * FROM `religion`";
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
        echo "<option value='$row[rel_id]'>$row[rel_title]</option>";
		}
  }
  
  
      
		public function AllStudents() {
		$query = "SELECT * FROM `student_info`";
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
        echo "<option value='$row[student_id]'>$row[student_name]</option>";
		}
  }
  
  	 
	 public function EditStudentInfo($id) {
		 
		extract($_POST);
		$name = ucwords($_POST['name']);
		$fname = ucwords($_POST['fname']);
		$address = ucwords($_POST['address']);
		$image =$_FILES["upload"]["name"];

        $uploadedfile =$_FILES["upload"]['tmp_name'];
        if ($image) 
        {
        $filename = stripslashes($_FILES["upload"]['name']);
        $extension = strstr($filename,".");
        $extension = strtolower($extension);

        if($extension==".jpg" || $extension==".jpeg" || $extension == ".JPG" )
        {
        $uploadedfile = $_FILES["upload"]['tmp_name'];
        $src = imagecreatefromjpeg($uploadedfile);
        }
        else if($extension==".png" || $extension == ".PNG")
        {
        $uploadedfile = $_FILES["upload"]['tmp_name'];
        $src = imagecreatefrompng($uploadedfile);
        }
        else 
        {
        $src = imagecreatefromgif($uploadedfile);
        }
      
        list($width,$height)=getimagesize($uploadedfile);
		
        $newwidth=700;
        $newheight=($height/$width)*$newwidth;
        $tmp=imagecreatetruecolor($newwidth,$newheight);
		
		$newwidth2=50;
        $newheight2=($height/$width)*$newwidth2;
        $tmp2=imagecreatetruecolor($newwidth2,$newheight2);
		
	    $whiteBackground = imagecolorallocate($tmp, 255, 255, 255); 
        imagefill($tmp,0,0,$whiteBackground);
		
		$whiteBackground2 = imagecolorallocate($tmp2, 255, 255, 255); 
        imagefill($tmp2,0,0,$whiteBackground2);
		
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2, $width,$height);

        $filename = "img/students/". $_FILES["upload"]['name'];
	    $filename2 = "img/students/thumbs/". $_FILES["upload"]['name']; 

        imagejpeg($tmp,$filename,500);
		imagejpeg($tmp2,$filename2,60);

        imagedestroy($src);
        imagedestroy($tmp);
    
        }
		if($image != '') {
		$query = mysql_query("UPDATE `student_info` SET  `student_name` = '$name', 
														 `student_fname` = '$fname',
														 `student_dob` = '$dob', 
														 `student_gender` = '$gender',
														 `nat_id` = '$nationality',
														 `rel_id` = '$religion',
														 `student_nic` = '$std_nic',
														 `student_fnic` = '$std_fnic', 
														 `student_phone` = '$std_phone', 
														 `student_cell` = '$std_cell', 
														 `student_email` = '$std_email',
														 `emergency_phone` = '$em_phone', 
														 `emergency_cell` = '$em_cell',
														 `emergency_email` = '$em_email', 
														 `student_address` = '$address',
                                                         `student_image` = '$image' 
														  WHERE `student_id`='$id'") or die(mysql_error());
		} else {
		$query = mysql_query("UPDATE `student_info` SET  `student_name` = '$name', 
														 `student_fname` = '$fname',
														 `student_dob` = '$dob', 
														 `student_gender` = '$gender',
														 `nat_id` = '$nationality',
														 `rel_id` = '$religion',
														 `student_nic` = '$std_nic',
														 `student_fnic` = '$std_fnic', 
														 `student_phone` = '$std_phone', 
														 `student_cell` = '$std_cell', 
														 `student_email` = '$std_email',
														 `emergency_phone` = '$em_phone', 
														 `emergency_cell` = '$em_cell',
														 `emergency_email` = '$em_email', 
														 `student_address` = '$address'
                                                          WHERE `student_id`='$id'") or die(mysql_error());	
		}
		
		redirect('index.php?folder=students&page=view_students','Record has been saved in Database','add');

	 }

     /* *********************************************************************************************************** */

     public function AddAcademicRecord() {
		 
		 extract($_POST);
		 
		 $exam_pass = $_POST['exam_pass'];
		 $board = $_POST['board'];
		 
		 $query = "INSERT INTO `student_academic_record` SET `student_id` = '$student_id', 
		                                                     `exam_passed` = '$exam_pass',
															 `board` = '$board',
															 `year` = '$year',
															 `grade` = '$grades', 
															 `division` = '$division', 
															 `percantage` = '$per'";
		
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=academics&page=add_academic','Record has been saved in Database','add');
		 
	 }
	
	 
	 /* *********************************************************************************************************** */
     
	 
	public function ViewAcademicRecords() {
	$query = "SELECT * FROM `student_academic_record` AS sar, `student_info` AS si WHERE si.`student_id` = sar.`student_id`";
	$result = mysql_query($query);
		
	while($row=mysql_fetch_assoc($result)) {
		
	echo "<tr>";		
	echo "<td><a class='fancybox-effects-d' href='img/students/$row[student_image]'>
		      <img src='img/students/thumbs/$row[student_image]' height='35px' width='50px' /></a>
		  </td>";
	echo "<td>$row[student_id]</td>";
	echo "<td>$row[student_name]</td>";
	echo "<td>$row[exam_passed]</td>";
    echo "<td>$row[board]</td>";
    echo "<td>$row[year]</td>";
	echo "<td>$row[grade]</td>";
	echo "<td>$row[division]</td>";
	echo "<td>$row[percantage]</td>";
	echo "</tr>";	
		
		} 
		 
	 }

	public function ViewAcademicRecords_add($id) {
	$query = "SELECT * FROM `student_academic_record` AS sar, `student_info` AS si WHERE si.`student_id` = sar.`student_id`
	          AND si.`student_id` = '$id'";
	$result = mysql_query($query);
		
	while($row=mysql_fetch_assoc($result)) {
		
	echo "<tr>";		
	echo "<td><a class='fancybox-effects-d' href='img/students/$row[student_image]'>
		      <img src='img/students/thumbs/$row[student_image]' height='35px' width='50px' /></a>
		  </td>";
	echo "<td>$row[student_id]</td>";
	echo "<td>$row[student_name]</td>";
	echo "<td>$row[exam_passed]</td>";
    echo "<td>$row[board]</td>";
    echo "<td>$row[year]</td>";
	echo "<td>$row[grade]</td>";
	echo "<td>$row[division]</td>";
	echo "<td>$row[percantage]</td>";
	echo "</tr>";	
		
		} 
	 }
	 
	 
	 /********************************** ===================  STUDENTS ===================**********************************/
	 
	 
	 public function ViewStdClasses($id) {
		 
		$sql = mysql_query("SELECT mc.`mc_title`,mc.`mcid`,sc.`sc_title`,sc.`scid`,cc.`class_name`,cc.`ccid`,scd.`scd_status`,scd.`scd_id`
                            FROM `student_course_detail` AS scd,`class_code` AS cc,`sub_courses` AS sc,`main_courses` AS mc
                            WHERE scd.`ccid`=cc.`ccid` AND cc.`scid`=sc.`scid` AND sc.`mcid`=mc.`mcid` AND scd.`student_id`='$id'") or die(mysql_error());
		while($row = mysql_fetch_assoc($sql)) { 
		echo "<tr>
             <td>$row[mc_title]  /  $row[sc_title]</td>
             <td>$row[class_name]</td>
			 <td>$row[scd_status]</td>
			 <td><a class='btn btn-success' data-toggle='modal' onClick='getstdcrs($row[ccid])' style='font-size: 10px'>RESULT</a></td>
	         <td><a class='btn btn-success' data-toggle='modal' onClick='getschcrs($row[ccid])' style='font-size: 10px'>EXAM SCHEDULE</a></td>
			 <td><a class='btn btn-success' data-toggle='modal' onClick='getledger($row[ccid],$row[scd_id])' style='font-size: 10px'>LEDGER</a></td>
             </tr>";
	 }
	 }

}	
		
$students = new Students();


?>
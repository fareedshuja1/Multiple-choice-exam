<?php
ob_start();

class Employees extends config {
		
       public function AddEmployee() {
		
		extract($_POST);

		$name = ucwords($_POST['name']);
		$fname = ucwords($_POST['fname']);
		$address = ucwords($_POST['address']);
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		
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

        $filename = "img/employees/". $_FILES["upload"]['name'];
	    $filename2 = "img/employees/thumbs/". $_FILES["upload"]['name']; 

        imagejpeg($tmp,$filename,500);
		imagejpeg($tmp2,$filename2,60);

        imagedestroy($src);
        imagedestroy($tmp);
    
        }
		
		$mx_id = mysql_query("SELECT IFNULL(MAX(emp.`emp_id`),0)+1 AS emp_id FROM `employees` AS emp") or die(mysql_error());
	    $max_id = mysql_fetch_assoc($mx_id);
	    $mid = $max_id['emp_id'];
		
		$query = mysql_query("INSERT INTO `employees` SET `emp_id` = '$mid',
														  `emp_name` = '$name', 
														  `emp_fname` = '$fname', 
														  `emp_contact` = '$contact', 
														  `emp_address` = '$address', 
														  `emp_pic` = '$image', 
														  `emp_email` = '$email',
														  `emp_type` = '$emp_type',
														  `sal_amount` = '$sell_amount'") or die(mysql_error());
		
		
		redirect('index.php?folder=employees&page=add_employees','Record is Saved in Database','add');
}


/* *********************************************************************************************************** */

		public function ViewAllEmployees() {
		
		$query = "SELECT * FROM `employees`";
		$result = mysql_query($query);
		
		while($row=mysql_fetch_assoc($result)) {
		
		echo "<tr>";
		
		if($row['emp_pic'] !== '') {
		echo "<td>
		<a class='fancybox-effects-d' href='img/employees/$row[emp_pic]'>
		<img src='img/employees/thumbs/$row[emp_pic]' height='35px' width='50px' /></a>
		</td>";
		} else {
		echo "<td>
		<a class='fancybox-effects-d' href='no_pic.jpg'>
		<img src='no_pic.jpg' height='35px' width='50px' /></a>
		</td>";	
		}
		
		echo "<td>$row[emp_name]</td>";
        echo "<td>$row[emp_fname]</td>";
        echo "<td>$row[emp_contact]</td>";
		echo "<td>$row[emp_email]</td>";
		
		if($row['emp_type'] == 'F') {  echo "<td>Fixed Paid</td>"; } else { echo "<td>Hourly Paid</td>"; }
		
		echo "<td>$row[sal_amount]</td>";
		echo "<td><a class='btn btn-success' data-toggle='modal' onClick='editemp($row[emp_id])' href='#myModaledit'>Edit</a></td>";
		
		if($row['emp_type'] == 'F') {
echo "<td><a class='btn btn-info' data-toggle='modal' href='index.php?folder=employees&page=allow_detail&emp_id=$row[emp_id]'>Detail</a></td>";	
		} else {
echo "<td><a class='btn btn-info' data-toggle='modal' href='index.php?folder=employees&page=hourly_allow&emp_id=$row[emp_id]'>Detail</a></td>";	
		}
		
				
		if($row['emp_type'] == 'F') {
		echo "<td><a class='btn btn-warning' data-toggle='modal' onClick='make_allow($row[emp_id])' href='#myModaledit2'>Allowance</a></td>";	
		} else {
		echo "<td>&nbsp;</td>";
		}
		
		echo "</tr>";	
		
		}
			
	}
	
	
/* *********************************************************************************************************** */
	
		public function AllEmployess() {
		$query = "SELECT * FROM `employees`";
		$result = mysql_query($query);
		
		while($row=mysql_fetch_assoc($result)) {
        echo "<option value='$row[emp_id]'>$row[emp_name]</option>";
		}
  }
  
  		public function AllEmployess_add() {
		$query = "SELECT e.`emp_name`,e.`emp_id`
		FROM `employees` AS e WHERE e.`emp_id` 
		NOT IN (SELECT l.`emp_id` FROM login AS l)";
		$result = mysql_query($query);
		
		while($row=mysql_fetch_assoc($result)) {
        echo "<option value='$row[emp_id]'>$row[emp_name]</option>";
		}
  }

/* *********************************************************************************************************** */
        
		public function EditEmployee($id) {
		extract($_POST);
			
		$name = ucwords($_POST['name']);
		$fname = ucwords($_POST['fname']);
		$address = ucwords($_POST['address']);
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		
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

        $filename = "img/employees/". $_FILES["upload"]['name'];
	    $filename2 = "img/employees/thumbs/". $_FILES["upload"]['name']; 

        imagejpeg($tmp,$filename,500);
		imagejpeg($tmp2,$filename2,60);

        imagedestroy($src);
        imagedestroy($tmp);
    
        }
		
		if($image != '') {			
		$query = "UPDATE `employees` SET `emp_name` = '$name', 
		                                 `emp_fname` = '$fname', 
							             `emp_contact` = '$contact', 
							             `emp_address` = '$address', 
					                     `emp_pic` = '$image', 
					                     `emp_email` = '$email',
										 `emp_type` = '$emp_type',
										 `sal_amount` = '$sell_amount'
										  WHERE `emp_id` = '$id'";
		} else {
		$query = "UPDATE `employees` SET `emp_name` = '$name', 
		                                 `emp_fname` = '$fname', 
							             `emp_contact` = '$contact', 
							             `emp_address` = '$address', 
					                     `emp_email` = '$email',
										 `emp_type` = '$emp_type',
										 `sal_amount` = '$sell_amount'
										  WHERE `emp_id` = '$id'";	
			
		}
		
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=employees&page=view_employees','Record has been updated','add');

		}
		
		
		public function EditEmployee2($id) {
		extract($_POST);
		$query = mysql_query("UPDATE `employees` SET  `emp_type` = '$emp_type',
										  `sal_amount` = '$sell_amount'
										   WHERE `emp_id` = '$id'") or die(mysql_error());	
			
		}
		
		
		
public function ComingExamDates() {
		
		$sql = mysql_query("SELECT sc.`sc_title`,cc.`class_name`,c.`cat_name`,em.`exam_date`
							,CONCAT(DATEDIFF(em.`exam_date`,NOW())
							,CASE WHEN DATEDIFF(em.`exam_date`,NOW()) IN (1,0) THEN
							' Day'
							WHEN DATEDIFF(em.`exam_date`,NOW())> 1 THEN
							' Days'
							END) AS remaing_days,
							DATE_FORMAT(em.`e_start_time`,'%l:%i %p') AS e_start_time FROM `exam_master` AS em,`category` AS
							c,`class_code` AS cc,`sub_courses` AS sc WHERE em.`cat_id`=c.`cat_id`
							AND em.`ccid`=cc.`ccid` AND cc.`scid`=sc.`scid` AND em.`exam_date` >= DATE_FORMAT(NOW(),'%Y-%m-%d') 
							AND em.`exam_date` <= DATE_ADD(DATE_FORMAT(NOW(),'%Y-%m-%d'), INTERVAL 7 DAY)") or die(mysql_error());	
							
	    $Date = date("Y-m-d");
		
		while($row=mysql_fetch_assoc($sql)) {
						
	    if($row['exam_date'] ==  $Date) {
			  $image = "<img src='red.gif' />";
		} else {
			  $image = "<img src='green.gif' /> ";
		} 
		
		$EndDate = $row['exam_date'];	
        $newDate2 = date("d-m-Y", strtotime($EndDate));
			
		echo "<tr style='font-size: 14px'>";
		echo "<td>$row[sc_title]</td>";
        echo "<td>$row[class_name]</td>";
        echo "<td>$row[cat_name]</td>";
		echo "<td>$newDate2</td>";
        echo "<td>$row[e_start_time]</td>";
		echo "<td>$row[remaing_days]</td>";
		echo "<td>$image</td>";
		echo "</tr>";	
		}
  }
  
  
  
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  public function AllowanceDetail($emp_id) {
	      $query = mysql_query("SELECT ea.`emp_id`,a.`allow_name`,ea.`amount`,DATE_FORMAT(ea.`start_date`,'%d-%m-%Y') AS start_date
								,DATE_FORMAT(ea.`end_date`,'%d-%m-%Y') AS end_date,ea.`remarks`
								FROM `employees_allowance` AS ea,`allowance` AS a
								WHERE ea.`allow_id`=a.`allow_id`
								AND ea.`emp_id`=$emp_id") or die(mysql_error());
								
		  $bsalary = mysql_query("SELECT e.`sal_amount` FROM `employees` AS e WHERE e.`emp_id`=$emp_id") or die(mysql_error());
		  $bs = mysql_fetch_assoc($bsalary);
		  $basic_salary = $bs['sal_amount'];
		  
		  $totall = mysql_query("SELECT SUM(ea.`amount`) AS tot_all
								FROM `employees_allowance` AS ea,`allowance` AS a
								WHERE ea.`allow_id`=a.`allow_id`
								AND (ea.`end_date`>=CURDATE()
								OR ea.`end_date` IS NULL)
								AND ea.`emp_id`=$emp_id") or die(mysql_error());
		  $ta = mysql_fetch_assoc($totall);
		  $tot_all = $ta['tot_all'];
		  $gsal= $basic_salary+$tot_all;
		
		 while($row=mysql_fetch_assoc($query)) {
			 
			 //$sdate = date('d-m-Y',strtotime($row['start_date']));
			 //$edate = date('d-m-Y',strtotime($row['end_date']));
			 
			 echo "<tr>";
			 echo "<td>$row[allow_name]</td>";
			 echo "<td>$row[amount]</td>";
			// echo "<td>$sdate</td>";
			 echo "<td>$row[start_date]</td>";
			// echo "<td>$edate</td>";
			echo "<td>$row[end_date]</td>";
			 echo "<td>$row[remarks]</td>";
			 echo "<td>&nbsp;</td>";
			 echo "</tr>";
		 }
		 
		 echo "<tr><td colspan='6'>&nbsp;</td></tr>";
		 
		 echo "<tr>";
		 echo "<td><b>BASIC SALARY: </b></td>";
	     echo "<td>PKR : $basic_salary /- </td>";
		 echo "<td><b>Allowance/Increament: </b></td>";
		 echo "<td>PKR : $tot_all /-</td>";
		 echo "<td> <b>SUM AMOUNT &nbsp; &nbsp; = </b> </td>";
		 echo "<td>PKR : $gsal /-</td>";
  }
  
  
  
         public function HourlyAllowanceDetail($emp_id) {
	  
	         $query = mysql_query("SELECT c.`emp_id`,c.`ccid`,c.`class_name` 
								,(SELECT COUNT(s.`scd_id`) FROM `student_course_detail` AS s
								WHERE s.`ccid`=c.`ccid`) AS tot_students
								,IFNULL((SELECT SUM(s.`discounted_fee`) FROM `student_course_detail` AS s
								WHERE s.`ccid`=c.`ccid`),'No Students in this Class') AS total_fee
								,(SELECT e.`sal_amount` FROM `employees` AS e WHERE  e.`emp_id`=c.`emp_id`
								) AS per_age
								,
								IFNULL(ROUND((SELECT e.`sal_amount` FROM `employees` AS e WHERE  e.`emp_id`=c.`emp_id`
								) * (SELECT SUM(s.`discounted_fee`) FROM `student_course_detail` AS s
								WHERE s.`ccid`=c.`ccid`)/100,2),0) AS Teacher_pay
								
								FROM `class_code` AS c
								WHERE c.`emp_id`=$emp_id
								GROUP BY c.`emp_id`,c.`ccid`,c.`class_name`") or die(mysql_error());
		  
		  while($fetch=mysql_fetch_assoc($query)) {
			  
			  echo "<tr>";
			  echo "<td>$fetch[class_name]</td>";
			  echo "<td>$fetch[tot_students]</td>";
			  echo "<td>$fetch[total_fee]</td>";
			  echo "<td>$fetch[per_age]</td>";
			  echo "<td>$fetch[Teacher_pay]</td>";
			  echo "<td>&nbsp;</td>";
			  echo "</tr>";			  
		  }
	  
  }
		



}	
		
$employees = new Employees();


?>
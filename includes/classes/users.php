<?php
ob_start();
class User extends config {
		
		
		public function Chk_Login($username=NULL,$password=NULL) {
		
		$sql = mysql_query("SELECT COUNT(1) AS `num` FROM `login` WHERE `username` = '$username'") or die(mysql_error());
		$num = mysql_fetch_assoc($sql);
		$count = $num['num'];
		
		if($count > 0) {
			
		if($count == 1) {
		$this->Login($username,$password);
		} 
		 
		} else {
		$this->Chk_Login_Std($username,$password);
		 }
    }
	
	
	  public function Chk_Login_Std($username=NULL,$password=NULL) {
		
		$sql = mysql_query("SELECT COUNT(1) AS `num` FROM `student_info` WHERE `student_id` = '$username'") or die(mysql_error());
		$num = mysql_fetch_assoc($sql);
		$count = $num['num'];
		
		if($count == 1) {
			$this->login_student($username,$password);
		} else {
			
			redirect('login.php','Login Failed. Username does not exist','delete');
		}
	 }
		
		
		
		public function Login($username=NULL,$password=NULL) {
        $pass = md5($password);
$query = "SELECT * FROM login as l LEFT JOIN um_group AS g ON (l.group_id = g.group_id) LEFT JOIN `employees` AS e ON (e.`emp_id`=l.`emp_id`) WHERE l.username = '$username' AND l.password = '$pass' AND l.is_active = '1'";
		
		$res= mysql_query($query);
		$count=mysql_num_rows($res);
		if($count>0)
		{
		$row = mysql_fetch_assoc($res);
		
		$_SESSION['username']    = $row['username'];
		$_SESSION['emp_id']      = $row['emp_id'];
		$_SESSION['group_id']    = $row['group_id'];
		$_SESSION['group_name']  = $row['group_name'];
		$_SESSION['emp_name']    = $row['emp_name'];
		$_SESSION['emp_fname']   = $row['emp_fname'];
		$_SESSION['emp_contact'] = $row['emp_contact'];
		$_SESSION['emp_email']   = $row['emp_email'];
		$_SESSION['emp_address'] = $row['emp_address'];
		$_SESSION['emp_pic']     = $row['emp_pic'];
		
		redirect_to("index.php");

	} else
	{
	  redirect('login.php','Login Failed. Password is incorrect','delete');
	}
}


		public function login_student($username=NULL,$password=NULL) {
        
$query = mysql_query("SELECT * FROM `student_info` WHERE `student_id` = '$username' AND UCASE(`student_password`) = md5(UCASE('$password'))") or die(mysql_error());
		$count=mysql_num_rows($query);
		if($count>0)
		{
		$row = mysql_fetch_assoc($query);
		
		$_SESSION['student_id']       = $row['student_id'];
		$_SESSION['student_name']     = $row['student_name'];
		$_SESSION['student_fname']    = $row['student_fname'];
		$_SESSION['student_password'] = $row['student_password'];
		$_SESSION['student_image']    = $row['student_image'];
		
		redirect_to("index_std.php");

	} else
	{
	  redirect('login.php','Login Failed. Please use correct password','delete');
	}
}


/* *********************************************************************************************************** */

		public function AddUser() {
		
		extract($_POST);	
		$pass = md5($password);
		
		$sql = mysql_query("SELECT `username` FROM `login` WHERE `username`='$username'") or die (mysql_error());
		$total = mysql_num_rows($sql);			
		
		if($total<1) {
		$query = "INSERT INTO `login` (`username`,`emp_id`,`password`,`is_active`,`group_id`) VALUES ('$username','$emp_id','$pass','1','$group_id')";
		
		$result = mysql_query($query) or die(mysql_error());
		redirect('index.php?folder=users&page=add_user','User Added Successfully','add');
		} else {
		redirect('index.php?folder=users&page=add_user','Username already exists. Please try again','delete');
		}
       }

 
        public function UpdateUser() {
		extract($_POST);
		
		$name = ucwords($_POST['name']);
		$fname = ucwords($_POST['fname']);
		$username = $_POST['username'];
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		$emp_id = $_POST['emp_id'];
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

        $filename = "img/employees/". $_FILES["upload"]['name'];
	    $filename2 = "img/employees/thumbs/". $_FILES["upload"]['name']; 

        imagejpeg($tmp,$filename,500);
		imagejpeg($tmp2,$filename2,60);

        imagedestroy($src);
        imagedestroy($tmp);
    
        }
		
        
		if (isset($_FILES["upload"]["name"]) && $_FILES["upload"]["name"] != '') {
		$query = mysql_query("UPDATE `employees` SET `emp_name` = '$name', 
                                    			     `emp_fname`= '$fname',
                                         			 `emp_contact`= '$contact',
                                        			 `emp_address`= '$address',
													 `emp_pic`= '$image',
                                        			 `emp_email`= '$email' WHERE `emp_id`='$emp_id'") or die(mysql_error());
		} else {
		$query = mysql_query("UPDATE `employees` SET `emp_name` = '$name', 
                                    			     `emp_fname`= '$fname',
                                         			 `emp_contact`= '$contact',
                                        			 `emp_address`= '$address',
                                        			 `emp_email`= '$email' WHERE `emp_id`='$emp_id'") or die(mysql_error());
			
		}
		return $result;
		
}

        public function ChangePassword() {
		extract($_POST);
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$old_pass = md5($_POST['old_pass']);
		
		$query = mysql_query("SELECT * FROM `login` WHERE `username`='$username' AND `password`='$old_pass'") or die(mysql_error());
		$count = mysql_num_rows($query);
		
		if($count == 1) {	 
		$sql = mysql_query("UPDATE `login` SET `password` = '$password' WHERE `username` = '$username'") or die(mysql_error());
		redirect('index.php','Password has been changed. Please login again with your new password','add');

		} else {
		redirect('index.php','Password can not changed. Please enter valid old password','delete');

			
		}
	}
	
	
	    public function ChangePassword_Std() {
		extract($_POST);
		$username = $_POST['username'];
		$password = md5(strtoupper($_POST['password']));
		$old_pass = md5(strtoupper($_POST['old_pass']));
		
  $query = mysql_query("SELECT * FROM `student_info` WHERE `student_id`='$username' AND `student_password`='$old_pass'") or die(mysql_error());
  $count = mysql_num_rows($query);
		
		if($count == 1) {	 
		$sql = mysql_query("UPDATE `student_info` SET `student_password` = '$password' WHERE `student_id` = '$username'") or die(mysql_error());
		redirect('index_std.php','Password has been changed. Please login again with your new password','add');

		} else {
		redirect('index_std.php','Password can not changed. Please enter valid old password','delete');

			
		}
	}

/* *********************************************************************************************************** */

		public function ViewAllUsers() {
		
		$query = "SELECT * FROM login as l LEFT JOIN um_group AS g ON (l.group_id = g.group_id) LEFT JOIN `employees` AS e ON (e.`emp_id`=l.`emp_id`)";
		$result = mysql_query($query);
		
		while($row=mysql_fetch_assoc($result)) {
		
		echo "<tr>";
		echo "<td>$row[username]</td>";
        echo "<td>$row[emp_name]</td>";
		echo "<td>$row[group_name]</td>";
		
		if($row['is_active'] == 1) { echo "<td>Active</td>"; } else { echo "<td>Inactive</td>"; }
		
		echo "<td>$row[emp_fname]</td>";
		echo "<td>$row[emp_contact]</td>";
		echo "<td>$row[emp_email]</td>";
		
		echo "<td>
		      <a class='btn btn-success' data-toggle='modal' onClick='ChangeGroup(\"$row[username]\")' href='#myModal2'>Change Group</a>
		      </td>";
		
       if($row['is_active'] == 1) {
       echo "<td><a class='btn btn-danger' data-toggle='modal' onClick='Deactivate(\"$row[username]\")' href='#myModal2'>Deactivate</a></td>";
       } else {
       echo "<td><a class='btn btn-success' data-toggle='modal' onClick='Activate(\"$row[username]\")' href='#myModal2'>Activate</a></td>";
       }
        
		echo "</tr>";	
		
		}		
	}
	
	public function DeactivaeUser($id) {
	$query = mysql_query("UPDATE `login` SET `is_active` = 0 WHERE `username` = '$id'") or die(mysql_error());
	redirect('index.php?folder=users&page=add_user','User Account has been deactivated','delete');
	}
	
	public function ActivaeUser($id) {
	$query = mysql_query("UPDATE `login` SET `is_active` = 1 WHERE `username` = '$id'") or die(mysql_error());
	redirect('index.php?folder=users&page=add_user','User Account has been activated','add');
	}
	
	
    public function ChangeGroup($id) {
	extract($_POST);
	$query = mysql_query("UPDATE `login` SET `group_id` = $group_id WHERE `username` = '$id'") or die(mysql_error());
	redirect('index.php?folder=users&page=add_user','User Group has been changed','add');
	}
	
	
	/* *********************************************** Groups ********************************************** */

	
	public function AddGroup() {
	extract($_POST);
	$group_name = ucwords($_POST['group_name']);
					
	$sql = mysql_query("SELECT `group_name` FROM `um_group` WHERE `group_name`='$group_name'") or die (mysql_error());
	$total = mysql_num_rows($sql);				
	if($total<1) {	
	$query = "INSERT INTO `um_group` SET `group_name` = '$group_name'";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=users&page=add_group','Group Add Successfully','add');
	} else {		
	redirect('index.php?folder=users&page=add_group','Group name already exists.','delete');
	}
	}
	
	public function EditGroup($id) {
	extract($_POST);
	$group_name = ucwords($_POST['group_name']);
	$query = "UPDATE `um_group` SET `group_name` = '$group_name' WHERE `group_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=users&page=add_group','Group Updated Successfully','add');
	}
	
	public function DeleteGroup($id) {
	$query = "DELETE FROM `um_group` WHERE `group_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=users&page=add_group','Group Deleted','delete');
	}
	
		
	public function ViewAllGroups() {
	$sql = mysql_query("SELECT * FROM `um_group` WHERE `group_id` != 1") or die (mysql_error());
	while($row=mysql_fetch_assoc($sql)) {
		
		echo "<tr>";
		echo "<td>$row[group_id]</td>";
        echo "<td>$row[group_name]</td>";

		echo "<td align='left'>
<a class='btn btn-success' data-toggle='modal' href='index.php?folder=users&page=group_details&id=$row[group_id]'>Set Permissions</a></td>";
		
		echo "<td align='left'>
		      <a class='btn btn-warning' data-toggle='modal' onClick='editgroup($row[group_id])' href='#myModal'>Edit</a>
			  </td>";
			  
        echo "<td align='left'>
              <a class='btn btn-danger' data-toggle='modal' href='index.php?folder=users&page=add_group&dlt=$row[group_id]'>Delete</a>
		      </td>";

		echo "</tr>";	

	}
	}
	
	public function ViewGroups() {
	$sql = mysql_query("SELECT * FROM `um_group`") or die (mysql_error());
	while($row=mysql_fetch_assoc($sql)) {
	echo "<option value='$row[group_id]'>$row[group_name]</option>";
	}
	}
		
		
/* *********************************************************************************************************** */

}	
		
$user = new User();


?>
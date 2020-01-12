<?php
ob_start();
class General extends config {
		
    public function AddEType() {
	extract($_POST);
	$exam_name = ucwords($_POST['exam_name']);
					
	$query = "INSERT INTO `exam_type` SET `exam_name` = '$exam_name',`exam_status` = '$exam_status'";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_examtype','Exam Added Successfully','add');
	}
	
	public function EditEType($id) {
	extract($_POST);
	$exam_name = ucwords($_POST['exam_name']);
	$query = "UPDATE `exam_type` SET `exam_name` = '$exam_name',`exam_status` = '$exam_status' WHERE `exam_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_examtype','Exam Updated Successfully','add');
	}
	
	public function DeleteEType($id) {
	$query = "DELETE FROM `exam_type` WHERE `exam_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_examtype','Exam Deleted','delete');
	}
	
		
	public function ViewAllTypes() {
	$sql = mysql_query("SELECT * FROM `exam_type`") or die (mysql_error());
	while($row=mysql_fetch_assoc($sql)) {
		
		if($row['exam_status'] == 0) {
			$status = 'Inactive';
		} else {
		    $status = 'Active';
		}
		
		echo "<tr>";
		echo "<td>$row[exam_id]</td>";
        echo "<td>$row[exam_name]</td>";
		echo "<td>$status</td>";
		echo "<td align='left'>
		      <a class='btn btn-warning' data-toggle='modal' onClick='editetype($row[exam_id])' href='#myModal'>Edit</a>
			  </td>";
        echo "<td align='left'>
              <a class='btn btn-danger' data-toggle='modal' href='index.php?folder=generals&page=add_examtype&dlt=$row[exam_id]'>Delete</a>
		      </td>";

		echo "</tr>";	

	}
	}
	
	public function ViewETypes() {
	$sql = mysql_query("SELECT * FROM `exam_type`") or die (mysql_error());
	while($row=mysql_fetch_assoc($sql)) {
	echo "<option value='$row[exam_id]'>$row[exam_name]</option>";
	}
	}
	
	
	// ********************************************************************************************** //

    public function AddCategory() {
	extract($_POST);
	$cat_name = ucwords($_POST['cat_name']);
					
	$query = "INSERT INTO `category` SET `cat_name` = '$cat_name',`cat_status` = '$cat_status'";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_category','Category Added Successfully','add');
	}
	
			
	public function ViewCategories() {
	$sql = mysql_query("SELECT * FROM `category`") or die (mysql_error());
	while($row=mysql_fetch_assoc($sql)) {
		
	//if($row['cat_status'] == 0) { $status = 'Inactive';} else { $status = 'Active';}
		
	echo "<tr>";
	echo "<td>$row[cat_id]</td>";
    echo "<td>$row[cat_name]</td>";
	echo "<td>$row[cat_status]</td>";
	echo "<td align='left'>
		  <a class='btn btn-warning' data-toggle='modal' onClick='editcategory($row[cat_id])' href='#myModal'>Edit</a>
		  </td>";
    echo "<td align='left'>
          <a class='btn btn-danger' data-toggle='modal' href='index.php?folder=generals&page=add_category&dlt=$row[cat_id]'>Delete</a>
		  </td>";
	echo "</tr>";	

	}
	}
		
	public function DeleteCat($id) {
	$query = "DELETE FROM `category` WHERE `cat_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_category','Category Deleted','delete');
	}
		
	public function EditCategory($id) {
	extract($_POST);
	$cat_name = ucwords($_POST['cat_name']);
	$query = "UPDATE `category` SET `cat_name` = '$cat_name',`cat_status` = '$cat_status' WHERE `cat_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_category','Category Updated Successfully','add');
	}
	
	
	public function ViewCategories_drop() {
	$sql = mysql_query("SELECT * FROM `category`") or die (mysql_error());
	while($row=mysql_fetch_assoc($sql)) {
		echo "<option value='$row[cat_id]'>$row[cat_name]</option>";
	}
	}
	
	public function ViewCategories_drop_2() {
	$sql = mysql_query("SELECT c.`cat_name`,c.`cat_id` FROM `category` AS c WHERE c.`cat_id` IN (SELECT DISTINCT qb.`cat_id` FROM  `question_bank` AS qb WHERE qb.`scid`=2)") or die (mysql_error());
	while($row=mysql_fetch_assoc($sql)) {
		echo "<option value='$row[cat_id]'>$row[cat_name]</option>";
	}
	}
	
	
	public function AddNationality() {
	extract($_POST);
	$nationality = strtoupper($_POST['nationality']);
					
	$query = "INSERT INTO `nationality` SET `nat_title` = '$nationality'";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_nationality','Nationality Added Successfully','add');
	}
	
	
    public function AddReligion() {
	extract($_POST);
	$religion = strtoupper($_POST['religion']);
					
	$query = "INSERT INTO `religion` SET `rel_title` = '$religion'";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_religion','Religion Added Successfully','add');
	}
	
	
    public function ViewNationality() {
	$sql = mysql_query("SELECT * FROM `nationality`") or die (mysql_error());
	while($row=mysql_fetch_assoc($sql)) {
    echo "<tr>";
    echo "<td>$row[nat_title]</td>";
	echo "<td align='left'>
		  <a class='btn btn-warning' data-toggle='modal' onClick='editnationality($row[nat_id])' href='#myModal'>Edit</a>
		  </td>";
    echo "<td align='left'>
          <a class='btn btn-danger' data-toggle='modal' href='index.php?folder=generals&page=add_nationality&dlt=$row[nat_id]'>Delete</a>
		  </td>";
	echo "</tr>";	

	}
	}
	
	    public function ViewReligion() {
		$sql = mysql_query("SELECT * FROM `religion`") or die (mysql_error());
		while($row=mysql_fetch_assoc($sql)) {
    	echo "<tr>";
    	echo "<td>$row[rel_title]</td>";
		echo "<td align='left'>
			  <a class='btn btn-warning' data-toggle='modal' onClick='editreligion($row[rel_id])' href='#myModal'>Edit</a>
		  	  </td>";
    	echo "<td align='left'>
              <a class='btn btn-danger' data-toggle='modal' href='index.php?folder=generals&page=add_religion&dlt=$row[rel_id]'>Delete</a>
		      </td>";
		echo "</tr>";	
	}
	}
	
	
    public function DeleteNat($id) {
	$query = "DELETE FROM `nationality` WHERE `nat_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_nationality','Nationality Deleted','delete');
	}
	
	
	public function DeleteRel($id) {
	$query = "DELETE FROM `religion` WHERE `rel_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_religion','Religion Deleted','delete');
	}
	
	
	
	
    public function EditNationality($id) {
	extract($_POST);
	$nationality = strtoupper($_POST['nationality']);
	$query = "UPDATE `nationality` SET `nat_title` = '$nationality' WHERE `nat_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_nationality','Nationality Updated Successfully','add');
	}
	
	
		
    public function EditReligion($id) {
	extract($_POST);
	$religion = strtoupper($_POST['religion']);
	$query = "UPDATE `religion` SET `rel_title` = '$religion' WHERE `rel_id` = $id";	
	$result = mysql_query($query) or die(mysql_error());
	redirect('index.php?folder=generals&page=add_religion','Religion Updated Successfully','add');
	}
	
	
	public function AddAllowance() {
	extract($_POST);
	$allow_name = strtoupper($_POST['allow_name']);
	
		$mx_id = mysql_query("SELECT IFNULL(MAX(alll.`allow_id`),0)+1 AS allow_id FROM `allowance` AS alll") or die(mysql_error());
	    $max_id = mysql_fetch_assoc($mx_id);
	    $mid = $max_id['allow_id'];
		
	$query = mysql_query("INSERT INTO `allowance` SET `allow_id`='$mid',`allow_name`='$allow_name',`allow_type`='$allow_type'") or die(mysql_error());
	redirect('index.php?folder=generals&page=add_allowance','Record Inserted Successfully','add');
	}
	
	
	public function AllowanceList() {
		
		$sql = mysql_query("SELECT * FROM `allowance`") or die(mysql_error());
		while($fetch=mysql_fetch_array($sql)) {
		echo "<tr>";
		echo "<td>$fetch[allow_name]</td>";
		
		if($fetch['allow_type'] == 'A') {
		echo "<td>Allowance</td>";
		}
		
		if($fetch['allow_type'] == 'I') {
		echo "<td>Increament</td>";
		}
		echo "<td><a class='btn btn-warning' data-toggle='modal' onClick='edit_allowance($fetch[allow_id])' href='#myModal'>Edit</a></td>";	
		}	
	}
	
		
	public function EditAllowance($allow_id) {
	extract($_POST);
	$allow_name = strtoupper($_POST['allow_name']);
		
$query = mysql_query("UPDATE `allowance` SET `allow_name`='$allow_name',`allow_type`='$allow_type' WHERE `allow_id`='$allow_id'") or die(mysql_error());
	redirect('index.php?folder=generals&page=add_allowance','Record Updated Successfully','add');
	}
	
	

     public function MakeAllowance() {
		extract($_POST);
		$check = mysql_query("SELECT `emp_id` FROM `employees_allowance` WHERE `emp_id`='$emp_id'") or die(mysql_error());
		$count = mysql_num_rows($check);
		
		if($count > 0) {
		redirect('index.php?folder=employees&page=view_employees','Record Already exists for this employee','delete');
		} else {
        $sql = mysql_query("INSERT INTO `employees_allowance` SET `emp_id`='$emp_id',`allow_id`='$allow_id',`start_date`='$start_date',
                           `end_date`='$end_date',`amount`='$amount',`remarks`='$remarks'") or die(mysql_error());
		redirect('index.php?folder=employees&page=view_employees','Record is Saved in Database','add');
		}
	 }
	 
	 
	 
	 
	 

}	
		
$general = new General();


?>
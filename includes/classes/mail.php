<?php
ob_start();
class Mail extends config {
		
	public function AddMailSettings() {
	
	$update = mysql_query("UPDATE `emails` SET `mail_status` = 'Inactive'") or die(mysql_error());
	
	if($update) {
	extract($_POST);
	$mail_sendername = ucwords($_POST['mail_sendername']);
	
	$mx_id = mysql_query("SELECT IFNULL(MAX(em.`mail_id`),0)+1 AS mail_id FROM `emails` AS em") or die(mysql_error());
	$max_id = mysql_fetch_assoc($mx_id);
	$mid = $max_id['mail_id'];
	
    $sql = mysql_query("INSERT INTO `emails` SET `mail_host` = '$mail_host', `mail_port` = '$mail_port', `mail_username` = '$mail_username',
                       `mail_password` = '$mail_password', `mail_sendername` = '$mail_sendername', `mail_status` = 'Active',
                       `mail_id` = '$mid'") or die(mysql_error());
					   
	redirect('index.php?folder=mails&page=mail_form','Mail Settings Added Successfuly','add');
	}
	}
	
	
	public function MailSettingsList() {
		
		$list = mysql_query("SELECT * FROM `emails` ORDER BY `mail_id` DESC") or die(mysql_error());
		while($row = mysql_fetch_assoc($list)) {
		echo "<tr>";
		echo "<td>$row[mail_host]</td>";
        echo "<td>$row[mail_port]</td>";
		echo "<td>$row[mail_sendername]</td>";
		echo "<td>$row[mail_username]</td>"; 
		echo "<td>$row[mail_status]</td>";
		echo "<td align='left'>
		      <a class='btn btn-success' data-toggle='modal' onClick='editmail($row[mail_id])' href='#myModal'>Edit</a></td>";
		echo "<td align='left'>
		      <a class='btn btn-warning' data-toggle='modal' onClick='editmail_pass($row[mail_id])' href='#myModal'>Set Password</a></td>";
		echo "</tr>";
			
		}
	}
	
	
	public function EditMailSettings($id) {
	
	extract($_POST);
	
	if($status != '' && $status == 'Active') {
		
	$update = mysql_query("UPDATE `emails` SET `mail_status` = 'Inactive'") or die(mysql_error());
	
	$mail_sendername = ucwords($_POST['mail_sendername']);
    $sql = mysql_query("UPDATE `emails` SET `mail_host` = '$mail_host', `mail_port` = '$mail_port', `mail_username` = '$mail_username',                       `mail_sendername` = '$mail_sendername', `mail_status` = 'Active' WHERE `mail_id` = '$id'") or die(mysql_error());
	
	} else {
		
	$mail_sendername = ucwords($_POST['mail_sendername']); 
    $sql = mysql_query("UPDATE `emails` SET `mail_host` = '$mail_host', `mail_port` = '$mail_port', `mail_username` = '$mail_username',                       `mail_sendername` = '$mail_sendername' WHERE `mail_id` = '$id'") or die(mysql_error());
	}
     
	redirect('index.php?folder=mails&page=mail_form','Mail Settings Updated Successfuly','add');
	}
	
	
	    public function ChangeMailPassword() {
		extract($_POST);
		
  $query = mysql_query("SELECT `mail_password` FROM `emails` WHERE `mail_id`='$id' AND `mail_password` = '$old_pass'") or die(mysql_error());
		$count = mysql_num_rows($query);
		
		if($count == 1) {	 
		
		$sql = mysql_query("UPDATE `emails` SET `mail_password` = '$new_pass' WHERE `mail_id`='$id'") or die(mysql_error());
		redirect('index.php?folder=mails&page=mail_form','Password has been changed.','add');

		} else {
			
		redirect('index.php?folder=mails&page=mail_form','Password can not be changed. Please enter valid old password','delete');
			
		}
	}
    
	
	
	
	
}	
		
$mail = new Mail();


?>
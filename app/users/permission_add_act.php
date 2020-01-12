<?php

include("../../includes/config.php");

extract($_POST);

if($_POST){
	$menu->setPermissions();
	redirect("../../index.php?folder=users&page=group_details&id=".$group_id."","Success : Permissions Updated!",1);
}

?>

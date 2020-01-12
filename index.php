<?php 
	  include("includes/header.php"); 
	  include("includes/sidebar.php");
?> 
      
      <!--main content start-->

<?php
	
		$folder = 'home'; 
		if(isset($_GET['folder']))
		{
		$folder = $_GET['folder'];
		}

		if(isset($_GET['page'])){
		$page = "app/".$folder."/".$_GET['page'].".php";

		include ($page);
		}else{
		include($folder.".php");
		}
?>

     <!--main content end-->


      


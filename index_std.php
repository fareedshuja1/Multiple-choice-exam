<?php 
	  include("includes/header_std.php"); 
	  include("includes/sidebar_std.php");
?> 
      
      <!--main content start-->

<?php
	
		$folder = 'home_std'; 
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
     

      


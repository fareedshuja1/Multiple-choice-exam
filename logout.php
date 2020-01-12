<?php require_once("includes/config.php"); ?>
<?php	
    $session->logout();
    redirect_to("login.php");
?>

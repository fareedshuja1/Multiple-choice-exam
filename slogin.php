<?php
include("includes/config.php");

if($session->is_logged_in()) {
  redirect_to("index_std.php");
}
if (isset($_POST['submit'])) { 

  $username = trim($_POST['st_username']);
  $password = trim($_POST['st_password']);

  $user->login_student($username,$password);
  redirect_to("index_std.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>Please Login to Continue</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    


</head>

  <body class="login-body">
  
<?php show_msg(); ?>

    <div class="container">

      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">Student Login</h2>
        <div class="login-wrap">
    <input type="text" class="form-control" placeholder="Username" autofocus name="st_username" required style="text-transform: uppercase">
    <input type="text" class="form-control" placeholder="Password" name="st_password" style="text-transform: uppercase" required>
           
   <!--  Employee &nbsp;&nbsp;<input type="radio" name="option" value="employee" checked onChange="changeWindow(this.value)">
     Student &nbsp;&nbsp; <input type="radio" name="option" value="student"   onChange="changeWindow(this.value)"><br> -->
     <div class="panel-body"><div class="radios">
    <table border="0" cellspacing="10" cellpadding="10"><tr><td>
      <label class="label_radio" for="radio-01">
    <input name="sample-radio" id="radio-01" value="student" type="radio" checked onChange="changeWindow(this.value)" />Student</label></td>
      <td>      
      <label class="label_radio" for="radio-02">
      <input name="sample-radio" id="radio-02" value="employee" type="radio" onChange="changeWindow(this.value)" />Staff</label>
      </td></tr></table>
   </div></div>
            <button class="btn btn-lg btn-login btn-block" type="submit" name="submit">Login </button>

        </div>

      </form>

    </div>


  </body>
</html>

    <script>
    function changeWindow(value){
	if(value=='student'){
        window.location="slogin.php";
	}
        
        if(value=='employee'){
        window.location="login.php";
	}
    }
    </script>
    
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom switch-->
    <script src="js/bootstrap-switch.js"></script>
    <!--custom tagsinput-->
    <script src="js/jquery.tagsinput.js"></script>
    <!--custom checkbox & radio-->
    <script type="text/javascript" src="js/ga.js"></script>

    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>

    <script src="js/common-scripts.js"></script>

  <script src="js/form-component.js"></script>
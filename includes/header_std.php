<?php 
include("config.php");
if (!$_SESSION['student_id']) { redirect_to("login.php"); }

if(isset($_POST['change_pass_std'])) {
	$user->ChangePassword_Std();
	redirect('index_std.php','Password has been changed.','add');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>:: Online Exam System ::</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />

  </head>

<!--<body style="background:url(img/BG_Img_1.gif) repeat 0 0 transparent;">-->

<body style="background-color:#CCC">

  <section id="container" class="">
      
      <header class="header white-bg" style="background-color:#F67A6E">
          <div class="sidebar-toggle-box">
<!--<img src="img/doc.png" height="35" width="55" />-->

          </div>
          <!--logo start-->
       <a href="#" class="logo" style="margin-top:1px"><img src="BD2.png" width="70px" height="60px"><span></span></a>

          <!--logo end-->
          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                  <li>
                  </li>
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                   
                  <?php if($_SESSION['student_image'] == '' || $_SESSION['student_image'] == NULL) { ?>
                  <img alt="" src="no_pic_small.jpg" width="30" height="30">
                  <?php } else { ?>
                  <img alt="" src="img/students/thumbs/<?php echo $_SESSION['student_image']; ?>" width="30" height="30">
                  <?php } ?>
                   
                          <span class="username"><?php echo $_SESSION['student_name']; ?></span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>
                          
                <li><a class="btn btn-success" data-toggle="modal" href="#myModal4" style="background-color:#FFF; border-color:#FFF">
                <i class="icon-cog"></i>Change Password</a></li>
 <li style="margin-left: 30px"><a class="btn btn-success" data-toggle="modal" href="#myModal3" style="background-color:#FFF; border-color:#FFF">
                <i class="icon-cog"></i>Profile</a></li>

                          <li><a href="logout.php"><i class="icon-key"></i>Log Out</a></li>
                      </ul>
                  </li>
                  <!-- user login dropdown end -->
              </ul>
          </div>
      </header>
      
<?php // include("user-info.php"); ?>
<?php  include("change_password_std.php"); ?>
      
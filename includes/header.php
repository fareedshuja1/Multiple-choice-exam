<?php 
include("config.php");
if (!$session->is_logged_in()) { redirect_to("login.php"); }

if(isset($_POST['user-info'])) {
	$user->UpdateUser();
	redirect('index.php','Record updated successfuly','add');
}
if(isset($_POST['change_pass'])) {
	$user->ChangePassword();
	redirect('index.php','Password has been changed.','add');
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

<script type="text/javascript">
function init ( )
{
  timeDisplay = document.createTextNode ( "" );
  document.getElementById("clockkk").appendChild ( timeDisplay );
}

function updateClock ( )
{
  var currentTime = new Date ( );
  var currentHours = currentTime.getHours ( );
  var currentMinutes = currentTime.getMinutes ( );
  var currentSeconds = currentTime.getSeconds ( );
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;
  var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  document.getElementById("clockkk").firstChild.nodeValue = currentTimeString;
}
</script>

  </head>
  
  

<!--<body style="background:url(img/BG_Img_1.gif) repeat 0 0 transparent;" onLoad="updateClock(); setInterval('updateClock()', 1000 )">
-->

<body style="background-color:#CCC" onLoad="updateClock(); setInterval('updateClock()', 1000 )">


  <section id="container" class="">
      
      <!--<header class="header white-bg" style="background-color:#F67A6E">-->
      <header class="header white-bg">
       <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
          </div>
         <!--<img src="img/doc.png" height="35" width="55" />-->

          </div>
          <!--logo start-->
       <a href="#" class="logo" style="margin-top:1px"><img src="BD2.png" width="70px" height="70px"><span></span></a>
        <!--logo end-->
          <div class="top-nav">
                                  <span id="clockkk" style="font-size:22px; margin-left: 500px;color:#F00;">
                                  &nbsp;
                                  </span>
                                  
              <ul class="nav pull-right top-menu">
                  <li> 
                  <!--<span id="date_time" style="font-size:22px; margin-right: 500px; color:#F00">
	              <span id="clock">&nbsp;</span>
                  </span>-->
                  </li>
                  
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                      
					 <?php if($_SESSION['emp_pic'] == '' || $_SESSION['emp_pic'] == NULL) { ?>
                     <img alt="" src="no_pic_small.jpg" width="30" height="30">
                     <?php } else { ?>
                     <img alt="" src="img/employees/thumbs/<?php echo $_SESSION['emp_pic']; ?>" width="30" height="30">
                     <?php } ?>


                          <span class="username"><?php echo $_SESSION['emp_name']; ?></span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>
                          
                <li><a class="btn btn-success" data-toggle="modal" href="#myModal4" style="background-color:#FFF; border-color:#FFF">
                <i class="icon-cog"></i>Change Password</a></li>
                
<li style="margin-left: 30px"><a class="btn btn-success" data-toggle="modal" href="#myModal3" style="background-color:#FFF; border-color:#FFF">
                <i class="icon-cog"></i>Profile</a></li>

                          <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
                      </ul>
                  </li>
                  <!-- user login dropdown end -->
                  
              </ul>
          </div>
      </header>
      
<?php include("user-info.php"); ?>
<?php include("change_password.php"); ?>
      
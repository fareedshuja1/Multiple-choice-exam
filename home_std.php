<?php
$id = $_SESSION['student_id'] ;

$query = mysql_query("SELECT si.`student_id`,si.`student_name`,si.`student_fname`,si.`student_dob`,si.`student_gender`,si.`student_nic`,
si.`student_fnic`,si.`student_phone`,si.`student_cell`,si.`student_email`,n.`nat_title`,r.`rel_title`,si.`emergency_phone`,
si.`emergency_cell`,si.`emergency_email`,si.`student_address`,si.`form_no`,si.`reg_no`,si.`student_image`
FROM `student_info` AS si,`nationality` AS n,`religion` AS r WHERE si.`nat_id`=n.`nat_id` AND si.`rel_id`=r.`rel_id`
AND si.`student_id`='$id'") or die(mysql_error());

$row = mysql_fetch_assoc($query);
?>     
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <?php show_msg(); ?>
              
              <div class="col-lg-4">
                      <!--widget start-->
                      <aside class="profile-nav alt green-border">
                          <section class="panel">
                              <div class="user-heading alt green-bg">
                                  <a href="#">
      
	  <?php if($row['student_image'] == '' || $row['student_image'] == NULL) { ?>
      <img alt="" src="no_pic.jpg" width="140px" height="140px">
      <?php } else { ?>
      <img alt="" src="img/students/<?php echo $row['student_image']; ?>" width="140px" height="140px">
      <?php } ?>


                                  </a>
                                  <h1><?php echo $row['student_name']; ?></h1>
                                  <p><?php echo $row['student_email']; ?></p>
                              </div>

                              <ul class="nav nav-pills nav-stacked">
<li><a href="javascript:;">
<i class="icon-user"></i> FATHER NAME <span class="" style="float:right" ><?php echo $row['student_fname']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-calendar"></i> DOB <span class="" style="float:right" ><?php echo $row['student_dob']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-phone"></i> PHONE <span class="" style="float:right" ><?php echo $row['student_phone']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-mobile-phone"></i> CELL <span class="" style="float:right" ><?php echo $row['student_cell']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-picture"></i> NIC <span class="" style="float:right" ><?php echo $row['student_nic']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-picture"></i> FATHER NIC <span class="" style="float:right" ><?php echo $row['student_fnic']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-group"></i> NATIONALITY <span class="" style="float:right" ><?php echo $row['nat_title']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-circle-arrow-up"></i> RELIGION <span class="" style="float:right" ><?php echo $row['rel_title']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-mobile-phone"></i> EMERGENCY CELL <span class="" style="float:right" ><?php echo $row['emergency_cell']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-phone"></i> EMERGENCY PHONE <span class="" style="float:right" ><?php echo $row['emergency_phone']; ?></span></a>
</li>  
<li><a href="javascript:;">
<i class="icon-envelope-alt"></i> EMERGENCY EMAIL <span class="" style="float:right" ><?php echo $row['emergency_email']; ?></span></a>
</li>  
<li><a href="javascript:;">
<i class="icon-home"></i> ADDRESS <span class="" style="float:right" ><?php echo $row['student_address']; ?></span></a>
</li>    
                         

 </ul>

                          </section>
                      </aside>
                      <!--widget end-->
                      
                  </div>
                  
                  
                  
                  
          <div class="col-lg-8">
                      <section class="panel">
                          <div class="panel-body progress-panel" style="background-color:#2A3542;">
                              <div class="task-progress">
                                  <h1 style="color:#fff">CLASS DETAILS</h1>
                              </div>
                              
                            
                          </div>
                          <table class="table table-hover personal-task" border="0">
                          <thead>
                          <tr style="background-color:#AEC785; color:#FFF; font-size:11px">
                                  <th width=""> COURSE </th>
                                  <th> CLASS NAME</th>
                                  <th width="60px"> STATUS  </th>
                                  <th width="60px">&nbsp;  </th>
                                  <th width="40px">&nbsp;  </th>
                                  <th width="40px">&nbsp;  </th>

                              </tr>
                              </thead>
                           <tbody style="font-size:10px">
                          <?php $students->ViewStdClasses($id); ?>
                           </tbody>
                          </table>
                      </section>
                  </div>        
                  
                  
                
                      <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel" style="background-color:#2A3542;">
                              <div class="task-progress">
                                    <h1 style="color:#fff">EXAM SCHEDULES</h1>
                              </div>
                              
                          </div>
                          <table class="table table-hover personal-task" border="0">
                           <thead>
                          <tr style="font-size:10px; background-color:#AEC785; color:#FFF">
                                  <th width=""> CATEGORY &nbsp; </th>
                                  <th width=""> EXAM DATE &nbsp; </th>
                                  <th> TOTAL QUES &nbsp; </th>
                                  <th> TOTAL MIN. &nbsp; </th>
                                  <th>&nbsp;   </th>
                                  
                              </tr>
                              </thead>
                              <tbody id="tbody2" style="font-size:11px">
                              
                              </tbody>
                          </table>
                      </section>
                      <!--work progress end-->
                  </div>
                
                
                
                  
                  
                  
                  <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel" style="background-color:#2A3542;">
                              <div class="task-progress">
                                    <h1 style="color:#fff">EXAM RESULTS</h1>
                              </div>
                              
                          </div>
                          <table class="table table-hover personal-task">
                           <thead>
                          <tr style="font-size:10px; background-color:#AEC785; color:#FFF">
                                  <th width=""> CATEGORY &nbsp; </th>
                                  <th width=""> EXAM DATE &nbsp; </th>
                                  <th> TOTAL QUES &nbsp; </th>
                                  <th> TOTAL MIN. &nbsp; </th>
                                  <th> CORRECT </th>
                                  <th> INCORRECT </th>
                                  <th> UNSOLVED </th>
                                  <th> PASS/FAIL </th>
                                  <th> % AGE </th>
                              </tr>
                              </thead>
                              <tbody id="tbody" style="font-size:11px">
                              
                              </tbody>
                          </table>
                      </section>
                      <!--work progress end-->
                  </div>
                  
                  
                     <div class="col-lg-8">
                      <section class="panel">
                          <div class="panel-body progress-panel" style="background-color:#2A3542;">
                              <div class="task-progress">
                                    <h1 style="color:#fff">INVOICE / LEDGER DETAILS</h1>
                              </div>
                              
                          </div>
                          <table class="table">
                           <thead>
                          <tr style="background-color:#AEC785; color:#FFF">
                          <th width=""> Invoice No.</th>     
                          <th width=""> Date</th>
                          <th width=""> Total Fee Amount </th>
                          <th width="" colspan="3"> Paid Fee Amount  </th> 
                              </tr>
                              </thead>
                              <tbody id="tbody3">
                              
                              </tbody>
                          </table>
                      </section>
                  </div>
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
              
              <!-- page end-->
          </section>
      </section>
      
            
      
  </section>
  
  <script>
  function getledger(ccid,scd_id) {
	  //alert(scd_id);
  $.post("files/get_ledger_detail2.php/", {scd_id:scd_id,ccid:ccid}, function(page_response)
  {
  $("#tbody3").html(page_response);
  });
  }
  </script>
  
  
<script>
 function getstdcrs(id){
 
  $.post("get_std_course.php/", {id: id}, function(page_response)
  {
  $("#tbody").html(page_response);
  });
  }
</script>

<script>
 function getschcrs(id){
 
  $.post("get_sch_exam.php/", {id: id}, function(page_response)
  {
  $("#tbody2").html(page_response);
  });
  }
</script>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>


  </body>
</html>
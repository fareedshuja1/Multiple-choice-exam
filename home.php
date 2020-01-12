 <?php
$id = $_SESSION['emp_id'] ;

$query = mysql_query("SELECT `emp_name`, `emp_fname`, `emp_contact`, `emp_address`, `emp_pic`, `emp_email` FROM `employees` WHERE `emp_id` ='$id'") or die(mysql_error());

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
                             <?php if($row['emp_pic'] == '' || $row['emp_pic'] == NULL) { ?>
                             <img alt="" src="no_pic.jpg" width="140px" height="140px">
                             <?php } else { ?>
                             <img alt="" src="img/employees/<?php echo $row['emp_pic']; ?>" width="140px" height="140px">
                              <?php } ?>
                                  </a>
                                  <h1><?php echo $row['emp_name']; ?></h1>
                                  <p><?php echo $row['emp_email']; ?></p>
                              </div>

                              <ul class="nav nav-pills nav-stacked">
                              
<li><a href="javascript:;">
<i class="icon-user"></i> FATHER NAME <span class="" style="float:right" ><?php echo $row['emp_fname']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-phone"></i> PHONE <span class="" style="float:right" ><?php echo $row['emp_contact']; ?></span></a>
</li>
<li><a href="javascript:;">
<i class="icon-calendar"></i> ADDRESS <span class="" style="float:right" ><?php echo $row['emp_address']; ?></span></a>
</li>

</ul>

                          </section>
                      </aside>
                  </div>
                  
                     <div class="col-lg-8">
                      <section class="panel">
                          <div class="panel-body progress-panel" style="background-color:#2A3542;">
                              <div class="task-progress">
                                  <h1 style="color:#fff">COMING EXAMS IN 7 DAYS</h1>
                              </div>
                              
                            
                          </div>
                          <table class="table table-hover personal-task" border="0">
                          <thead>
                          <tr style="background-color:#AEC785; color:#FFF; font-size:11px">
                                  <th width="" align="center"> COURSE </th>
                                  <th width="" align="center"> CLASS NAME </th>
                                  <th width="" align="center"> CATEGORY </th>
                                  <th width="" align="center"> EXAM DATE</th>
                                  <th width="" align="center"> START TIME  </th>
                                  <th width="" align="center"> REMAINING DAYS  </th>
                                  <th>STATUS</th>
                              </tr>
                              </thead>
                           <tbody style="font-size:10px">
                          <?php $employees->ComingExamDates(); ?>
                           </tbody>
                          </table>
                      </section>
                  </div>        
                        
                  
                     <div class="col-lg-8">
                      <section class="panel">
                          <div class="panel-body progress-panel" style="background-color:#2A3542;">
                              <div class="task-progress">
                                  <h1 style="color:#fff">PENDING FEE</h1>
                              </div>
                              
                            
                          </div>
                          <table class="table" border="0">
                          <thead>
                          <tr style="background-color:#AEC785; color:#FFF; font-size:11px">
                                  <th width="" align="center"> CLASS NAME     </th>
                                  <th width="" align="center"> TOTAL STUDENTS </th>
                                  <th width="" align="center" colspan="2"> BALANCE FEE </th>

                              </tr>
                              </thead>
                           <tbody>
                          <?php $courses->Pending_Fee(); ?>
                           </tbody>
                          </table>
                      </section>
                  </div>      
                  
                  
                     <div class="col-lg-8">
                      <section class="panel">
                          <div class="panel-body progress-panel" style="background-color:#2A3542;">
                              <div class="task-progress">
                                  <h1 style="color:#fff">TIME TABLE</h1>
                              </div>
                              
                            
                          </div>
                          <table class="table" border="0">
                          <thead>
                          <tr style="background-color:#AEC785; color:#FFF; font-size:11px">
                                  <th width="" align="center"> CLASS NAME     </th>
                                  <th width="" align="center"> ROOM No. </th>
                                  <th width="" align="center"> START TIME </th>
                                  <th width="" align="center"> END TIME </th>

                              </tr>
                              </thead>
                           <tbody>
                          <?php $courses->time_table($id); ?>
                           </tbody>
                          </table>
                      </section>
                  </div>    
                  
                  
                  
                  
                  
          </section>
      </section>
      
            
      
      
      
      
  </section>
  
  
  <script>
  function Pending_Fee_List(ccid) {
	  alert(ccid);
	  
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
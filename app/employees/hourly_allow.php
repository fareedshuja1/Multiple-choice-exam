<?php
if(isset($_GET['emp_id'])) {
	$emp_id = $_GET['emp_id'];
}

?>
     <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
					  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
							<?php show_msg(); ?>
                          </header>
                          <div class="panel-body">
                         <table class="table table-striped border-top">
                          <thead>
                          <tr>
                                  <th width=""> Class Name </th>
                                  <th width=""> Total Students </th>
                                  <th width=""> Total Fee</th>
                                  <th width=""> Percentage </th>
                                  <th width=""> Teacher's Pay </th> 
                                  <th width="">&nbsp;  </th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $employees->HourlyAllowanceDetail($emp_id); ?>
                              </tbody>
                              </table>

                          </div>
                      </section>
                      

                              
                                                          
                              
                              
                  </div>
          </section>
      </section>      
  </section>
  




    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>

    <script src="js/common-scripts.js"></script>
    <script src="js/dynamic-table.js"></script>


  </body>
</html>
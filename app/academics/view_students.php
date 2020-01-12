      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->

              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
							<?php show_msg(); ?>
                          </header>
                          <table class="table table-striped border-top" id="sample_1">
                          <thead>
                          <tr>
                                  <th width="90px"> Emp. ID &nbsp; </th>
                                  <th width="130px"> Name &nbsp; </th>
                                  <th width="130px"> Father Name &nbsp; </th>
                                  <th> Contact &nbsp; </th>
                                  <th> Email &nbsp; </th>
                                  <th width="450px"> Address &nbsp; </th>   
                              </tr>
                              </thead>
                              <tbody>
                              <?php $employees->ViewAllEmployees(); ?>
                              </tbody>
                              </table>

                     </section>
                  </div>
              </div>
              <!-- page end-->
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


    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--script for this page only-->
    <script src="js/dynamic-table.js"></script>

  </body>
</html>
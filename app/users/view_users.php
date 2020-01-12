<script>
 function UserDetails(id){
  $.post("user_details.php/", {id: id}, function(page_response)
  {
	   $(".modal-body").html(page_response);
  });
 }
</script>
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
                                  <th width="130px"> Username &nbsp; </th>
                                  <th width="200px"> Employee Name &nbsp; </th>
                                  <th> Status &nbsp; </th>
                                  <th> Father Name &nbsp; </th>
                                  <th> Contact &nbsp; </th>
                                  <th> Email &nbsp; </th>
                                                                    <th>  &nbsp; </th>

                              </tr>
                              </thead>
                              <tbody>
                              <?php $user->ViewAllUsers(); ?>
                              </tbody>
                              </table>
                              
<!--               <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">User Details</h4>
                          </div>
                            <div class="modal-body">
                            
                            <!-- Here goes user details -->
                          <!--   </div>-->
                            
                            

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
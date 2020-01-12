<?php
if(isset($_GET['ccid'])) {
	$ccid = $_GET['ccid'];
	$cn = $_GET['cn'];
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
                       
                       
                         <div class="col-lg-8" style="width:100%">
                      <section class="panel">
                      <center>
<a href="#" onClick="printIt(document.getElementById('printme').innerHTML); return false"> <input type="button" value="Print" /> </a>
</center>
                        <div id="printme">
                          <table class="table table-striped border-top" style="border-collapse:collapse" width="60%" align="center" border="1" >
                          <thead>
                          <tr align="center" style="background-color:#2A3542; color:#FFF; height:50px;">
             <td colspan="4" align="center"><b><span style="font-size:24px">CLASS NAME: &nbsp; &nbsp; &nbsp; <?php echo $cn; ?></span></b></td>
                          </tr>
                          <tr style="height:40px">
                                  <th align="left"> STUDENT ID     </th>
                                  <th align="left"> STUDENT NAME </th>
                                  <th align="left"> FATHER NAME </th>
                                  <th align="left"> PENDING FEE </th>

                              </tr>
                              </thead>
                           <tbody>
                          <?php $courses->Pending_Fee_List($ccid); ?>
                           </tbody>
                          </table>
                          <br />
                           <div align="center"><b>Computer Generated Report </b></div><br />
                           <div align="center"><b><?php echo date("l jS \of F Y h:i A");?></b> </div>
                        </div>
                        
                        
                      </section>
                  </div>      
                       </div>
                      </section>
  
                  </div>
          </section>
      </section>            
      
  </section>
 </body>
</html>


<script type="text/javascript">
  var win=null;
  function printIt(printThis)
  {
    win = window.open();
    self.focus();
    win.document.open();
    win.document.write('<'+'html'+'><'+'head'+'><'+'style'+'>');
    win.document.write('body, td { font-family: Times; font-size: 10pt;}');
    win.document.write('<'+'/'+'style'+'><'+'/'+'head'+'><'+'body'+'>');
    win.document.write(printThis);
    win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
    win.document.close();
    win.print();
    win.close();
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
    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    <!--script for this page-->
<!--    <script src="js/form-component.js"></script>-->    
    <!-- Date Picker -->
	<link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>


    <!--common script for all pages-->

    <!--script for this page only-->
    <script src="js/dynamic-table.js"></script>
    
    <script type="text/javascript" src="./js/lib/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="./js/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="./js/source/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    
    <!-- Date Picker -->
    <link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
	<script>
	$(function() {
   	$(".datepicker").datepicker({
    changeMonth: true,
    changeYear: true  
    });
   
    $(".datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
    });
    </script>
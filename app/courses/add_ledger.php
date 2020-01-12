<?php
if(isset($_POST['add_ledger'])) {
	$courses->AddLedger();
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
                       
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="50%" cellpadding="10" cellspacing="" align="center" >
                       
                       <tr>
                       <td valign="top">
                       <label for="exampleInputEmail1">Select Class</label>
                       <select class="form-control m-bot15" name="ccid" id="ccid" onchange="get_class_students(this.value);">
                       <option value="">Select Option</option>
                       <?php $courses->ViewAllClasses_fee(); ?>
                       </select>                       
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Select Student</label>
           <select class="form-control m-bot15" name="scd_id" style="width:200px" id="student_id" onchange="get_ledger_detail(this.value);">
                       </select>
                       </td>
                       
                       
                       </tr>
                       </table>                       

                      <!-- Modal -->
                       <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-header">
                      	       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 <h4 class="modal-title">Payment Detail</h4>
                                   </div>
                                     <div class="modal-body">
                                       <table>
                                       <tr>
                                       <td>
                                       <label for="exampleInputEmail1">Remaining Amount (Rs)</label>
                                       <input type="text" name="rem_amount" id="rem_amount" class="form-control" readonly="readonly" />
                                       </td>
                                       <td>
                                       <label for="exampleInputEmail1">Paying Amount (Rs)</label>
                                       <input type="text" name="paid_amt" onkeypress='return isNumberKey(event)' class="form-control" />
                                       </td>
                                       <td>
                                       <label for="exampleInputEmail1">Paying Date</label>
                                       <input type="text" name="payment_date" id="" class="form-control cnic" value="<?php echo date('Y-m-d'); ?>" />
                                       </td>
                                       </tr>
                                       </table>                                       
                                     </div>
                                        
                                        <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                              <button class="btn btn-warning" type="submit" name="add_ledger"> Confirm</button>
                                        </div>
                                      </div>
                                  </div>
                              </div> 
                              </form>
                              <!-- modal -->
                              

                          </div>
                      </section>
                  <section class="panel">
                       <div class="panel-body">
<center>
<a href="#" style="display:none" id="print" onClick="printIt(document.getElementById('printme').innerHTML); return false"> <input type="button" value="Print" /> </a>
</center>
                        <div id="printme">
                          
     <table class="table border-top"  id="ledger_detail" style="border-collapse:collapse" width="80%" align="center" border="1" >
                       
                          </table>
                          
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


<script>
function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if ( charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

</script>

<script>
function get_balance_fee(idd) {
	$("#rem_amount").val(idd);
}
</script>

<script>
 function editmcourse(id){
  $.post("files/edit_mcourse.php/", {id: id}, function(page_response)
  {
  $(".modal-body-edit").html(page_response);
  });
 }
</script>

<script>
  function get_class_students(ccid) {
  $.post("files/get_class_students.php/", {ccid:ccid}, function(page_response)
  {
  $("#student_id").html(page_response);
  });
}
</script>

<script>
  function get_ledger_detail(scd_id) {
	  	  $("#print").show();
	  var ccid = $("#ccid").val();
	  $.post("files/get_ledger_detail.php/", {scd_id:scd_id,ccid:ccid}, function(page_response)
  {
  $("#ledger_detail").html(page_response);
  });
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
   
    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    <!--script for this page-->    

    <!--script for this page only-->
    <script src="js/dynamic-table.js"></script>
    
    <script type="text/javascript" src="./js/lib/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="./js/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="./js/source/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="./js/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    
    
         <!-- CNIC Validation -->
         <script src="js/cnic-validate.js"></script>
         <script src="js/cnic-validation.js"></script>
		 <script>
         $(document).ready(function() {
         $(".cnic").kendoMaskedTextBox({
         mask: "0000-00-00"
         });
         });
         </script>
<?php
if(isset($_POST['add-std'])) {
	$students->AddStudent();
}

$year=date("Y");
$year1=$year;
$yearFirst = $year-40;
$yearEnd=$year;

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
                       <table width="100%" cellpadding="10" cellspacing="">

                       <tr><td>
                       <label for="exampleInputEmail1">Name <mark style="color:#F00; background-color:#FFF">*</mark></label>
                       <input type="text" class="form-control" name="name" value="" required="required">
                       
                       <input type="hidden" name="stnd_id" value="">

                       </td><td>                       
                       <label for="exampleInputEmail1">Father Name <mark style="color:#F00; background-color:#FFF">*</mark></label>
                       <input type="text" class="form-control" name="fname" value="" required="required">
                       </td><td>                       
                       <label for="exampleInputPassword1">D.O.B</label><br />
                       <!--<input type="text" class="form-control datepicker" id="datepicker" name="dob">-->
                       <!--<input type="text" class="form-control" id="dp1" name="dob">-->
                       <select name="sday" class="form-control" style="width:100px; float:left">
                       <option value="01">01</option>
                       <option value="02">02</option>
                       <option value="03">03</option>
                       <option value="04">04</option>
                       <option value="05">05</option>
                       <option value="06">06</option>
                       <option value="07">07</option>
                       <option value="08">08</option>
                       <option value="09">09</option>
                       <option value="10">10</option>
                       <option value="11">11</option>
                       <option value="12">12</option>
                       <option value="13">13</option>
                       <option value="14">14</option>
                       <option value="15">15</option>
                       <option value="16">16</option>
                       <option value="17">17</option>
                       <option value="18">18</option>
                       <option value="19">19</option>
                       <option value="20">20</option>
                       <option value="21">21</option>
                       <option value="22">22</option>
                       <option value="23">23</option>
                       <option value="24">24</option>
                       <option value="25">25</option>
                       <option value="26">26</option>
                       <option value="27">27</option>
                       <option value="28">28</option>
                       <option value="29">29</option>
                       <option value="30">30</option>
                       <option value="31">31</option>
                       </select>
                       
                       
                       <select name="smonth" class="form-control"  style="width:100px; float:left; margin-left:10px">
                       <option value="01">JAN</option>
                       <option value="02">FEB</option>
                       <option value="03">MAR</option>
                       <option value="04">APR</option>
                       <option value="05">MAY</option>
                       <option value="06">JUNE</option>
                       <option value="07">JULY</option>
                       <option value="08">AUG</option>
                       <option value="09">SEP</option>
                       <option value="10">OCT</option>
                       <option value="11">NOV</option>
                       <option value="12">DEC</option>
                       </select>
                       
                       <select name="syear" class="form-control"  style="width:100px; float:left; margin-left:10px">
                       <option value="">Year</option>
                       <?php
                       for($year=$yearFirst; $year <= $yearEnd; $year++) { ?>
                       <option value="<?php echo $year ?>"><?php echo $year ?></option>
					   <?php } ?>
                       </select>
                       </td></tr>
                                          
                       <tr><td>
                       <label for="exampleInputEmail1">Gender <mark style="color:#F00; background-color:#FFF">*</mark></label>
                       <select class="form-control m-bot15" name="gender" style="" required="required">
                       <option value="">Select Option</option>
                       <option value="Male">Male</option>
                       <option value="Female">Female</option>
                       </select>
                       </td><td>                       
                       <label for="exampleInputEmail1">Nationality</label>
                       <select class="form-control m-bot15" name="nationality" onchange="CheckNat(this.value);">
                       <option value="">Select Option</option>
                       <?php echo $students->AllNationality(); ?>
                       </select>
                       
                       </td><td>                       
                       <label for="exampleInputEmail1">Religion</label>
                       <select class="form-control m-bot15" name="religion">
                        <option value="">Select Option</option>
                       <?php echo $students->AllReligion(); ?>
                       </select>
                       </td></tr>
                       
                       <tr><td>
                       <div id="spkid">
                       <label for="exampleInputEmail1">CNIC </label>
                       <input type="text" id="cnic" name="std_nic" class="form-control cnic"> 
                       </div>
                       <div id="safid" style="display:none">
                       <label for="exampleInputEmail1">AID </label>
                       <input type="text" id="" name="astd_nic" class="form-control"> 
                       </div>
                       
                       </td><td>                  
                       <div id="fpkid">
                       <label for="exampleInputEmail1">Father CNIC</label>
                       <input type="text" name="std_fnic" class="form-control cnic"> 
                       </div>
                       <div id="fafid" style="display:none">
                       <label for="exampleInputEmail1">Father AID </label>
                       <input type="text" name="astd_fnic" class="form-control"> 
                       </div>

                       </td><td>
                        <label for="exampleInputPassword1">Image</label>
                       <input type="file" id="exampleInputFile" name="upload">
                       </td></tr>
                       
                       <tr><td>
                       <label for="exampleInputEmail1">Phone</label>
                       <input type="text" class="form-control" name="std_phone" value="">
                       </td><td>                       
                       <label for="exampleInputEmail1">Cell <mark style="color:#F00; background-color:#FFF">*</mark></label>
     <input type="text" class="form-control" name="std_cell" id="std_cell" value="" required="required" onblur="CheckCell();">
                       </td><td>                       
                       <label for="exampleInputPassword1">Email <mark style="color:#F00; background-color:#FFF">*</mark></label>
                       <input type="email" class="form-control" name="std_email" id="std_email" 
                       value="" required="required" onblur="CheckEmail();">
                       </td></tr>
                       
                       <tr><td>
                       <label for="exampleInputEmail1">Emergency Phone</label>
                       <input type="text" class="form-control" name="em_phone" value="" >
                       </td><td>                       
                    <label for="exampleInputEmail1">Emergency Cell <mark style="color:#F00; background-color:#FFF">*</mark></label>
                    <input type="text" class="form-control" id="em_cell" name="em_cell" value="" required="required" onblur="CheckCell();">
                       </td><td>                       
                       <label for="exampleInputPassword1">Emergency Email <mark style="color:#F00; background-color:#FFF">*</mark></label>
                       <input type="email" class="form-control" name="em_email" 
                       value="" required="required" id="em_email" onblur="CheckEmail();">
                       <input type="hidden" class="" id="" name="add-std">
                       </td></tr>
                       <tr>
                       <td colspan="3">                       
                       <label for="exampleInputPassword1">Address</label>
                       <input type="text" class="form-control" name="address" value="">
                       <input type="hidden" name="chknat" id="chknat" />
                       </td>
                       </tr>
                       <tr>
                       
                       </tr>
                       
                       </table>      
                           
                        
                    <!-- <a class="btn btn-warning" data-toggle="modal" href="#myModal2">Add Student</a>-->
                     <button class="btn btn-warning" type="submit" name="submit"> Add Student</button>
                              
                              
                       </form>

                          </div>
                      </section>
                      
                  </div>
          </section>
      </section>
      
            
      
  </section>
 </body>
</html>
   
    <script>
    function CheckEmail() {
	
	var std_email = $("#std_email").val();
	var em_email = $("#em_email").val();
	
	if(std_email != '' && em_email != '') {
		
		if(std_email == em_email) {
		$("#em_email").val("");
		$("#std_email").val("");
		alert("Student Email and Emergency Email cannot be same. Please use different emails.");	 
		 }
	  }
   }
	</script>
    
    
    <script>
    function CheckCell() {
	
	var std_cell = $("#std_cell").val();
	var em_cell = $("#em_cell").val();
	
	if(std_cell != '' && em_cell != '') {
		
		if(std_cell == em_cell) {
		$("#em_cell").val("");
		$("#std_cell").val("");
		alert("Student Cell No & Emergency Cell No cannot be same. Please use different numbers.");	 
		}
	  }
	}
	</script>
    
    
    <script>
    function CheckNat(id) {
	$.post("check_nationality.php/",{id: id}, function(page_response)
    {
	var v= $.trim(page_response);
	
	$("#chknat").val(v);
	
	if(v != "PAKISTANI" || v != "PAKISTAN"){
	$("#spkid").hide();
    $("#fpkid").hide();
    $("#safid").show();
    $("#fafid").show();
	}
	
    if(v == "PAKISTANI" || v == "PAKISTAN"){
	$("#spkid").show();
    $("#fpkid").show();
    $("#safid").hide();
    $("#fafid").hide();
	}	
    });
    }
    </script>
    


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    
    <script src="js/bootstrap-switch.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script type="text/javascript" src="js/ga.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    
     <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
<!--    <script src="js/form-component.js"></script>-->

    
        <script src="js/jquery.tagsinput.js"></script>
        <script src="js/dynamic-table.js"></script>   
      
        <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>



              <!-- CNIC Validation -->
         <script src="js/cnic-validate.js"></script>
         <script src="js/cnic-validation.js"></script>
		 <script>
         $(document).ready(function() {
         $(".cnic").kendoMaskedTextBox({
         mask: "00000-0000000-0"
         });
         });
         </script>
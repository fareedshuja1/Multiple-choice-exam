<?php
if(isset($_POST['add-exam'])) {
$ques->AddExamMaster();
}

if(isset($_POST['edit-emaster'])) {
$id = $_POST['id'];
$ques->EditExamMaster($id);
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
                       <table width="90%" cellpadding="5" cellspacing="5" border="0">
                       
                       <tr>
                       <td width="200px">                       
                       <label for="exampleInputEmail1">Main Course</label>
                       <select class="form-control m-bot15" name="mcid" onchange="GetSubC();" id="mcid" style="" required="required">
                       <option value="">Select Main Course</option>
                       <?php $courses->ViewAllMainCourses(); ?>
                       </select>
                       </td>
                       
                       <td width="200px">                       
                       <label for="exampleInputEmail1">Sub Course</label>
                       <select class="form-control m-bot15" name="scid" id="scid" onchange="get_ccode();" required="required">
                       </select>
                       </td>
                       
                       <td width="200px">                       
                       <label for="exampleInputEmail1">Class Code</label>
                       <select class="form-control m-bot15" name="ccid" id="ccode" required="required" onchange="fetch_students();">
                       </select> 
                       </td>
      
                       <td width="200px">                       
                       <label for="exampleInputEmail1">Select Category</label>
                       <select name="cat_id" id="cat_id" class="form-control m-bot15" required="required">
                       </select>
                       </td>
                       
<!--                       <td width="200px">                       
                       <label for="exampleInputEmail1">Individual Student</label>
                       <select name="stud" id="stud" class="form-control m-bot15" style="">
                       </select>
                       </td>-->
                       
                       
                       
                   
                       </tr>
                       </table>
                       
                       
                       
                    <table width="" cellpadding="5" cellspacing="" border="0">
                    <tr>
                    <td>         
                    <table cellpadding="10"><tr><td>              
                    <label for="exampleInputEmail1">Start Time</label><br />
                    <select name="shour" style="width: 50px; height:40px">
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
                    <option value="00">00</option>
                    </select>
                    &nbsp;&nbsp;&nbsp;
                    <select name="sminute" style="width: 50px; height:40px">
                    <option value="00">00</option>
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
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                    <option value="55">55</option>
                    <option value="56">56</option>
                    <option value="57">57</option>
                    <option value="58">58</option>
                    <option value="59">59</option>
                    <option value="60">60</option>
                    </select>
                    </td>
                    <td>                       
                    <label for="exampleInputEmail1">End Time</label><br />
                    <select name="ehour" style="width: 50px; height:40px">
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
                    <option value="00">00</option>
                    </select>
                    &nbsp;&nbsp;&nbsp;
                    <select name="eminute" style="width: 50px; height:40px">
                    <option value="00">00</option>
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
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                    <option value="55">55</option>
                    <option value="56">56</option>
                    <option value="57">57</option>
                    <option value="58">58</option>
                    <option value="59">59</option>
                    </select>
                    
                    </td></tr></table>
                    </td>
                    
                    
                    <td colspan="3">
                  <div style="float:left">
                  <label for="exampleInputEmail1">Total Questions</label>
  <input type="text" class="form-control" name="total_ques" style="width:150px" onkeypress='return isNumberKey(event)' required="required">
                  </div> 
                  
                  <div style="float:left; margin-left:12px">
                  <label for="exampleInputEmail1">Exam Date</label>
  <input type="text" class="form-control datepicker" id="datepicker" name="exam_date" style="width:150px" required="required">
                  </div>
                  
                  <div style="float:left; margin-left:12px">
                  <label for="exampleInputEmail1">Total Minutes</label>
   <input type="text" class="form-control" name="tot_minutes" style="width:150px" onkeypress='return isNumberKey(event)' required="required">
                  </div>
                  
                  <div style="float:left; margin-left:12px">
                  <label for="exampleInputEmail1">Passing %</label>
   <input type="text" class="form-control" name="pass_per" style="width:150px" onkeypress='return isNumberKey(event)' required="required">
                  </div>
                       
                  <div style="float:left; margin-left:5px; background-color:#E2EFFC; width:150px; font-size:9px">
                  <label for="exampleInputEmail1">Give exam to Individual Student?</label>
                  <input type="checkbox" name="colorCheckbox" value="yes" class="form-control">
                  </div>

                       </td>
                       </tr>
                       
                       
                       <table width="100%" style="position:relative; display:none" id="tbl">
                       </table><br />
                       
                       
                       <table width="20%" style="position:relative; display:none" id="tbl2">
                       <tr>
                       <td width="200px">                       
                       <label for="exampleInputEmail1">Select Student</label>
                       <select name="stud" id="stud" class="form-control m-bot15" id="stud" style="width:200px">
                       </select>
                       </td>
                       </tr>
                       </table><br />
                       
                       
                       </table>  
                       
                       <a class="btn btn-warning" data-toggle="modal" href="#myModal2">Add Exam</a>
                 
                 <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Add Exam</h4>
                                          </div>
                                          <div class="modal-body">

                                              Are you sure to add exam?

                                          </div>
                                          <div class="modal-footer">
                             <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                             <button class="btn btn-warning" type="submit" name="add-exam"> Confirm</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       
                       </form>
						
                        </div>
                      </section>
                      
                        <section class="panel">
                          <div class="panel-body">
                          
                        <table class="table table-striped border-top" id="sample_1" width="100%">
                        <thead style="font-size:12px">
                        <tr>
                               <th width=""> Sub Course </th>
                               <th width=""> Category</th>
                               <th width=""> Class Name </th>
                               <th width=""> Exam Date</th>
                               <th width=""> Start Time  </th>
                               <th width=""> Total Ques   </th>
                               <th width=""> Total Min   </th>
                               <th width=""> Passing %   </th>
                               <th width=""> Exam Status </th>
                               <th width="">&nbsp;  </th>

                              </tr>
                              </thead>
                              <tbody>
                              <?php $ques->ViewExamMaster(); ?>
                              </tbody>
                              </table>
                          
                          </div>
                         </section>
                         
                           <!-- Modal 2-->
                   <div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Edit Exam Master</h4>
                                          </div>
                                          <div class="modal-body-edit">

                                            

                                          </div>
                                          
                                      </div>
                                  </div>
                              </div>
                       
                       <!-- modal 2-->
                      
                      
                      
   
                               
                  </div>
          </section>
      </section>
      
            
      
  </section>
 </body>
</html>

<script type="text/javascript" src="js/show_hide_std.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).attr("value")=="yes"){
                $("#tbl2").toggle();
            }
        });
    });
</script>



<script>
 function editemaster(id){
  $.post("files/edit_emaster.php/", {id: id}, function(page_response)
  {
  $(".modal-body-edit").html(page_response);
  });
 }
</script>


<script>
function fetch_students() {
	var id = $("#ccode").val();
  
  $.post("files/fetch_students.php/", {id: id}, function(page_response)
  {
  $("#stud").html(page_response);
  });
}
</script>


<script>
 function GetSubC(){
  var id = $("#mcid").val();
  
  $.post("get_scourse.php/", {id: id}, function(page_response)
  {
  $("#scid").html(page_response);
  });
  }
</script>

<script>
 function get_ccode(){
  var id = $("#scid").val();
  
  $.post("get_ccode.php/", {id: id}, function(page_response)
  {
  $("#ccode").html(page_response);
  });
  
  $.post("get_sccode.php/", {id: id}, function(data)
  {
  $("#cat_id").html(data);
  });
  
  }
</script>

<script>
function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if ( charCode > 31 && (charCode < 48 || charCode > 57))
  return false;
  return true;
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
    <!--<script src="js/form-component.js"></script>-->

    
    <!-- Date Picker -->
     <link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
	<script>
	$(function() {
   	$("#datepicker").datepicker({
    changeMonth: true,
    changeYear: true  
   });
   
   $("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
   });
   </script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>


    <!--common script for all pages-->

    <!--script for this page only-->
    <script src="js/dynamic-table.js"></script>


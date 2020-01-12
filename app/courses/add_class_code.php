<?php
if(isset($_POST['add-code'])) {
	$courses->AddClassCourse();
}

if(isset($_GET['dlt'])) {
	$id = $_GET['dlt'];
	$courses->DeleteClassCode($id);
}

if(isset($_POST['edit-ccode'])) {
	$id = $_POST['id'];
	$courses->EditClassCode($id);
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
                       
                       <form action="" method="post"  role="form">
                       <table cellpadding="10" cellspacing="">
                       <tr>
                          <td>                       
                       <label for="exampleInputEmail1">Main Course <mark style="color:#F00; background-color:#FFF">*</mark> </label>
                       <select class="form-control m-bot15" name="mcid" onchange="GetSubC();" id="mcid" style="width: 250px" required="required">
                       <option value="">Select Main Course</option>
                       <?php $courses->ViewAllMainCourses(); ?>
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Sub Course <mark style="color:#F00; background-color:#FFF">*</mark> </label>
        <select class="form-control m-bot15" name="scid" id="scid" style="width:250px" onblur="get_ccode();" required="required">
                       </select>
                       </td>
                       <td>                       
                       <label for="exampleInputEmail1">Teacher <mark style="color:#F00; background-color:#FFF">*</mark> </label>
                       <select class="form-control m-bot15" name="emp_id" id="emp_id" style="width:250px" required="required">
                       <option value="">Select Teacher</option>
                       <?php $employees->AllEmployess(); ?>
                       </select>
                       </td>
                       
                       </tr>
                       
                       <tr>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Class Name <mark style="color:#F00; background-color:#FFF">*</mark> </label>
                       <input type="text" class="form-control" id=""  name="class_name" required="required">
                       </td>
                                              
                       <td valign="top">
                       <label for="exampleInputEmail1">Start Date <mark style="color:#F00; background-color:#FFF">*</mark> </label>
                       <input type="text" class="form-control datepicker" id="s_date" name="s_date" required="required" onblur="CheckEndDate();">
                       </td><td valign="top">                       
                       <label for="exampleInputEmail1">End Date <mark style="color:#F00; background-color:#FFF">*</mark> </label>
                       <input type="text" class="form-control datepicker" id="e_date" name="e_date" required="required">
                       </td>
                       
                       </tr>
                       
                       <tr>
                       <td valign="top">                       
                       <label for="exampleInputEmail1">Class Start Time <mark style="color:#F00; background-color:#FFF">*</mark> </label><br />
                       
                    <select name="chour" style="width: 50px; height:40px">
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
                    </select>
                    &nbsp;&nbsp;&nbsp;
                    <select name="cminute" style="width: 50px; height:40px">
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
                    &nbsp;&nbsp;&nbsp;
                    <select name="cmoon" style="width: 50px; height:40px">
                    <option value="PM">PM</option>
                    <option value="AM">AM</option>
                    </select>

                       </td>
                       
                       
                       <td valign="top">                       
                    <label for="exampleInputEmail1">Class End Time <mark style="color:#F00; background-color:#FFF">*</mark> </label><br />
                       
                    <select name="cchour" style="width: 50px; height:40px">
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
                    </select>
                    &nbsp;&nbsp;&nbsp;
                    <select name="ccminute" style="width: 50px; height:40px">
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
                    &nbsp;&nbsp;&nbsp;
                    <select name="ccmoon" style="width: 50px; height:40px">
                    <option value="PM">PM</option>
                    <option value="AM">AM</option>
                    </select>

                       </td>
                       
                             <td>                       
                       <label for="exampleInputEmail1">Class Room <mark style="color:#F00; background-color:#FFF">*</mark> </label>
                       <select class="form-control m-bot15" name="roomid" id="roomid" style="width: 250px" required="required">
                       <option value="">Select Room</option>
                       <?php $courses->ViewAllroom(); ?>
                       </select>
                       </td>
                       

                      
                       </tr>
                       </table>                                              

                        
                    <!-- <a class="btn btn-warning" data-toggle="modal" href="#myModal2">Add Class Code</a> -->
                    
                    <button class="btn btn-warning" type="submit" name="add-code"> Add Class Code </button>
                    
                    </form>
                    
              

                          </div>
                      </section>
                  <section class="panel">
                       <div class="panel-body">
                          <table class="table table-striped border-top" id="sample_1">
                          <thead>
                          <tr>        
                          <th width=""> Course</th>
                          <th width=""> Class Title </th>
                          <th width=""> Teacher </th>
                          <th width=""> Start Date </th>
                          <th width=""> End Date </th>
                          <th width=""> Class Time </th>
                          <th width=""> Status  </th>
                          <th width="">&nbsp;   </th>
                          <th width="">&nbsp;   </th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php $courses->ViewClassCode(); ?>
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
                                              <h4 class="modal-title">Edit Class Code</h4>
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

<script>
 function editccode(id){
  $.post("files/edit_ccode.php/", {id: id}, function(page_response)
  {
  $(".modal-body-edit").html(page_response);
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
function CheckEndDate() {
	
	var s_date = $("#s_date").val();
    var scid = $("#scid").val();
	var mcid = $("#mcid").val();

    if(mcid == '') {
    alert("Please select a Main Course");
	} else {
	$.post("check_end_date.php/", {s_date: s_date,scid: scid}, function(page_response)
    {
    $("#e_date").val(page_response);
    });
		
	}
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
<?php
if(isset($_GET['std'])) {
	$id = $_GET['std'];
	$query = mysql_query("SELECT * FROM `student_info` AS s LEFT JOIN `nationality` AS n ON (s.`nat_id` = n.`nat_id`) LEFT JOIN `religion` AS r ON (s.`rel_id`=r.`rel_id`) WHERE s.`student_id`='$id'") or die(mysql_error());
	$row = mysql_fetch_assoc($query);
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
                          
                       <table cellpadding="" cellspacing="" id="sample_1" class="table table-striped border-top">
                       <tr>
                       <td><b>NAME</b></td> <td><?php echo $row['student_name']; ?></td>
                       <td><b>FATHER NAME</b></td> <td><?php echo $row['student_fname']; ?></td>
                       <td rowspan="3" colspan="2" align="center">
					   <?php if($row['student_image'] == '' || $row['student_image'] == NULL) { ?>
                       <img alt="" src="no_pic.jpg" width="170px" height="150px">
                       <?php } else { ?>
                       <img src="img/students/<?php echo $row['student_image']; ?>" width="170" height="150" />
                       <?php } ?>
                       </td>
                       </tr>
                       
                       <tr>
                       <td><b>GENDER</b></td> <td><?php echo $row['student_gender']; ?></td>
                       <td><b>STUDENT NIC</b></td> <td><?php echo $row['student_nic']; ?></td>
                       </tr>
   
                       <tr>
                       <td><b>STUDENT PHONE NO.</b></td> <td><?php echo $row['student_phone']; ?></td>
                       <td><b>STUDENT CELL NO.</b></td> <td><?php echo $row['student_cell']; ?></td>
                       </tr>
                                          
                       <tr>
                       <td><b>FATHER NIC</b></td> <td><?php echo $row['student_fnic']; ?></td>
                       <td><b>DOB</b></td> <td><?php echo $row['student_dob']; ?></td>
                       <td><b>STUDENT EMAIL</b></td> <td><?php echo $row['student_email']; ?></td>
                       </tr>
                                           
                       <tr>
                       <td><b>NATIONALITY</b></td> <td><?php echo $row['nat_title']; ?></td>
                       <td><b>RELIGION</b></td> <td><?php echo $row['rel_title']; ?></td>
                       <td><b>RECORD CREATED DATE</b></td> <td><?php echo $row['created_date']; ?></td>
                       </tr>
                       
                       <tr>
                       <td><b>EMERGENCY PHONE NO.</b></td> <td><?php echo $row['emergency_phone']; ?></td>
                       <td><b>EMERGENCY CELL NO.</b></td> <td><?php echo $row['emergency_cell']; ?></td>
                       <td><b>EMERGENCY EMAIL</b></td> <td><?php echo $row['emergency_email']; ?></td>
                       </tr>
                       
                       <tr>
                       <td><b>STUDENT ADDRESS</b></td> <td colspan="5"><?php echo $row['student_address']; ?></td>
                       </tr>                       
                       </table>


                          </div>
                      </section>
                  <section class="panel">
                       <div class="panel-body">
                          <h3 align="center">Class / Course Details</h3>
                          <table class="table table-striped border-top" id="sample_1">
                          <thead>
                          <tr>        
                             <th width=""> Class &nbsp; </th>
                          <th width=""> Total Fee &nbsp; </th>
                          <th width=""> Discounted Fee &nbsp; </th>
                          <th width=""> Form No &nbsp; </th>
                          <th width=""> Reg. No &nbsp; </th>
                          <th width=""> Status  </th> 
                          </tr>
                          </thead>
                          <tbody>
                          <?php  $courses->ViewStCourseDetail($id); ?>
                          </tbody>
                          </table>
                          
                       </div>
                   </section>

                      
                  </div>
          </section>
      </section>
      
            
      
  </section>
 </body>
</html>


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
<!--    <script src="js/form-component.js"></script>
-->    
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
    
    <link rel="stylesheet" type="text/css" href="./js/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<link rel="stylesheet" type="text/css" href="./js/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" type="text/css" href="./js/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />


	<script type="text/javascript">
		$(document).ready(function() {
			
			$('.fancybox').fancybox();

			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,
				openEffect : 'elastic',
				openSpeed  : 150,
				closeEffect : 'elastic',
				closeSpeed  : 150,
				closeClick : true,
				helpers : {
				overlay : null
				}
			});

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',
				prevEffect : 'none',
				nextEffect : 'none',
				closeBtn  : false,
				helpers : {
				title : {
				type : 'inside'
				},
				buttons	: {}
				},

			afterLoad : function() {
			this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',
				closeBtn  : false,
				arrows    : false,
				nextClick : true,
				helpers : {
				thumbs : {
				width  : 50,
				height : 50
					}
				}
			});

			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',
					arrows : false,
					helpers : {
					media : {},
					buttons : {}
					}
				});

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
				href : 'iframe.html',
				type : 'iframe',
				padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
					href : '1_b.jpg',
					title : 'My title'
					}, {
					href : '2_b.jpg',
					title : '2nd title'
					}, {
					href : '3_b.jpg'
					}
				], {
					helpers : {
					thumbs : {
					width: 75,
					height: 50
						}
					}
				});
			});
		});
	</script>

<style type="text/css">
.fancybox-custom .fancybox-skin {
box-shadow: 0 0 50px #222;
}
</style>   
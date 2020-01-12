<?php
if(isset($_POST['acc_rec'])) {
	$students->AddAcademicRecord();
	redirect('index.php?folder=academics&page=add_academic','Record has been saved in Database','add');
}

if(isset($_GET['std'])) {
	$id = $_GET['std'];
	$query = mysql_query("SELECT `student_name` FROM student_info WHERE `student_id`='$id'") or die(mysql_error());
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
                       
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="">
                    
                                                        
                       <tr><td>
                       <label for="exampleInputEmail1">Student Name</label>
       <input type="text" class="form-control" id=""  name="student_name" value="<?php echo $row['student_name']; ?>" readonly="readonly">
       <input type="hidden" name="student_id" value="<?php echo $id ?>" />
                       </td><td valign="top">                       
                       <label for="exampleInputEmail1">Exam Passed</label>
                       <input type="text" class="form-control" id=""  name="exam_pass">
                       </td><td valign="top">                       
                       <label for="exampleInputEmail1">Board</label>
                       <input type="text" class="form-control" id=""  name="board">
                       </td></tr>
                       
                       <tr><td>
                       <label for="exampleInputEmail1">Year</label>
                       <input type="text" class="form-control" id=""  name="year">
                       </td><td>                       
                       <label for="exampleInputEmail1">Grades</label>
                       <input type="text" class="form-control" id="" placeholder="" name="grades">
                       </td><td>                       
                       <label for="exampleInputPassword1">Division</label>
                       <input type="text" class="form-control" id=""  name="division">
                       </td></tr>
                       
                       <tr><td>
                       <label for="exampleInputEmail1">Percentage %</label>
                       <input type="text" class="form-control" id=""  name="per">
                       <input type="hidden" class="form-control" id=""  name="acc_rec">
                       </td></tr>
                    
                       
                       </table>                       

                        
               <a class="btn btn-warning" data-toggle="modal" href="#myModal2">ADD RECORD</a>

                   <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Modal Tittle</h4>
                                          </div>
                                          <div class="modal-body">

                                              Are you sure to add new academic record?

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                              <button class="btn btn-warning" type="submit" name="submit"> Confirm</button>
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
            <table class="table table-striped border-top" id="sample_1">
                          <thead>
                          <tr>
                                  <th width=""> Image &nbsp; </th>
                                  <th width=""> Std. ID &nbsp; </th>
                                  <th width=""> Name &nbsp; </th>
                                  <th width=""> Exam Passed &nbsp; </th>
                                  <th width=""> Board &nbsp; </th>
                                  <th width=""> Year &nbsp; </th>
                                  <th width=""> Grades &nbsp; </th>   
                                  <th width=""> Division &nbsp; </th>   
                                  <th width=""> Percentage &nbsp; </th>   
                              </tr>
                              </thead>
                              <tbody>
                              <?php $students->ViewAcademicRecords_add($id); ?>
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
 
	<link rel="stylesheet" href="js/date/jquery-ui.css" />
	<script src="js/date/jquery-1.9.1.js"></script>
	<script src="js/date/jquery-ui.js"></script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script src="js/dynamic-table.js"></script>
    <script>
    $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
	  
   });
   $( "#datepicker" ).datepicker( "option", "dateFormat", "dd-mm-yy");
   });
   </script>

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

  </body>
</html>

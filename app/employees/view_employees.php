<?php
if(isset($_POST['edit-emp'])) {
	$id = $_POST['emp_id'];
	$employees->EditEmployee2($id);
	redirect('index.php?folder=employees&page=view_employees','Record updated successfuly','add');
}


if(isset($_POST['make_allow'])) {
	$general->MakeAllowance();
}


?>
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
                              <th>Image</th>
                                  <th width=""> Name</th>
                                  <th width=""> Father Name</th>
                                  <th width=""> Contact</th>
                                  <th width=""> Email </th>
                                  <th width=""> Emp. Type </th> 
                                  <th width=""> Salary / %ages</th> 
                                  <th width=""> &nbsp;  </th>
                                  <th width="">&nbsp;  </th>
                                  <th width="">&nbsp;  </th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $employees->ViewAllEmployees(); ?>
                              </tbody>
                              </table>

                     </section>
                  </div>
                  
                                        
                                        <!-- Modal 2-->
                   <div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                      	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Edit Employee's Info</h4>
                                          </div>
                                          <div class="modal-body-edit1">

                                            

                                          </div>
                                          
                                      </div>
                                  </div>
                              </div>
                              <!-- modal 2-->
                              
                              
                                                            
                                                                       
                  <!-- Modal 3-->
                   <div class="modal fade" id="myModaledit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                     <div class="modal-content">
                      <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Make Allowance</h4>
                         </div>
                          <div class="modal-body-edit2"></div>
                           </div>
                            </div>
                             </div>
                              <!-- Modal 3-->
                              
                  
                  
              </div>
              <!-- page end-->
          </section>
      </section>
      
  </section>
 
<script>
 function editemp(id){
  $.post("files/edit_employee.php/", {id: id}, function(page_response)
  {
  $(".modal-body-edit1").html(page_response);
  });
 }
</script>


<script>
 function make_allow(emp_id) {
  $.post("files/make_allowance.php/", {emp_id: emp_id}, function(page_response)
  {
  $(".modal-body-edit2").html(page_response);
  });
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
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>


    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

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

  </body>
</html>
<?php
$group_id = $_GET['id'];
$data = $menu->listMenusPermissions($group_id);

if(isset($_POST['upd-per'])) {
$menu->setPermissions();
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
<form action="" method="post"> 
   
<input type="hidden" value="<?php echo $_GET['id']?>" name="group_id" />     
<table class="table table-striped border-top" id="sample_1">

<tr>
<td> <b> Name  </b></td>
<td> <b> Links </b></td>
<td colspan="2"> <b> Permission  </b></td>
<!--<td> <b>   </b></td>-->
</tr>

  
 <?php foreach ($data as $d){?>
		<tr>
			<td>&raquo; &nbsp;&nbsp;<?php echo $d['title']?></td>
			<td><?php echo $d['href']?></td>
			<td align='center'>
<input type="checkbox" value="1" <?php if($d['permissions']['view'] == 1 ){ echo "checked"; }?> name="permission[view][<?php echo $d['id']?>]" />
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			
		</tr>
			<?php if(!empty($d['child'])){?>
				<?php foreach($d['child'] as $c){?>
				<tr>
					<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &raquo; &nbsp;&nbsp; <?php echo $c['title']?>
					</td>
					<td>
					<?php echo $c['href']?>
					</td>
					
				<td align='center'>
<input type="checkbox" value="1" <?php if($c['permissions']['view'] == 1 ){ echo "checked"; }?> name="permission[view][<?php echo $c['id']?>]" />
					</td>
<td align='center'>
<input type="checkbox" value="1" <?php if($c['permissions']['edit'] == 1 ){ echo "checked"; }?> name="permission[edit][<?php echo $c['id']?>]" />
</td>
					
				</tr>
				<?php }?>
			<?php }?>
		<?php }?>

 <tr><td align="center" colspan="4"><input class="btn btn-warning" type="submit" value="Update" name="upd-per" /></td></tr> 
</table>

</form>


						
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


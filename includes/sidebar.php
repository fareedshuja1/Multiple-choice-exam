<aside>
 <div id="sidebar"  class="nav-collapse ">
   <ul class="sidebar-menu">
   
           <!--<li class="">
       <a class="" href="">
         <i class=""></i>-->
 <!--<span id="date_time" style="font-size:22px"><script type="text/javascript">window.onload = date_time('date_time');</script></span>-->
    <!-- <span id="date_time" style="font-size:22px">
	 <span id="clock">&nbsp;</span>
     </span>
             </a>
               </li>-->
                  
                 
     <li class="">
       <a class="" href="index.php">
         <i class="icon-th"></i>
           <span>Dashboard</span>
             </a>
               </li>
               
       
                  
                  
<!--                   <li class="sub-menu">
                       <a href="javascript:;" class="">
                       <i class="icon-circle-arrow-down"></i>
                       <span>Users</span>
                       <span class="arrow"></span>
                       </a>
                       <ul class="sub">
                       <li><a class="" href="index.php?folder=users&page=add_user">Add new User</a></li>
                       <li><a class="" href="index.php?folder=users&page=view_users">View all Users</a></li>
                       </ul>
                       </li>-->
                       
                       
 <?php   
 require_once("config.php");
 
 $home_menus =  $menu->ViewSideMenuNav();
	
   foreach($home_menus as $menuu){?>
		<?php if($menuu['parent'] == 0 ){?>
       
		<li class='sub-menu'> 
       <a href="javascript:;" class="">
        <i class="icon-circle-arrow-down"></i>
        <?php }?>
			<span><?php echo $menuu['title']?></span><span class="arrow"></span></a>
			<?php if(!empty($menuu['child'])){?>
				<ul class="sub">
					<?php foreach ($menuu['child'] as $c) {?>
						<li><a href="<?php echo $c["href"]?>"><span><?php echo $c['title']?></span></a></li>
					<?php }?>
				</ul></li>
			<?php }?>
		<?php }?>
                
               <li></li>
                  <li class="sub-menu active"></li>
                  <li></li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
<?php

ob_start();
class Menu extends config {
		
	
	
	public function AddSideMenu() {
	extract($_POST);
    $name = ucwords($_POST['name']);
	$query = mysql_query("INSERT INTO`um_menu` SET `menu_name`='$name', 
	                                               `parent_id`='$parent_id', 
												   `menu_url`='$url',
												   `menu_main` = '1'") or die(mysql_error());
    redirect('index.php?folder=menu&page=add_menu','Record is Saved in Database','add');

	}
	
	
	
	
	public function ViewSideMenu() {
	$query =  mysql_query("SELECT * FROM `um_menu` ORDER BY `menu_id` ASC") or die(mysql_error());
    while($row = mysql_fetch_array($query)) {
		
		@$i = $row['parent_id'];
		$q = mysql_query("SELECT `menu_name` FROM `um_menu` WHERE `menu_id` = $i") or die(mysql_error());
		$r = mysql_fetch_assoc($q);
		$parent = $r['menu_name'];
		
         /* echo "<tr>
		  <td>$row[menu_name]</td>
		  <td>$parent</td>
		  <td>$row[menu_url]</td>
		  <td align='left'>
		  <a class='btn btn-warning' data-toggle='modal' onClick='editsidemenu($row[menu_id])' href='#myModalmenuedit'>Edit</a>
		  </td>
          <td align='left'>
<a class='btn btn-danger' data-toggle='modal' href='index.php?folder=menu&page=add_menu&dlt=$row[menu_id]'>Delete</a>
		  </td>
		  </tr>"; */
		  
		 echo "<tr>
		  <td>$row[menu_name]</td>
		  <td>$parent</td>
		  <td>$row[menu_url]</td>
		  </tr>"; 
		  
	}
	}
	
	function CustomQuery($Query_C)
	{
	    $Return_Result[]=NULL;
	    $Count=0;
	    $Query = "$Query_C";
		
		$Show_Query_Reuslt = mysql_query($Query) or die(mysql_error());
	    $Query_Result_Final = mysql_fetch_assoc($Show_Query_Reuslt);
	
	    if(sizeof($Query_Result_Final)==1 && $Query_Result_Final==null)
	    {
	    	return null;
	    }
	
	    do{
	        $Return_Result[$Count]=$Query_Result_Final;
	        $Count++;
	    }
		while($Query_Result_Final=mysql_fetch_assoc($Show_Query_Reuslt));    
	    return $Return_Result;
	
	}	
	
	/*
	
	public function ViewSideMenuNav() {
    
	$sql = "SELECT * FROM um_menu order by menu_id";
		$data = $this->CustomQuery($sql);
		$menu = array();
		foreach($data as $menu_detail){
			$parent = $menu_detail['parent_id'];
			if($menu_detail['parent_id'] == 0){
				$menu[] = array(
					'id' => $menu_detail['menu_id'],
					'title' => $menu_detail['menu_name'],
					'href'	=> $menu_detail['menu_url'],
					'parent'=>$menu_detail['parent_id'],
					'child'	=> $this->getChildMenus($data,$menu_detail['menu_id'])
					);
			}
		}
		return $menu;
	}
	*/
	
		
public function ViewSideMenuNav(){
		
		$group = $_SESSION['group_id'];
	
		$sql = "SELECT * FROM um_menu as u LEFT JOIN um_permission as p ON (p.menu_id = u.menu_id) where u.menu_main = 1 
			    AND p.group_id = $group AND p.permission_read = 1 order by u.menu_order";
				
		if($_SESSION['group_id'] == 1 || $_SESSION['group_name'] == 'Admin'){
		$sql = "SELECT * FROM um_menu as u where u.menu_main = 1 order by u.menu_order";
		}
		$data = $this->CustomQuery($sql);
		
		$menus = array();
		foreach($data as $m){
			$parent = $m['parent_id'];
			if($m['parent_id'] == 0){
				$menus[] = array(
					'id' => $m['menu_id'],
					'title' => $m['menu_name'],
					'href'	=> $m['menu_url'],
					'parent'=>$m['parent_id'],
					'child'	=> $this->getChildMenus($data,$m['menu_id'])
					);
			}
		}
		return $menus;
	}
	
	
	public function getChildMenus($menus, $id){
		$data = array();
		foreach ($menus as $m){
			if($m['parent_id'] == $id){
				
				$data[] = array(
							'id' => $m['menu_id'],
							'title' => $m['menu_name'],
							'href'	=> $m['menu_url'],
							'parent'=>$m['parent_id']
							);
			}
		}
		return $data;
	}

	
	public function AllSideMenu() {
	$query =  mysql_query("SELECT * FROM `um_menu` WHERE `parent_id`= 0") or die(mysql_error());
    while($row = mysql_fetch_array($query)) {
    echo "<option value='$row[menu_id]'>$row[menu_name]</option>";
	}
	}
	
	
	
	
	/******************************* *******************************/
	
	
	public function listMenusPermissions($group){
		$sql = "SELECT * FROM um_menu order by menu_id";
		$data1 = $this->CustomQuery($sql);
		$data = array();
		foreach($data1 as $d1){
			$data[] = array(
				'menu_id' => $d1['menu_id'],
				'menu_name' =>$d1['menu_name'],
				'menu_url' => $d1['menu_url'],
				'parent_id' => $d1['parent_id'],
				'permissions' => $this->findPermissions($d1['menu_id'],$group,'permission_read'),
				
				);
		}
		
		
		$menus = array();
		foreach($data as $m){
			$parent = $m['parent_id'];
			if($m['parent_id'] == 0){
				$menus[] = array(
					'id' => $m['menu_id'],
					'title' => $m['menu_name'],
					'href'	=> $m['menu_url'],
					'parent'=>$m['parent_id'],
					'permissions' => $m['permissions'],
					'child'	=> $this->getChildMenusPermissions($data,$m['menu_id'])
					);
			}
		}
		
	
		
		return $menus;
	}
	
	
	public function findPermissions($menu_id,$group_id,$option){
		$sql = "SELECT * FROM um_permission WHERE menu_id = $menu_id AND group_id = $group_id";
		$rs = $this->getRecordBySql($sql);
		$data = array(
			'view' => $rs['permission_read'],
			'edit' => $rs['permission_update'],
			);
		return $data;
	}
	
	
	public function getChildMenusPermissions($menus, $id){
		$data = array();
		foreach ($menus as $m){
			if($m['parent_id'] == $id){
				
				$data[] = array(
							'id' => $m['menu_id'],
							'title' => $m['menu_name'],
							'href'	=> $m['menu_url'],
							'parent'=>$m['parent_id'],
							'permissions' => $m['permissions'],
							);
			}
		}
		return $data;
	}
	
		function getRecordBySql($sql){
		
		 $result = mysql_query($sql);
		 $row = mysql_fetch_assoc($result);
		 return $row;
	}
	
	
	
	public function setPermissions(){
		$group_id = $_POST['group_id'];
		$dsql = "DELETE from um_permission where group_id = ".$_POST['group_id'];
		mysql_query($dsql);
		$menu = "SELECT * FROM um_menu";
		$rs = mysql_query($menu);
		while($row = mysql_fetch_array($rs)){
			$view = 0;
			$edit = 0;
			
			if(isset($_POST['permission']['view'][$row['menu_id']])){
				$view = 1;
			}

			if(isset($_POST['permission']['edit'][$row['menu_id']])){
				$edit = 1;
			}

			
			$sql = "INSERT INTO um_permission SET 
					group_id  = '".$_POST['group_id']."', 
					menu_id = '".$row['menu_id']."',
					permission_read = '$view',
					permission_update = '$edit'
					"
					;
			
			$add = mysql_query($sql) or die(mysql_error());
		}
		//echo $sql; 
	redirect("index.php?folder=users&page=group_details&id=".$group_id."","Permissions Updated!",'add');

	}
	
	
	


}
		
$menu = new Menu();


?>
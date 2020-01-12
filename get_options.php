<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$count = $_REQUEST['id'];

?>
 <tr>
 <td width="5%"><label for="exampleInputEmail1">No. </label></td>
 <td width="30%" align="center"><label for="exampleInputEmail1">Options</label></td>
 <td width="30%"><label for="exampleInputEmail1">Correct Option </label></td>
<!-- <td width="30%"><label for="exampleInputEmail1" id="chop" style="display:none">Change </label></td>--> 

</tr>
                      
<?php
for($i=1;$i<=$count;$i++) {

echo "<tr>";
echo "<td valign='baseline'> $i </td>";
echo "<td valign='top'> <input type='text' class='form-control' name='option_text[]' style='width: 400px'> </td>";
echo "<td>
      <select class='form-control m-bot15 select' name='correct_option[]' style='width: 150px' onchange='show_btnn();'>
      <option value='I'>Incorrect</option>
	  <option value='C'>Correct</option>
	  </select>
      </td>";  
echo "</tr>";
}


}
?>
                       
                       
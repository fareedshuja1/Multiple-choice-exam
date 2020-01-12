<?php
include("includes/config.php"); 

$sid = $_SESSION['student_id'];
$emid = $_REQUEST['emid'];
$total_quess = $_REQUEST['total_quess'];
?>

                    <table border="0" cellpadding="30" cellspacing="30" id="" style="" >
                     
                    <?php
					   
					$q = mysql_query("SELECT q.`std_qno`,q.`std_status` FROM `question_paper` AS q 
                    WHERE q.`em_id`= $emid AND q.`student_id`= '$sid'") or die(mysql_error());
					   
	                $count = 0;
	                $shows = 1;
					   
	                while ($shows <= $total_quess && $row = mysql_fetch_assoc($q)){ 
      	   
		            if($count == 10) {
                    $count = 0;
                    echo "</tr> <tr>";
                    }
		   
		            if($row['std_status'] == NULL) {
       	            echo "<td style='background-color:#A9D86E;border-radius: 20px;padding: 15px'>".$row['std_qno']."</td>";
		            } else {
		            echo "<td style='background-color:#FF6C60;border-radius: 20px;padding: 15px'>".$row['std_qno']."</td>";
		            }
       	 
		            $count++;
		            $shows++;
	                }
                    
					?>
                       </table>

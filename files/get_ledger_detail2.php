<?php
include("../includes/connection.php");
if(isset($_REQUEST['ccid'])) {
$ccid = $_REQUEST['ccid'];
$scd_id = $_REQUEST['scd_id'];

$query = mysql_query("SELECT scd.`discounted_fee`,scd.rem_fee FROM `student_course_detail` AS scd WHERE scd.`ccid` = $ccid AND scd.`scd_id`=$scd_id") or die(mysql_error());

$fetch = mysql_fetch_array($query);
$dis_amt = $fetch['discounted_fee'];
$rem_amt = $fetch['rem_fee'];

if($dis_amt == $rem_amt) {
	echo "<tr>";
	echo "<td>No Ledger Found</td>";
	echo "</tr>";
	echo "<tr style='background-color:#333;color:#fff'>";
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "<td><b>Rs. $dis_amt /-</b></td>";
	echo "<td><b>Rs. 0 /-</b></td>";
	echo "<td><b>Balance Fee:  &nbsp;&nbsp; Rs. $rem_amt /- </b></td>";
	echo "</tr>";
	
} else {

            $query = mysql_query("SELECT l.`ledger_id`,l.`paid_amt` AS tot_payment,NULL AS paid_amt,l.`payment_date` FROM `student_ledger` AS l
								  WHERE l.scd_id=$scd_id AND l.`payment_type`='T'
								  UNION
								  SELECT l.`ledger_id`,NULL AS tot_payment,l.`paid_amt` AS paid_amt,l.`payment_date` FROM `student_ledger` AS l
								  WHERE l.scd_id=$scd_id AND l.`payment_type`='P'") or die(mysql_error());
		
		    while($row = mysql_fetch_assoc($query)) {
			
			$total_fee_amount += $row['tot_payment'];
			$total_paid_amount += $row['paid_amt'];
			
			$new_date = date('d-m-Y',strtotime($row['payment_date']));
			
			echo "<tr>";
			echo "<td>$row[ledger_id]</td>";
			echo "<td>$new_date</td>";
			echo "<td>$row[tot_payment]</td>";
			echo "<td colspan='3'>$row[paid_amt]</td>";
			echo "</tr>";
		    }

			$final_amount = $total_fee_amount-$total_paid_amount;
			echo "<tr style='background-color:#333;color:#fff'>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td><b>Rs. $total_fee_amount /-</b></td>";
			echo "<td><b>Rs. $total_paid_amount /-</b></td>";
			echo "<td> &nbsp; &nbsp;<b>Balance Fee:  &nbsp;&nbsp; Rs. $final_amount /- </b></td>";
			echo "</tr>";
			}
}

?>                     
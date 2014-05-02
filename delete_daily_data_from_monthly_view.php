<?php
include('connect_to_shady_grove.php'); // Connects to your Database

	$mydate = $_GET['month'];
	$mydate = trim($mydate,"\\'");
	$time = strtotime($mydate);
	$month = date('n',$time);
	$year = date('Y',$time);
	
	$mydate1 = $year."-".$month."-01";
	$mydate2 = $year."-".$month."-31";
	
	
	$query = "DELETE FROM daily_data
				WHERE
					d_date
				BETWEEN \"$mydate1\" AND \"$mydate2\"";
	$result = @mysqli_query ($dbc, $query);
	
	if($result) {		
		header('Location:home.php');
	}
	

?>
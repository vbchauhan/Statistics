<?php
include('connect_to_shady_grove.php'); // Connects to your Database

	$mydate = $_GET['year'];
	$mydate = trim($mydate,"\\'");
	$time = strtotime($mydate);
	$year = date('Y',$time);
	
	$mydate1 = $year."-01-01";
	$mydate2 = $year."-12-31";
	
	
	$query1 = "DELETE FROM daily_data
				WHERE
					d_date
				BETWEEN \"$mydate1\" AND \"$mydate2\"";
	$result1 = @mysqli_query ($dbc, $query1);
	
	$query2 = "DELETE FROM monthly_data
				WHERE m_year = $year";
	$result2 = @mysqli_query ($dbc, $query2);
	
	if($result1 && $result2) {		
		header('Location:home.php');
	}
	

?>
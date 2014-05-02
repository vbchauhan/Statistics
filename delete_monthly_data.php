<?php
include('connect_to_shady_grove.php'); // Connects to your Database

	$mydate = $_GET['month'];
	$mydate = trim($mydate,"\\'");
	$time = strtotime($mydate);
	$month = date('n',$time);
	$year = date('Y',$time);
	
	$query = "DELETE FROM monthly_data
				WHERE month_id = $month AND m_year = $year";
	$result = @mysqli_query ($dbc, $query);
	
	if($result) {
						
	header('Location:home.php');
	}

?>

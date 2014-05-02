<?php
include('connect_to_shady_grove.php'); // Connects to your Database

	$date_1 = $_GET['date1'];
	$newdate1 = trim($date_1,"\\'");
	$time1 = strtotime($newdate1);
	$mydate1 = date('Y-m-d',$time1);
	
	$date_2 = $_GET['date2'];
	$newdate2 = trim($date_2,"\\'");
	$time2 = strtotime($newdate2);
	$mydate2 = date('Y-m-d',$time2);
	
	
	$query = "DELETE FROM daily_data
				WHERE
					d_date
				BETWEEN \"$mydate1\" AND \"$mydate2\"";
				
	$result = @mysqli_query ($dbc, $query);
	
	if($result) {		
		header('Location:home.php');
	}
	

?>
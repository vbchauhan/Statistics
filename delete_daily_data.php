<?php
include('connect_to_shady_grove.php'); // Connects to your Database

	$mydate = $_GET['date'];
	$mydate = trim($mydate,"\\'");
	$time = strtotime($mydate);
	$date = date('Y-m-d',$time);
	
	$query = "DELETE FROM daily_data
				WHERE d_date = \"$date\"";
	$result = @mysqli_query ($dbc, $query);
	
	if($result) {
						
	header('Location:home.php');
	}

?>


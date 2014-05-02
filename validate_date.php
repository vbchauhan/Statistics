<?php
$monthArray = array( 1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$key = array_search($_POST['month'], $monthArray);

$mydate = $_POST['month']." ".$_POST['day']." ".$_POST['year'];
$time = strtotime($mydate);
//$txtDate = date('m/d/Y',$time);
$month = date('n',$time);
$day = date('d',$time);
$year = date('Y',$time);

if($month == $key){//Date is valid
	//header('Location:date_selected.php?date='.$mydate);
	$url = $_SERVER['HTTP_REFERER']; 
	
	$pieces = preg_split('/[\/ ?]/', $url);
    
	if($pieces[4] == "enter_daily_data.php")
	//echo "hello 1";
		header('Location:date_selected.php?date='.$mydate);	
	else
		header('Location:view_date_selected.php?date='.$mydate);
		//echo "hello 2";
		
}
else {//Date is invalid
		echo "<script>alert('Please enter valid date!');history.back();</script>";
}

?>
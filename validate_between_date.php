<?php
include('connect_to_shady_grove.php');
include('phpgraphlib.php');
//ambarish

$mydate1 = $_GET['month1']." ".$_GET['day1'].", ".$_GET['year1'];
$mydate2 = $_GET['month2']." ".$_GET['day2'].", ".$_GET['year2'];
$time1 = strtotime($mydate1);
$time2 = strtotime($mydate2);

$monthArray = array( 1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$key1 = array_search($_GET['month1'], $monthArray);
$key2 = array_search($_GET['month2'], $monthArray);

$month1 = date('n',$time1);
$day1 = date('d',$time1);
$year1 = date('Y',$time1);

$month2 = date('n',$time2);
$day2 = date('d',$time2);
$year2 = date('Y',$time2);

if($month1 == $key1 && $month2 == $key2){//Date is valid

	$url = $_SERVER['HTTP_REFERER']; 
	
	$pieces = preg_split('/[\/ ?]/', $url);
    echo "<script>alert('".$pieces[4]."')</script>";
	if($pieces[4] == "view_between_dates.php")
		//header('Location:view_between_dates_selected.php?date1='.$mydate1.'&date2='.$mydate2);
		$flag = 1;
	else {
		$p_id = $_GET['parameter'];
		$flag = 0;
	}
}
else {//Date is invalid
		echo "<script>alert('Please enter valid date!');history.back();</script>";
		$flag = 2;
}

if($flag != 2)
{
if ($time2 > $time1) {
     if($flag == 1)
	 	header('Location:view_between_dates_selected.php?date1='.$mydate1.'&date2='.$mydate2);
	 else
	 	header('location:./generate_daily_over_week.php?date1='.$mydate1.'&date2='.$mydate2.'&parameter='.$p_id);
} else {
     echo "<script>alert('Please enter valid from and to dates!');history.back();</script>";
}
}

?>
<?php
include('connect_to_shady_grove.php'); // Connects to your Database
//include('header_askLogin.php') //Header
if(isset($_GET['date1'])){
	if(isset($_GET['date2'])){
	$mydate1 = $_GET['date1'];
	$mydate2 = $_GET['date2'];
	$time1 = strtotime($mydate1);
	$time2 = strtotime($mydate2);
	$date1 = date('Y-m-d',$time1);
	$date2 = date('Y-m-d',$time2);
	//$query="select s.s_id, s.s_name,p.p_name,sum(d.d_count) as d_count from daily_data d inner join slot s on d.s_id=s.s_id inner join parameter p on d.p_id=p.p_id WHERE d_date BETWEEN \"$date1\" AND \"$date2\" group by s.s_id, s.s_name,p.p_name order by s.s_id asc";
	$query="select t.s_name,max(IF(t.p_id = 1, t.d_count,NULL)) as GeneralAreaUsers,max(IF(t.p_id = 2, t.d_count,NULL)) as ComputerUsage,max(IF(t.p_id = 3, t.d_count,NULL)) as GroupStudyRooms,max(IF(t.p_id = 4, t.d_count,NULL)) as GroupStudyRoomUsers,max(IF(t.p_id = 5, t.d_count,NULL)) as Room1200H,t.s_id from (select s.s_id, s.s_name,p.p_id,p.p_name,sum(d.d_count) as d_count from daily_data d inner join slot s on d.s_id=s.s_id inner join parameter p on d.p_id=p.p_id WHERE d_date BETWEEN \"$date1\" AND \"$date2\" group by s.s_id, s.s_name,p.p_name order by s.s_id asc) t group by t.s_name order by t.s_id";
	
	
	//echo $query;
	}
}
	else{	

$mydate = $_GET['date'];
	$mydate = trim($mydate,"\\'");
	$time = strtotime($mydate);
	$date = date('Y-m-d',$time);

$query="select s.s_id,s.s_name,p.p_name,d.d_count from daily_data d inner join slot s on d.s_id=s.s_id inner join parameter p on d.p_id=p.p_id WHERE d_date = \"$date\"";
}//end of else block

$result = @mysqli_query($dbc, $query); //Runs the Query
$filename ="excelreport.xls";
$contents = "TimeSlot \t GeneralAreaUsers \t ComputerUsage \t GroupStudyRooms \t GroupStudyRoomUsers \t Room1200H\n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $contents;

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
echo $row['s_name'];
echo " \t ";
echo $row['GeneralAreaUsers'];
echo " \t ";
echo $row['ComputerUsage'];
echo " \t ";
echo $row['GroupStudyRooms'];
echo " \t ";
echo $row['GroupStudyRoomUsers'];
echo " \t ";
echo $row['Room1200H'];
echo " \n ";
	}
?>

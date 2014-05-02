<?php
include('connect_to_shady_grove.php');
include('phpgraphlib.php');
//ambarish
$link = mysql_connect('localhost', 'root', 'root');
/*if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';*/
//code ends
//Ambarish selecting the database
$dbname = 'sglstatistics';
mysql_select_db($dbname);
//code ends

$graph=new PHPGraphLib(1000,600); 
$dataArray=array();
 
$mydate = $_GET['month']." ".$_GET['year'];
	$time = strtotime($mydate);
	$month = date('m',$time);
	$year = date('Y',$time);
	
	$mydate1 = $year."-".$month."-"."01";
	
	$p_id = $_GET['parameter'];
	
	$new_date = $mydate1;
	$new_month = $month;
	while($new_month == $month)
	{
		$dataArray[$new_date]= 0;
		$new_date = strtotime(date("Y-m-d", strtotime($new_date)) . " +1 day");
		$new_date = date('Y-m-d',$new_date);
		$time = strtotime($new_date);
		$new_month = date('m',$time);
	}
	
	$mydate2 = strtotime(date("Y-m-d", strtotime($new_date)) . " -1 day");
	$mydate2 = date('Y-m-d',$mydate2);
	
//get data from database
$query="SELECT d_date, SUM(d_count) as d_count
            FROM daily_data
            WHERE d_date BETWEEN \"$mydate1\" AND \"$mydate2\"
            AND p_id = $p_id
			GROUP BY d_date";
			
						
$result = @mysqli_query ($dbc, $query);
if ($result) {
  while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
  {
	  if($row["d_count"] != NULL)
	{
       	$date=$row["d_date"];
	  	$count=ltrim($row["d_count"], "0");
	  	//add to data array
      	$dataArray[$date]=$count;
	}
  }
}
//rikin's code
/*$query = "SELECT p_name from PARAMETER
			WHERE p_id = $p_id";
$result = @mysqli_query ($dbc, $query);
$row = mysqli_fetch_array($result, MYSQL_ASSOC);
$param_name = $row['p_name'];*/
$query = "SELECT p_name from parameter
			WHERE p_id = $p_id";
$result = mysql_query($query);			
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$param_name = $row["p_name"];
/*if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
	$message .= 'Whole query: ' . $param_name;
    die($message);
}*/

//configure graph
$graph->addData($dataArray);
$graph->setTitle("Daily over Week (Zero indicates either absence of data or zero count values)");
$graph->setBars(false);
$graph->setLine(true);
$graph->setDataPoints(true);
$graph->setDataPointColor('maroon');
$graph->setDataValues(true);
$graph->setDataValueColor('maroon');
//$graph->setGoalLine(.0025);
$graph->setGoalLineColor('red');
$graph->setLegend(true);
$graph->setLegendTitle($param_name);

$graph->createGraph();


?>

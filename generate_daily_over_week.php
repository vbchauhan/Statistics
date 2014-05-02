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
 
	$mydate1 = $_GET['date1'];
	$mydate2 = $_GET['date2'];
	$time1 = strtotime($mydate1);
	$time2 = strtotime($mydate2);
	$date1 = date('Y-m-d',$time1);
	$date2 = date('Y-m-d',$time2);
	
	$p_id = $_GET['parameter'];

	$new_date = $date1;
	while($new_date != $date2)
	{
		$dataArray[$new_date]= 0;
		$new_date = strtotime(date("Y-m-d", strtotime($new_date)) . " +1 day");
		$new_date = date('Y-m-d',$new_date);
	}
	$dataArray[$date2]= 0;
	
	
	
	
//get data from database
$query="SELECT d_date, SUM(d_count) as d_count
            FROM daily_data
            WHERE d_date BETWEEN \"$date1\" AND \"$date2\"
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
$query = "SELECT p_name from PARAMETER
			WHERE p_id = $p_id";
$result = @mysqli_query ($dbc, $query);
$row = mysqli_fetch_array($result, MYSQL_ASSOC);
$param_name = $row['p_name'];
// Ambarish modified code
/*$query = "SELECT p_name from parameter
			WHERE p_id = $p_id";
$result = mysql_query($query);			
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$param_name = $row["p_name"];*/
//code ends here

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
$graph->setGoalLineColor('maroon');
$graph->setLegend(true);
$graph->setLineColor('maroon');
$graph->setLegendTitle($param_name);
//$graph->setXValuesHorizontal(true);

$graph->createGraph();


?>

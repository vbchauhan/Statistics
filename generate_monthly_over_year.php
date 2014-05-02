<?php
include('connect_to_shady_grove.php');
include('phpgraphlib.php');
//ambarish
$link = mysql_connect('localhost', 'root', 'root');
/*if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';*/
$dbname = 'sglstatistics';
mysql_select_db($dbname);
//mysql_close($link);
//code ends
$graph=new PHPGraphLib(1000,600); 
$dataArray=array('January' => 0, 'February' =>0, 'March' =>0, 'April' =>0, 'May' =>0, 'June' =>0, 'July' =>0, 'August' =>0, 'September' =>0, 'October' =>0, 'November' =>0, 'December' =>0);

//print_r($dataArray);
 
$mydate = $_GET['year']; 
	
	/*$mydate1 = $mydate."-01-01";
	$mydate2 = $mydate."-12-31";*/
	
	$p_id = $_GET['parameter'];
	//echo $p_id;
	
	$query2 = "SELECT p_type FROM parameter WHERE p_id = $p_id";
	$result2 = @mysqli_query ($dbc, $query2);
	$row = mysqli_fetch_array($result2, MYSQL_ASSOC);
	
	//echo $row['p_type'];
	
if($row['p_type'] == "Daily")//If the parameter type is Daily
{
	//Get month from Month table
	$query = "SELECT month_id, month_name
				FROM
					month";
	$result = @mysqli_query ($dbc, $query);
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
		
		$month_name = $row["month_name"];
		
		//echo $month_name; echo "<br>";
		
		$month_id = $row["month_id"];
		
	//echo $month_id; echo "<br>";
		
		$newdate1 = $mydate."-".$month_id."-"."01";
		$newdate2 = $mydate."-".$month_id."-"."31";
		
		//echo "$newdate1"; echo "<br>";
		//echo "$newdate2"; echo "<br>";
		
		$query2 = "SELECT
							SUM(d_count) as count
						FROM
							daily_data
						WHERE
							d_date
						BETWEEN 
							\"$newdate1\" AND \"$newdate2\"
						AND
							p_id = $p_id";
							
		//echo "$query2"; echo "<br>";
							
	$result1 = @mysqli_query ($dbc, $query2);
	if ($result1) {
  	while ($row = mysqli_fetch_array($result1, MYSQL_ASSOC)) 
  	{
		if($row["count"] != NULL)
		{
	  		$date=$month_name;
	  		$count=ltrim($row["count"], "0");
	  		//add to data array
      		$dataArray[$date]=$count;
		}
  	}
	//print_r($dataArray);
	}
	}
}
else//If the parameter type is Monthly
{
	//get data from database
	$query="SELECT m.month_name, md.m_count
			FROM monthly_data md, month m
			WHERE 
				m.month_id = md.month_id
				AND m_year = \"$mydate\"
				AND p_id = $p_id
				ORDER BY md.month_id";
	//echo $query;
			
$result = @mysqli_query ($dbc, $query);
if ($result) {
  while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
  {
	  	$date=$row["month_name"];
	  	$count=ltrim($row["m_count"], "0");
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
$param_name = $row["p_name"];*/
//this is ambarish's code
$query = "SELECT p_name from parameter
			WHERE p_id = $p_id";
$result = mysql_query($query);			
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$param_name = $row["p_name"];
//echo $param_name1;
/*if ($result1) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query1;
	$message .= 'Whole query: ' . $param_name1;
    die($message);
}*/

			




//configure graph
$graph->addData($dataArray);
$graph->setTitle("Monthly over Year (Zero indicates either absence of data or zero count values)");
//$graph->setBackgroundColor("gray");
$graph->setBarColor("maroon");
$graph->setTitleColor('maroon');
$graph->setupYAxis(12, 'maroon');
$graph->setupXAxis(20, 'maroon');
$graph->setBars(true);
$graph->setLine(false);
$graph->setDataPoints(true);
$graph->setDataPointColor('black');
$graph->setDataValues(true);
$graph->setDataValueColor('black');
//$graph->setGoalLine(.0025);
$graph->setGoalLineColor('red');
$graph->setLegend(true);
$graph->setLegendTitle($param_name);
$graph->createGraph();

?>

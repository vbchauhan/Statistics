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
 
$mydate1 = $_GET['year1']; 
$mydate2 = $_GET['year2'];
$p_id = $_GET['parameter'];

for($i=$mydate1; $i<=$mydate2; $i++)
{	
	$years[] = $i;
	$dataArray[$i]=0;
}

//print_r($years);
//print_r($dataArray);

	$query2 = "SELECT p_type FROM parameter WHERE p_id = $p_id";
	$result2 = @mysqli_query ($dbc, $query2);
	$row = mysqli_fetch_array($result2, MYSQL_ASSOC);
	
	
if($row['p_type'] == "Daily")//If the parameter type is Daily
{
	foreach($years AS $year)
	{
		$newdate1 = $year."-01-01";
		$newdate2 = $year."-12-31";
		
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
	  				$date=$year;
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
	$query="SELECT m_year, SUM(m_count) AS count
				FROM monthly_data
				WHERE
				 m_year BETWEEN \"$mydate1\" AND \"$mydate2\"
				 AND p_id = $p_id
				 GROUP BY m_year";
	//echo $query;
			
$result = @mysqli_query ($dbc, $query);
if ($result) {
  while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
  {
	  if($row["count"] != NULL)
	  {
	  	$date=$row["m_year"];
	  	$count=ltrim($row["count"], "0");
	  	//add to data array
      	$dataArray[$date]=$count;
	  }
  }
  //print_r($dataArray);
}
}
// rikin's code
/*$query = "SELECT p_name from PARAMETER
			WHERE p_id = $p_id";
$result = @mysqli_query ($dbc, $query);
$row = mysqli_fetch_array($result, MYSQL_ASSOC);
$param_name = $row['p_name']; */
// Ambarish modified code
$query = "SELECT p_name from parameter
			WHERE p_id = $p_id";
$result = mysql_query($query);			
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$param_name = $row["p_name"];
//code ends here


//configure graph
$graph->addData($dataArray);
$graph->setTitle("Yearly over Year (Zero indicates either absence of data or zero count values)");
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

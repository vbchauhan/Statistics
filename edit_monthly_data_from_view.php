<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Monthly Data</title>
</head>

<body>
<?php
include('connect_to_shady_grove.php'); // Connects to your Database
include('header.php') //Header

?>

<style type="text/css">
<!--
.tabletitle {
	font-size: 18px;
}
.tabletitle {
	font-size: 20px;
	color:#FFF;
}
.tabletitle2 {
	font-size: 18px;
}
.shaded{
	background-color:#BBBBBB;
}
-->
</style>
<?php

	$mydate = $_GET['month'];
	$time = strtotime($mydate);
	$month = date('n',$time);
	$year = date('Y',$time);
	
	$mydate1 = $year."-".$month."-"."01";
	$mydate2 = $year."-".$month."-"."31";
	
	$query = "SELECT 
    			COUNT(p_name) AS count
			  FROM
    			parameter";
	$result = @mysqli_query ($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	$param_count = $row['count']+1;
?>

<div align="center" style="border:2px solid #000; width:100%; height:100%; margin-top:20px">

<table width="80%" border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div style="float:left" class="tabletitle">You are viewing aggregated values of data collected daily for <?php echo $mydate;?>!</div>
    </td>
  </tr> 
  
  <tr style='font-size:14px'>
  	<td><b>Parameters</b></td>
    <td><b>Parameter Type</b></td>
    <td><b>Count Values</b></td>
  </tr>
  
  <?php
  	$query = "SELECT 
    				p_id, p_name, p_type 
			  FROM
    			parameter
			WHERE p_type = 'Daily'";
	$result = @mysqli_query ($dbc, $query);
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
		echo "<tr style='font-size:12px'>";
			echo "<td bgcolor='#DDDDDD' align='left'>".$row['p_name']."</td>";
			echo "<td bgcolor='#DDDDDD' align='left'>".$row['p_type']."</td>";
			
			$p_id = $row['p_id'];
			$p_type = $row['p_type'];
				
				$query2 = "SELECT
							SUM(d_count) as COUNT
						FROM
							daily_data
						WHERE
							d_date
						BETWEEN 
							\"$mydate1\" AND \"$mydate2\"
						AND
							p_id = $p_id";
							
				$result2 = @mysqli_query ($dbc, $query2); // for daily data
				$row_count1 = mysqli_num_rows($result2); // for daily data
				
				$row2 = mysqli_fetch_array ($result2, MYSQL_NUM);
				$count_value1 = ltrim($row2[0], "0");
				
				if ($count_value1 == NULL) 
			{
				
				echo "<td bgcolor='#DDDDDD' align = 'center' width='15%'>0</td>";
			}
			else 
			{
				echo "<td  bgcolor='#DDDDDD' align = 'center' width='15%'>".$count_value1."</td>";
			}
				
		echo "</tr>";
	}
  ?>
 
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div align="center" class="tabletitle">
    </div></td>
  </tr>
  
</table>


<form action="update_monthly_data_from_view.php" method="post">
<table width="80%" border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div style="float:left" class="tabletitle">You are viewing aggregated values of data collected for <?php echo $mydate;?>!</div>
    
    </td>
  </tr> 
  
  <tr style='font-size:14px'>
  	<td><b>Parameters</b></td>
    <td><b>Parameter Type</b></td>
    <td><b>Count Values</b></td>
  </tr>
  
  <?php
  	$query = "SELECT 
    				p_id, p_name, p_type 
			  FROM
    			parameter
				WHERE p_type = 'Monthly'";
	$result = @mysqli_query ($dbc, $query);
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
		echo "<tr style='font-size:12px'>";
			echo "<td align='left'>".$row['p_name']."</td>";
			echo "<td align='left'>".$row['p_type']."</td>";
			
			$p_id = $row['p_id'];
			$p_type = $row['p_type'];
				
				
			$query1 = "SELECT
							m_count
						FROM
							monthly_data
						WHERE
							p_id = $p_id
						AND	month_id = $month
						AND m_year = $year";
			
						
			$result1 = @mysqli_query ($dbc, $query1); // for monthly data
			
			$row_count = mysqli_num_rows($result1); // for monthly data
				
			
			// then run for monthly data since parameters of monthly data are listed second for parameter table	
			if (mysqli_num_rows($result1) == "1")
			{
				$row1 = mysqli_fetch_array ($result1, MYSQL_NUM);
				$count_value = ltrim($row1[0], "0");
				echo "<td align = 'center' width='15%'><input type = 'text' name ='".$p_id."' value = '".$count_value."'></td>";
			}
			else 
			{
				echo "<td align = 'center' width='15%'><input type = 'text' name ='".$p_id."' value = '0'></td>";
			}
				
		echo "</tr>";
		}
  ?>
 
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div align="center" class="tabletitle">
     <input type="submit" style="font-size:18px" name="submit" value="Submit" />
    <input type="hidden" name="month" value="<?php echo $mydate;?>" />
    </div></td>
  </tr>
  
</table>
</form>

</div>
</body>
</html>
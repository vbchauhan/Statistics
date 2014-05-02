<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Month Selected</title>
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
-->
</style>
<?php

//Query to check whether the data already exists in the database
$mydate = $_POST['month']." ".$_POST['year'];
$time = strtotime($mydate);
$month = date('n',$time);
$year = date('Y',$time);

$query = "SELECT
			*
		  FROM
		  	monthly_data
		WHERE
			month_id = $month
		AND m_year = $year";
$result = @mysqli_query ($dbc, $query);
$row_count = mysqli_num_rows($result);

//This part of the loop executes if data exists in the database for specified date 
if($row_count >= 1)
{
	header('Location:preview_monthly_data.php?month='.$mydate);
}
//This part of the loop executes if data does not exist in the database for specified date
else
{
	$query = "SELECT 
    			COUNT(p_name) AS count
			  FROM
    			parameter
			  WHERE
                p_type='Monthly'";
	$result = @mysqli_query ($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	$param_count = $row['count']+1;
?>

<div align="center" style="border:2px solid #000; width:100%; height:100%; margin-top:20px">
<form action="insert_monthly_data.php" method="post">
<table width="70%" border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div align="right" class="tabletitle"><?php echo $_POST['month'].", ".$_POST['year'];?></div></td>
  </tr>
  
  <tr style='font-size:14px'>
  	<td><b>Parameters</b></td>
    <td><b>Count Values</b></td>
  </tr>
  
  <?php
  	$query = "SELECT 
    				p_id, p_name 
			  FROM
    			parameter
			  WHERE
			  	p_type='Monthly'";
	$result = @mysqli_query ($dbc, $query);
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
		echo "<tr style='font-size:12px'>";
			echo "<td align='left'>".$row['p_name']."</td>";
			echo "<td width='35%'><input type='text' size=50 name='".$row['p_id']."' /></td>";	
		echo "</tr>";
	}
  ?>
 
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div align="center" class="tabletitle"><input type="submit" style="font-size:18px" name="submit" value="Submit"/><input type="hidden" name="month" value="<?php echo $_POST['month']." ".$_POST['year'];?>" /></div></td>
  </tr>
  
</table>
</form>
</div>
</body>
</html>

<?php
}

?>
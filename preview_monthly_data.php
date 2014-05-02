<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Preview Monthly Data</title>
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

	$mydate = $_GET['month'];
	$time = strtotime($mydate);
	$month = date('n',$time);
	$year = date('Y',$time);
	
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

<table width="80%" border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div style="float:left" class="tabletitle">The following data has been submitted successfully for <?php echo $mydate;?>!</div>
    <div style="float:right; padding-right:10px">
    <a href="edit_monthly_data.php?month=<?php echo $mydate; ?>">
    <img align="middle" src="images/edit-icon.png" /><span style="color:#FFF; font-size:14px">Edit Data</span></a>
     <script language="javascript" type="text/javascript">
<!--
function sure(){
var sure = confirm("Are you sure you want to delete the data for <?php echo $mydate; ?>?\r\n\r\nThis will permanantly delete from the database!");
if(sure) location.replace("delete_monthly_data.php?month=<?php echo $mydate; ?>");
}
//-->
</script>
    
    <!-- Changes made to hide the Delete Data button from the web page
	<a href="javascript:void(0)" onclick="sure()"><img align="middle" src="images/delete-icon.png" /><span style="color:#FFF; font-size:14px">Delete Data</span></a> //-->
    </div>
    
    </td>
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
			
			$p_id = $row['p_id'];
			$query1 = "SELECT
							m_count
						FROM
							monthly_data
						WHERE
							p_id = $p_id
						AND	month_id = $month
						AND m_year = $year";
						
			$result1 = @mysqli_query ($dbc, $query1);
			$row_count = mysqli_num_rows($result1);
				
			if (mysqli_num_rows($result1) == "1")
			{
				$row1 = mysqli_fetch_array ($result1, MYSQL_NUM);
				$count_value = ltrim($row1[0], "0");
				echo "<td align = 'center' width='15%'>".$count_value."</td>";
			}
			else 
			{
				echo "<td align = 'center' width='15%'>0</td>";
			}
				
		echo "</tr>";
	}
  ?>
 
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div align="center" class="tabletitle"></div></td>
  </tr>
  
</table>

</div>
</body>
</html>

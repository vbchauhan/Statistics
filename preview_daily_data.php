<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Preview Daily Data</title>
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



	$mydate = $_GET['date'];
	$time = strtotime($mydate);
	$date = date('Y-m-d',$time);
	
	$query = "SELECT 
    			COUNT(p_name) AS count
			  FROM
    			parameter
			  WHERE
                p_type='Daily'";
	$result = @mysqli_query ($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	$param_count = $row['count'];
	
	$query = "SELECT 
    			COUNT(s_name) AS count
			  FROM
    			slot";
	$result = @mysqli_query ($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	$slot_count = $row['count']+1;
?>

<div align="center" style="border:2px solid #000; width:100%; height:100%; margin-top:20px">
<table width="90%" border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count+1;?>"><div class="tabletitle" style="float:left">The following data has been submitted successfully for <?php echo $mydate;?>!</div>
    <div style="float:right; padding-right:10px">
    <a href="edit_daily_data.php?date=<?php echo $mydate; ?>">
    <img align="middle" src="images/edit-icon.png" /><span style="color:#FFF; font-size:14px">Edit Data</span></a>
    
    <script language="javascript" type="text/javascript">
<!--
function sure(){
var sure = confirm("Are you sure you want to delete the data for <?php echo $mydate; ?>?\r\n\r\nThis will permanantly delete from the database!");
if(sure) location.replace("delete_daily_data.php?date=<?php echo $mydate; ?>");
}
//-->
</script>
    <!--Changes made to hide the Delete Data button from the web page
    <a href="javascript:void(0)" onclick="sure()"><img align="middle" src="images/delete-icon.png" /><span style="color:#FFF; font-size:14px">Delete Data</span></a> //-->
    </div>
    
    </td>
  </tr>
  
  <tr style="font-size:11px">
  	<td width="11%"></td>
    <?php
		$query = "SELECT 
    				p_name 
			    FROM
    				parameter
				WHERE
                	p_type='Daily'";
		$result = @mysqli_query ($dbc, $query);
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
		{
			echo "<td width='9%'><b>".$row['p_name']."</b></td>";
		}
	?>
  </tr>
  
  <?php
  $query = "SELECT 
    				p_id 
			    FROM
    				parameter
				WHERE
                	p_type='Daily'";
		$result = @mysqli_query ($dbc, $query);
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
		{
			$p_ids[] = $row['p_id'];
		}
		
  	$query = "SELECT 
    				s_id, s_name 
			  FROM
    			slot
			  ORDER BY 
				s_id";
	$result = @mysqli_query ($dbc, $query);
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
		echo "<tr style='font-size:11px'>";
			echo "<td width='9%' align='center'><b>".$row['s_name']."</b></td>";
			for($i=0; $i<$param_count; $i++)
			{
				$s_id = $row['s_id'];
				$p_id = $p_ids[$i];
				$query1 = "SELECT
							d_count
						FROM
							daily_data
						WHERE
							d_date = \"$date\"
						AND	s_id = $s_id
						AND p_id = $p_id";
						
				$result1 = @mysqli_query ($dbc, $query1);
				$row_count = mysqli_num_rows($result1);
				
				if (mysqli_num_rows($result1) == "1")
				{
					$row1 = mysqli_fetch_array ($result1, MYSQL_NUM);
					$count_value = ltrim($row1[0], "0");
				 	echo "<td align = 'center' width='9%'>".$count_value."</td>";
				}
				else {
					
					echo "<td align = 'center' width='9%'>0</td>";
				}
				
			}			 
		echo "</tr>";
	}
	
		
	
  ?>
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count+1;?>"><div align="center" class="tabletitle">
    </div></td>
  </tr>
  
</table>
</div>
</body>
</html>


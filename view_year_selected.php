<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Yearly Data</title>
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

	$mydate = $_GET['year'];
	
	$mydate1 = $mydate."-01-01";
	$mydate2 = $mydate."-12-31";
	
	$query = "SELECT 
    			COUNT(p_name) AS count
			  FROM
    			parameter";
	$result = @mysqli_query ($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	$param_count = $row['count']+1;
?>

<div align="center" style="border:2px solid #000; width:100%; height:100%; margin-top:20px">

<table id="MyTable" width="70%" border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div style="float:left" class="tabletitle">View the data for <?php echo $mydate;?>!</div>
    <div style="float:right; padding-right:10px">

     <script language="javascript" type="text/javascript">
<!--
function issure(){
var issure = confirm("Are you sure you want to delete the data for <?php echo $mydate; ?>?\r\n\r\nThis will permanantly delete from the database!");
if(issure) location.replace("delete_year_selected.php?year=<?php echo $mydate; ?>");
}
//-->
</script>
    

    </div>
    
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
    			parameter";
	$result = @mysqli_query ($dbc, $query);
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
		echo "<tr style='font-size:12px'>";
			echo "<td align='left'>".$row['p_name']."</td>";
			echo "<td align='left'>".$row['p_type']."</td>";
			
			$p_id = $row['p_id'];
			$p_type = $row['p_type'];
			if($p_type == "Daily") {
				
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
				if($count_value1 != NULL)
					echo "<td align = 'center' width='15%'>".$count_value1."</td>";
				
				else 
				{
					echo "<td align = 'center' width='15%'>0</td>";
				}
		}
		else {		
				
			$query1 = "SELECT
							SUM(m_count) as COUNT
						FROM
							monthly_data
						WHERE
							p_id = $p_id
						AND m_year = $mydate";
			
						
			$result1 = @mysqli_query ($dbc, $query1); // for monthly data
			
			$row_count = mysqli_num_rows($result1); // for monthly data
				
			
			// then run for monthly data since parameters of monthly data are listed second for parameter table	
			$row1 = mysqli_fetch_array ($result1, MYSQL_NUM);
			$count_value = ltrim($row1[0], "0");
			if($count_value != NULL)
				echo "<td align = 'center' width='15%'>".$count_value."</td>";
			
			else 
			{
				echo "<td align = 'center' width='15%'>0</td>";
			}
		}
				
		echo "</tr>";
	}
  ?>
 
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count;?>"><div align="right" class="tabletitle">
        <a href="javascript:void(0)" onclick="issure()"><img align="middle" src="images/delete-icon.png" /><span style="color:#FFF; font-size:14px">Delete Data</span></a>
	</div>
    
    </td>
  </tr>
  
</table>

</div>
<script type="text/javascript">
function displayResult()
{
var table=document.getElementById("MyTable");
var row=table.insertRow(2);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
cell1.innerHTML="Total Number Of Patrons";
cell2.innerHTML="Daily";
//cell2.innerHTML=table.rows[i].cells[j]
var cellvalue1 = table.rows[3].cells[2];
var cellvalue2 = table.rows[4].cells[2];
var cellvalue3 = table.rows[6].cells[2];
var cellvalue4 = table.rows[7].cells[2];
//alert(cellvalue1.firstChild.data);
cell3.innerHTML=parseInt(cellvalue1.firstChild.data)+parseInt(cellvalue2.firstChild.data)+parseInt(cellvalue3.firstChild.data)+parseInt(cellvalue4.firstChild.data);
cell3.align="center";
}
window.onload =displayResult;
</script>
</body>
</html>

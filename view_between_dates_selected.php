<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Selected date</title>
</head>

<body>
<?php
include('connect_to_shady_grove.php'); // Connects to your Database
include('header.php') //Header

?>

<style type="text/css">
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
.tabletitle3 {
	font-size:14px;
}
</style>
<?php
	$mydate1 = $_GET['date1'];
	$mydate2 = $_GET['date2'];
	$time1 = strtotime($mydate1);
	$time2 = strtotime($mydate2);
	$date1 = date('Y-m-d',$time1);
	$date2 = date('Y-m-d',$time2);
	
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
<table id="MyTable" width="100%" border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count+2;?>"><div style="float:left" class="tabletitle">View the data for date between <?php echo $mydate1." and ". $mydate2;?>!</div>
    <div style="float:right; padding-right:10px">
    
     <script language="javascript" type="text/javascript">
<!--
function sure(){
var sure = confirm("Are you sure you want to delete the data between <?php echo $mydate1; ?> and <?php echo $mydate2 ?>;?\r\n\r\nThis will permanantly delete from the database!");
if(sure) location.replace("delete_daily_data_between_dates.php?date1='<?php echo $mydate1;?>&date2='<?php echo $mydate2; ?>'");
}
//-->
</script>
    

    </div>
    </td>
  </tr>
  
  <tr style="font-size:11px">
  	<td width="9%"></td>
    <?php
		$query = "SELECT 
    				p_id, p_name 
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
				ORDER BY s_id";
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
							SUM(d_count) as count
						FROM
							daily_data
						WHERE
							d_date
						BETWEEN \"$date1\" AND \"$date2\"
						AND	s_id = $s_id
						AND p_id = $p_id";
						
				$result1 = @mysqli_query ($dbc, $query1);
				$row_count = mysqli_num_rows($result1);
				
				$row1 = mysqli_fetch_array ($result1, MYSQL_NUM);
				$count_value = ltrim($row1[0], "0");
				if($count_value == NULL) {
					echo "<td align = 'center' width='9%'>0</td>";
				}
				else	
					
				 	echo "<td align = 'center' width='9%'>".$count_value."</td>";

				
			}			 
		echo "</tr>";
	}
	
		
	
  ?>
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count+2;?>"><div align="right" class="tabletitle3">
   	    <a href="javascript:void(0)" onclick="sure()"><img align="middle" src="images/delete-icon.png" /><span style="color:#FFF; font-size:14px">Delete Data</span></a>
		<a href="downloadDate.php?date1=<?php echo $mydate1; ?>&date2=<?php echo $mydate2;?>"style="color: #FFFAFA" >Download XLS</a>
		
    </div></td>
  </tr>
  
</table>
</div>
<script type="text/javascript">
var sum=0;
function displayResult()
{
//var firstRow=document.getElementById("MyTable").rows[0];
//var x=firstRow.insertCell(-1);
//alert('a');
var table = document.getElementById('MyTable');
var len=document.getElementById('MyTable').rows.length;
var firstRow=document.getElementById("MyTable").rows[1];
var y=firstRow.insertCell(1);
y.innerHTML="<b>Total Number of Patrons</b>";
y.width='9%';
for(var i=1;i<len;i++){

}

for(var i=2;i<len;i++)
		{
		for(var j=1;j<8;j++){	
								if((j==1)||(j==2)||(j==4)||(j==5)){ 
/* the variable j is the position of the columns from which the data is needed*/

								var cell = table.rows[i].cells[j];
								var value = cell.firstChild.data;
								sum=sum+parseInt(value);
														}
							}
var Row=document.getElementById("MyTable").rows[i];
var x=Row.insertCell(1);
x.innerHTML=sum;
x.align="center";
sum=0;
//alert(sum);
		}
}
window.onload =displayResult;
</script>
</body>
</html>
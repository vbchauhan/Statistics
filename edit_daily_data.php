<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Daily Data</title>
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

<script Language = JavaScript>
var tvalue1;

function add(obj){

	var bid = obj.id;
    var array = bid.split("_");
    var tid = "t_";
    var tid = tid.concat(array[1]);
    var text = document.getElementById(tid);
   var tvalue = text.value;
    
    //alert(tid);
    
    

   if (!isNaN(tvalue)&& tvalue.length>0) { 


        tvalue = parseInt(tvalue) + 1;
       
       // alert(tvalue1);
        text.value=tvalue;
        
     
        
        

    } else {

       alert('Not A Number');

    }

}



function subtract(obj){

	var bid = obj.id;
    var array = bid.split("_");
    var tid = "t_";
    var tid = tid.concat(array[1]);
    var text = document.getElementById(tid);
    var tvalue = text.value;

    if (!isNaN(tvalue)&& tvalue.length>0 && tvalue!= 0) { 


        tvalue = (tvalue - 1).toFixed(0);
        text.value=tvalue;

    } else {

        alert('Not A Number');

    }

}


</script>

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
<form action="update_daily_data.php" method="post">
<div align="center" class="tabletitle"><input type="submit" style="font-size:18px" name="submit" value="Submit" /> </div>
<table width="90%" border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count+1;?>"><div class="tabletitle" style="float:left">The following data is available to edit for <?php echo $mydate;?>!</div>    
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
				 	echo "<td align = 'center' width='9%' align='center'><input type='button' size=14 id='b_".$row['s_id']."-".$p_ids[$i]."' name='".$row['s_id']."-".$p_ids[$i]."' value='+' onclick='add(this)' /><input type = 'text' size=14 id='t_".$row['s_id']."-".$p_ids[$i]."' name ='".$s_id."-".$p_id."' value = '".$count_value."'><input type='button' size=14 id='b_".$row['s_id']."-".$p_ids[$i]."' name='".$row['s_id']."-".$p_ids[$i]."' value='-' onclick='subtract(this)' /></td>";
				}
				else {
					
					echo "<td align = 'center' width='9%' align='center'><input type='button' size=14 id='b_".$row['s_id']."-".$p_ids[$i]."' name='".$row['s_id']."-".$p_ids[$i]."' value='+' onclick='add(this)' /><input type = 'text' size=14 id='t_".$row['s_id']."-".$p_ids[$i]."' name ='".$s_id."-".$p_id."' value = '0'><input type='button' size=14 id='b_".$row['s_id']."-".$p_ids[$i]."' name='".$row['s_id']."-".$p_ids[$i]."' value='-' onclick='subtract(this)' /></td>";
				}
				
			}			 
		echo "</tr>";
	}
	
		
	
  ?>
  <tr bgcolor="#990000" >
    <td height="52" colspan="<?php echo $param_count+1;?>"><div align="center" class="tabletitle"><input type="submit" style="font-size:18px" name="submit" value="Submit" />
    <input type="hidden" name="date" value="<?php echo $mydate;?>" />
    </div></td>
  </tr>
  
</table>
</form>
</div>
</body>
</html>


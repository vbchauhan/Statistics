<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View graph for Daily data over Month</title>
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

<div align="center" style="border:2px solid #000; width:71%; height:50%; margin-left:200px; margin-top:70px">
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; margin-bottom:20px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="3"><div align="center" class="tabletitle">Select parameters to generate graphs</div></td>
  </tr>
  <tr class="tabletitle2">
    <td width="36%" height="49" style="padding-top:3px; padding-bottom:3px; padding-right:5px"><div align="center"><img src="images/Calendar.png" width="87" height="81" align="right"/></div></td>
    <td width="64%"><div align="left">
     <form action="generate_daily_over_month.php" target="_blank" method="get">
     Parameter:
     <select name="parameter">
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
			echo '<option value="'.$row['p_id'].'">'.$row['p_name'];
		}
	  ?>   
      </select>
      
      <select name="month">
      	<?php
	  	$month=array( 1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		for($i=1; $i<13; $i++)
		{
			if(date("n")==$i)
        		echo '<option selected="selected" value="'.$month[$i].'">'.$month[$i];
			else
				echo '<option value="'.$month[$i].'">'.$month[$i];
		}
		?>
      </select>
      
      <select name="year">
        <?php
		for($i=2009; $i<2014; $i++)
		{
			if(date("Y")==$i)
        		echo '<option selected="selected" value="'.$i.'">'.$i;
			else
				echo '<option value="'.$i.'">'.$i;
		}
		?>
        </select></td></tr>
        <tr bgcolor="#990000">
        <td colspan="2" align="center" height="40" align="center">    
        <input type="submit" name="Submit" style="font-size:18px" value="Submit"/>
        </form>
    </div></td>
  </tr>
</table>
</div>
</body>
</html>
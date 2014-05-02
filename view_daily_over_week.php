<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View graph for Daily data over Week</title>
<script type="text/javascript">
function showmessage(){
alert('start');
var i = document.getElementById('day1').options[document.getElementById('day1').selectedIndex].text;
alert(i);
var j = document.getElementById('day2').options[document.getElementById('day2').selectedIndex].text;
alert('1');
var k= parseInt(i)+parseInt(j);
var y1= document.getElementById('year1').options[document.getElementById('year1').selectedIndex].text;
var y2= document.getElementById('year2').options[document.getElementById('year2').selectedIndex].text;
var month1= document.getElementById('month1').options[document.getElementById('month1').selectedIndex].text;
var month2= document.getElementById('month2').options[document.getElementById('month2').selectedIndex].text;
var charmonth1= month1.charCodeAt();
var charmonth2=month2.charCodeAt();
alert((charmonth1!=charmonth2) +'   ' +(parseInt(y1)!=parseInt(y2)));
if((charmonth1!=charmonth2)||(parseInt(y1)!=parseInt(y2))){
	alert('These Selections will produce a very large dataset and the graph would be too big to read. Please correct the selections to choose date for a single month');
	document.getElementById('myform').onsubmit = function() {
    return false;
		}
	}
	else{
	document.myform.submit();
	
	}
}
</script>
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
<table width="60%" border="0" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; margin-bottom:20px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="3"><div align="center" class="tabletitle">Select parameters to generate graphs</div></td>
  </tr>
  <tr class="tabletitle2">
    <td width="25%" height="49" style="padding-top:3px; padding-bottom:3px; padding-right:5px"><div align="center"><img src="images/Calendar.png" width="87" height="81" align="center"/></div></td>
    <td width="75%"><div align="left">
     <form name="myform" action="validate_between_date.php" method="get">
     Parameter&nbsp;:
     <select name="parameter" id ="parameter">
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
      </select><br />
     From&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
      <select name="month1" id = "month1">
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
      
      <select name="day1" id = "day1">
      	<?php
		for($i=1; $i<32; $i++)
		{
			if(date("j")==$i)
        		echo '<option selected="selected" value="'.$i.'">'.$i;
			else
				echo '<option value="'.$i.'">'.$i;
		}
		?>
      </select>
      
      <select name="year1" id = "year1">
        <?php
		for($i=2009; $i<2014; $i++)
		{
			if(date("Y")==$i)
        		echo '<option selected="selected" value="'.$i.'">'.$i;
			else
				echo '<option value="'.$i.'">'.$i;
		}
		?>
        </select>
        <br />
        To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
        <select name="month2" id = "month2">
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
      
      <select name="day2" id = "day2">
      	<?php
		for($i=1; $i<32; $i++)
		{
			if(date("j")==$i)
        		echo '<option selected="selected" value="'.$i.'">'.$i;
			else
				echo '<option value="'.$i.'">'.$i;
		}
		?>
      </select>
      
      <select name="year2" id = "year2">
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
        <input type="submit" style="font-size:18px" name="Submit" value="Submit" onclick="showmessage()" />
        </form>
    </td>
  </tr>
</table>
</div>
</body>
</html>
<?php
$header = "Home";
include('connect_to_shady_grove.php');
include('header_askLogin.php');

?>
<style type="text/css">
<!--
.tabletitle {
	font-size: 18px;
}
.tabletitle {
	font-size: 22px;
	color:#FFF;
}
.tabletitle2 {
	font-size: 18px;
}
-->
</style>

<title>View Graphs</title>

<div align="center" style="border:2px solid #000; width:71%; height:50%; margin-left:200px; margin-top:70px">
<table width="60%" border="0" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; margin-bottom:20px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="4"><div align="center" class="tabletitle">Select the type of graph you want to generate</div></td>
  </tr>
  <tr></br></tr>
  <tr>
    <td width="19%" height="39"><div>
      <div align="right"><a href="view_daily_over_week.php"><img src="images/graph.png" width="62" height="45" />      </a></div>
    </div></td>
    <td width="29%"><div align="left"><a href="view_daily_over_week.php"><strong>View daily data between dates</strong></a></div></td>
    <td width="19%"><div align="right"><a href="view_daily_over_month.php"><img src="images/graph.png" width="62" height="45" /></a></div></td>
    <td width="33%"><div align="left"><a href="view_daily_over_month.php"><strong>View daily data over a month</strong></a></div></td>
  </tr>
  <tr>
    <td height="67"><div>
      <div align="right"><a href="view_monthly_over_year.php"><img src="images/graph.png" width="62" height="45" />    </a></div>
    </div></td>
    <td height="67"><div align="left"><a href="view_monthly_over_year.php"><strong>View daily/monthly data over a year</strong></a></div></td>
    <td><div align="right"><a href="view_yearly_over_years.php"><img src="images/graph.png" width="62" height="45" /></a></div></td>
    <td><div align="left"><a href="view_yearly_over_years.php"><strong>View daily/monthly data over years</strong></a></div></td>
  </tr>
</table>
</div>


</body>
</html>
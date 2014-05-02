<?php
$header = "Home";
include('connect_to_shady_grove.php');
//include('header.php');
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
<body bgcolor="#000" style="font-family:verdana; font-size:12px">


<div align="center" style="border:2px solid #000; width:71%; height:50%; margin-left:200px; margin-top:70px">
<table width="70%" border="0" cellspacing="1" cellpadding="1" align="center" style="margin-top:10px; margin-bottom:20px; background-color:#FFF">
  <tr bgcolor="#990000" >
    <td height="52" colspan="4"><div align="center" class="tabletitle">Select the task you want to perform</div></td>
  </tr>
  <tr class="tabletitle2">
    <td height="49" colspan="2"><div align="center"><strong>Enter Records</strong></div></td>
    <td colspan="2"><div align="center"><strong>View/Edit Records</strong></div></td>
  </tr>
  <tr>
    <td width="19%" height="39"><div>
      <div align="right"><a href="enter_daily_data.php"><img src="images/edit.jpg" width="37" height="40" />      </a></div>
    </div></td>
    <td width="29%"><div align="left"><a href="enter_daily_data.php"><strong>Enter Daily Data</strong></a></div></td>
    <td width="19%"><div align="right"><a href="view_records.php"><img src="images/view.jpg" width="43" height="43" /></a></div></td>
    <td width="33%"><div align="left"><a href="view_records.php"><strong>View Records in Table</strong></a></div></td>
  </tr>
  <tr>
    <td height="67"><div>
      <div align="right"><a href="enter_monthly_data.php"><img src="images/edit.jpg" width="37" height="40" />      </a></div>
    </div></td>
    <td height="67"><div align="left"><a href="enter_monthly_data.php"><strong>Enter Monthly Data</strong></a></div></td>
    <td><div align="right"><a href="view_graphs.php"><img src="images/graph.png" width="62" height="45" /></a></div></td>
    <td><div align="left"><a href="view_graphs.php"><strong>Generate Graphs</strong></a></div></td>
  </tr>
</table>
</div>
</body>
</html>





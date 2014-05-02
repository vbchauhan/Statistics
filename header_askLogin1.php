<?php 
session_start();
if(!isset($_SESSION['name']))
{
header("Location:login1.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php if(isset($header)) {echo $header;} ?></title>
<style type="text/css">
<!--
a:link {
color:#990000;
text-decoration:none;
}
a:active {
color:#990000;
text-decoration:none;
}
a:visited {
color:#63F;
text-decoration:none;
}
a:hover {
color:#999;
}
.style1 {font-size: 10px;}
.style2 {
	color: #FC3;
	font-size:15px
}
-->
</style>
</head>
<body bgcolor="#000" style="font-family:verdana; font-size:12px">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFF" height="100%" align="center">
  <tr>
    <td align="center" colspan="2" style="padding-top:10px; padding-bottom:10px"><img src="images/logo.jpg" alt="logo" /></td>
  </tr>
  <tr bgcolor="#990000" style="margin-top:10px; margin-bottom:10px">
  <td align="left" width="50%" style="padding-left:15px">
	<a href="home.php"><span class="style2"><strong>HOME</strong></span></a>
  </td>
  <td align="right" style="padding-right:15px">
  	<a href="logout.php"><span class="style2"><strong>LOGOUT</strong></span></a>
  </td>
  </tr>
<!-- <tr style = "bgcolor:#990000"><td><div style="float:left; padding-left:10px; margin-top:10px; padding-bottom:3px; padding-top:3px; background-color:#990000"><a href="home.php"><span class="style2"><strong>HOME</strong></span></a></div>  	<div style="padding-right:10px; float:right; margin-top:10px; padding-bottom:3px; padding-top:3px; background-color:#990000"><a href="logout.php"><span class="style2"><strong>LOGOUT</strong></span></a></div>
</td></tr>-->
</table>
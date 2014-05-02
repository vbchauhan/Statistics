<?php

$mydate1 = $_GET['year1']; 
$mydate2 = $_GET['year2'];
$p_id = $_GET['parameter'];

$time1 = strtotime($mydate1);
$time2 = strtotime($mydate2);


if ($time2 > $time1) {
     header('Location:generate_yearly_over_years.php?year1='.$mydate1.'&year2='.$mydate2.'&parameter='.$p_id);
} else {
      echo "<script>alert('Please enter valid from and to years!');history.back();</script>";
}

?>
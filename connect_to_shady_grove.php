<?php # connect_to_lib_rsrc_mgmt.php


DEFINE ('DB_USER', 'priddyreserves');
DEFINE ('DB_PASSWORD', 'priddyreserves');
DEFINE ('DB_HOST', 'localhost');
#DEFINE ('DB_NAME', 'priyasga_lib_rsrc_mgmt');
DEFINE ('DB_NAME', 'sglstatistics');



$dbc = @mysqli_connect("localhost", "root","root", DB_NAME) OR die ('Could not connect to MySQL: ' .mysqli_connect_error());


?>

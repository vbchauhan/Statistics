<?php
include('connect_to_shady_grove.php'); // Connects to your Database

	$mydate = $_POST['date'];
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

if(isset($_POST['submit']))
	{
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
    				s_id
			    FROM
    				slot";
		$result = @mysqli_query ($dbc, $query);
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
		{
			$s_ids[] = $row['s_id'];
		}
		
		foreach($s_ids as $s_id)
		{
			foreach($p_ids as $p_id)
			{		
					$d_count = $_POST[$s_id.'-'.$p_id];
					$query = "SELECT 
								d_count
							FROM 
								daily_data
							WHERE 
								p_id = $p_id
								AND s_id = $s_id
								AND d_date = \"$date\"";
					$result = @mysqli_query ($dbc, $query);
					$row_count = mysqli_num_rows($result);
					
					if($row_count == 1)
					{
						if($_POST[$s_id.'-'.$p_id] != 0 && $_POST[$s_id.'-'.$p_id] != "")
						{
							$query= "UPDATE daily_data
										SET d_count= $d_count
										WHERE p_id = $p_id
										AND s_id = $s_id
										AND d_date = \"$date\"";
							$result = @mysqli_query ($dbc, $query);
						
							if(!$result)
							{
								$errors[] = "Error!";
							}
						}
						else
						{
							$query= "DELETE 
										FROM daily_data
										WHERE p_id = $p_id
										AND s_id = $s_id
										AND d_date = \"$date\"";
							$result = @mysqli_query ($dbc, $query);
						
							if(!$result)
							{
								$errors[] = "Error!";
							}
						}
					}
					else
					{  
						if($_POST[$s_id.'-'.$p_id] != 0 && $_POST[$s_id.'-'.$p_id] != "")
						{
							$query= "INSERT into daily_data(d_date, p_id, s_id, d_count) VALUES
										('$date','$p_id','$s_id','$d_count')";
							$result = @mysqli_query ($dbc, $query);
						
							if(!$result)
							{
								$errors[] = "Error!";
							}
						}
					}
			}
		}
		
	}
	
if(empty($errors))
	header('Location:preview_daily_data.php?date='.$mydate);
else
	header("Location:home.php");

?>



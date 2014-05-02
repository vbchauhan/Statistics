<?php
include('connect_to_shady_grove.php'); // Connects to your Database

	$mydate = $_POST['month'];
	$time = strtotime($mydate);
	$month = date('n',$time);
	$year = date('Y',$time);
	
	if(isset($_POST['submit']))
	{
		$query = "SELECT 
    				p_id 
			    FROM
    				parameter
				WHERE
                	p_type='Monthly'";
		$result = @mysqli_query ($dbc, $query);
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
		{
			$p_ids[] = $row['p_id'];
		}
		
		foreach($p_ids as $p_id)
		{
			$m_count = $_POST[$p_id];
			
			$query = "SELECT
						m_count
					FROM 
						monthly_data
					WHERE
						p_id = $p_id
					AND month_id = $month
					AND m_year = $year";
			$result = @mysqli_query ($dbc, $query);
			$row_count = mysqli_num_rows($result);		
					
			if($row_count == 1)
			{
				if($_POST[$p_id] != 0 && $_POST[$p_id] != "")
				{
					$query= "UPDATE monthly_data
								SET m_count = $m_count
								WHERE p_id = $p_id
								AND month_id = $month
								AND m_year = $year";
					$result = @mysqli_query ($dbc, $query);
					echo $query;
					if(!$result)
					{
						$errors[] = "Error!";
					}
				}
				else
				{
					$query= "DELETE 
								FROM monthly_data
							WHERE p_id = $p_id
								AND month_id = $month
								AND m_year = $year";
					$result = @mysqli_query ($dbc, $query);
						
					if(!$result)
					{
						$errors[] = "Error!";
					}
				}
			}
			else
			{
				if($_POST[$p_id] != 0 && $_POST[$p_id] != "")
				{
					$query= "INSERT into monthly_data(p_id, m_count, month_id, m_year) VALUES
							('$p_id','$m_count','$month','$year')";
					$result = @mysqli_query ($dbc, $query);
						
					if(!$result)
					{
						$errors[] = "Error!";
					}
				}				
			}
		}
	}
	
if(empty($errors))
	header('Location:preview_monthly_data.php?month='.$mydate);
else
	header("Location:home.php");

  ?>
 
 

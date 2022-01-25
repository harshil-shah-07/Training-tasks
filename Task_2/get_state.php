<?php
	$country = $_REQUEST['country'];

	$conn = mysqli_connect("localhost","root","Bytes@123","task_2");

	if($conn)
	{
		$select_country = "SELECT `country_id` FROM `Country` WHERE `Country` = '$country'";
		$run = mysqli_query($conn, $select_country);
		
		if($run)
		{
			while ($data = mysqli_fetch_assoc($run)) 
			{
				$country_id = $data['country_id'];
				break;
			}
			$select_state = "SELECT `State` FROM `State` WHERE `country_id` = '$country_id'";
			$run_2 = mysqli_query($conn, $select_state);

			if ($run_2) 
			{
				$a = [];
				while ($data_2 = mysqli_fetch_assoc($run_2)) 
				{
					array_push($a, $data_2['State']);
				}

				$states = json_encode($a);
				echo $states;
			}
			else
			{
				echo mysqli_error($conn);
			}
		}
		else
		{
			echo mysqli_error($conn);
		}
	}
	else
	{
		echo mysqli_error($conn);
	}
?>
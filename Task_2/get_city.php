<?php
	$state = $_REQUEST['state'];

	$conn = mysqli_connect("localhost","root","Bytes@123","task_2");

	if($conn)
	{
		$select_state = "SELECT `state_id` FROM `State` WHERE `State` = '$state'";
		$run = mysqli_query($conn, $select_state);
		
		if($run)
		{
			while ($data = mysqli_fetch_assoc($run)) 
			{
				$state_id = $data['state_id'];
				break;
			}
			
			$select_city = "SELECT `City` FROM `City` WHERE `state_id` = '$state_id'";
			$run_2 = mysqli_query($conn, $select_city);

			if ($run_2) 
			{
				$b = [];
				while ($data_2 = mysqli_fetch_assoc($run_2)) 
				{
					array_push($b, $data_2['City']);
				}

				$cities = json_encode($b);
				echo $cities;
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD Operations</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  	<script>
		function disp_records()	
		{
			var num = document.getElementById('records').value;
			
			window.location.replace("Dashboard.php?start=0&num="+num); 
		}

		function sort(sort, mode, start, num)
		{
			if(start == "")
			{
				start = 0;
			}
			if(num == "") 
			{
				num = 5;	
			}
			
			if (mode == 0) {
				mode = 1;
			} else {
				mode = 0;
			}

			window.location.replace("Dashboard.php?start="+start+"&num="+num+"&sort="+sort+"&mode="+mode);
		}
  	</script>
</head>
<body class="container">
	<center><h2><b>Welcome to Dashboard</b></h2></center>
	<br>
	<a href="Add.php"><button class="btn btn-outline-primary col-sm-12">Add a new user</button></a>
	<br><br>

	<div style="text-align: right;" class="dropdown">
		<select name="records" id="records" onchange="disp_records()" class="dropdown-toggle" data-toggle="dropdown"> 
			<div class="dropdown-menu">
				<?php
				$j = 1;
					for ($i = 1; $i <= 2; $i++) 
					{ 
						$j = $i * 5;
						?>
							<option value="<?php echo $j; ?>" 
								<?php 
									if(isset($_REQUEST['num'])) {
										if($j == $_REQUEST['num']) { 
											echo "selected";
										}
									} else {
										if($j == 5) {
											echo "selected";
										}
									}
								?>>
								Display <?php echo $j; ?> records
							</option>
						<?php
					}
				?>
			</div>
		</select>
	</div>

	<p id="demo"></p>

	<table class="table table-striped table-hover table-dark mt-4 table-bordered">
		<center><h3>User Records</h3></center>
		
		<thead class="thead-light mx-auto">
			<th><center>Id</center></th>
			<th><center>Image</center></th>
			<th onclick="sort('First Name', [<?php echo $_REQUEST['mode']; ?>], [<?php echo $_REQUEST['start']; ?>], [<?php echo $_REQUEST['num']; ?>])"><center>First Name</center></th>
			<th onclick="sort('Last Name', [<?php echo $_REQUEST['mode']; ?>], [<?php echo $_REQUEST['start']; ?>], [<?php echo $_REQUEST['num']; ?>])"><center>Last Name</center></th>
			<th onclick="sort('Gender', [<?php echo $_REQUEST['mode']; ?>], [<?php echo $_REQUEST['start']; ?>], [<?php echo $_REQUEST['num']; ?>])"><center>Gender</center></th>
			<th><center>Hobbies</center></th>
			<th><center>Occupation</center></th>
			<th><center>Address</center></th>
			<th onclick="sort('Phone', [<?php echo $_REQUEST['mode']; ?>], [<?php echo $_REQUEST['start']; ?>], [<?php echo $_REQUEST['num']; ?>])"><center>Phone number</center></th>
			<th><center>Edit</center></th>
			<th><center>Delete</center></th>
		</thead>
		<tbody>
			<?php

				$conn = mysqli_connect('localhost','root','Bytes@123','details');

				if($conn)
				{
					if(!isset($_REQUEST['start']) || empty($_REQUEST['start'])){

						if(!isset($_REQUEST['num']) || empty($_REQUEST['num'])){
							$start = 0; $num = 5;
						} else {
							$start = 0; $num = $_REQUEST['num'];
						}
					} else {
						if(!isset($_REQUEST['num']) || empty($_REQUEST['num'])) {
							$start = $_REQUEST['start']; $num = 5;
						} else {
							$start = $_REQUEST['start']; $num = $_REQUEST['num'];
						}
					}

					$mode = (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode'] != "") ? 1 : 0;

					$sort = (isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) && $_REQUEST['sort'] != "") ? $_REQUEST['sort'] : 'id';

					if($mode == 1) {
						$select = "SELECT * FROM `users` ORDER BY `$sort` ASC LIMIT ".$start.", ".$num;
					} else {
						if($sort == "id") {
							$select = "SELECT * FROM `users` ORDER BY `$sort` ASC LIMIT ".$start.", ".$num;
						} else {
							$select = "SELECT * FROM `users` ORDER BY `$sort` DESC LIMIT ".$start.", ".$num;
						}
					}

					$run = mysqli_query($conn,$select);

					if($run)
					{
						while ($data = mysqli_fetch_assoc($run)) 
						{
							$id = $data['id'];
							?>
							<tr id="data_rows">
								<td><center><?php echo $data['id']; ?></center></td>
								<td>
									<center>
										<img src="Images/<?php echo $data['Image']; ?>" width = "50" height= "50" alt='Not uploaded'>
									</center>
								</td>
								<td><center><?php echo $data['First Name']; ?></center></td>
								<td><center><?php echo $data['Last Name']; ?></center></td>
								<td>
									<center>
										<?php 
											$select_gender = "SELECT * FROM `Gender` WHERE `id` = '$data[Gender]'";
											$run_gender = mysqli_query($conn, $select_gender);
											if($run_gender)
											{
												while ($data_gender = mysqli_fetch_assoc($run_gender)) 
												{
													$gender = $data_gender['Gender'];
												}
												echo $gender;
											} 
										?>
									</center>
								</td>
								<td>
									<center>
										<?php 
											$h = explode(',', $data['Hobbies']);
											$hobbies = array();
											
											foreach ($h as $key => $value) 
											{
												$select_hobbies = "SELECT * FROM `Hobbies` WHERE `id` = '$value'";
												$run_hobbies = mysqli_query($conn, $select_hobbies);
												$data_hobbies = mysqli_fetch_assoc($run_hobbies);
												$hobby = $data_hobbies['Hobbies'];
												array_push($hobbies, $hobby);
											}

											$hobbies = implode(',', $hobbies);
											echo $hobbies;
										?>
									</center>
								</td>
								<td>
									<center>
										<?php 
											$select_occu = "SELECT * FROM `Occupation` WHERE `id` = '$data[Occupation]'";
											$run_occu = mysqli_query($conn, $select_occu);
											if($run_occu)
											{
												while ($data_occu = mysqli_fetch_assoc($run_occu)) 
												{
													$occupation = $data_occu['Occupation'];
												}
												echo $occupation;
											} 
										?>
									</center>
								</td>
								<td><center><?php echo $data['Address']; ?></center></td>
								<td><center><?php echo $data['Phone']; ?></center></td>
								<td>
									<center>
										<a href="Edit.php?uid=<?php echo $data['id']; ?>">
											<button class="btn btn-outline-success">Edit</button>
										</a>
									</center>
								</td>
								<td>
									<center>
										<button class="btn btn-outline-danger" onclick="delete_record(<?php echo $data['id']; ?>)">Delete</button>
									</center>
								</td>
							</tr>
							<?php
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
		</tbody>
	</table>
	<div style="margin-left: 45%;" id="paginate">
		<ul class="pagination">
			<?php

				$select = "SELECT COUNT(*) FROM `users`";
				$run = mysqli_query($conn, $select);
				$data = mysqli_fetch_assoc($run);

				$count = $data['COUNT(*)'];

				$page = ceil($count / $num);

				$start = 0;
				$uid = $id - 2;

				if($uid < 0)
				{
					$uid = 0;
				}
				$curr_start = $_REQUEST['start'];

				for($i = 0; $i < $page; $i++)
				{
					$start = $i * $num;
					?>
						<li class="page-item">
							<a href="Dashboard.php?start=<?php echo $start; ?>&num=<?php echo $num; ?>" class="page-link">
								<?php 
									if ($start == $curr_start)
									{ 
										echo "<u>".$i."</u>"; 
									}
									else 
									{
										echo $i;
									} 
								?>
							</a>
						</li>
					<?php
				}
			?>
		</ul>
	</div>
</body>
</html>

<script>
	var id;
	function delete_record(id)
	{
		var r = confirm("Are you sure you want to delete the record?");
		if(r == true)
		{
			document.write(id);
			window.location.replace("Delete.php?did="+id); 
		}
	}
</script>
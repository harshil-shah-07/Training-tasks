<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add a new user</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<a href="Dashboard.php?start=0&num=4">Go to dashboard</a>
	<form class="form ml-5" method="POST" action="" enctype="multipart/form-data">

		<h3><b>Edit user information</b></h3>

		<?php

			$conn = mysqli_connect("localhost","root","Bytes@123","details");

			if($conn)
			{
				$id = $_REQUEST['uid'];

				$select = "SELECT * FROM `users` WHERE `id` = '$id'";
				$run = mysqli_query($conn,$select);
				$rows = mysqli_num_rows($run);

				if($rows > 0)
				{
					while($data = mysqli_fetch_assoc($run))
					{
						if($data['Image'])
						{
							?>
								<p class="form-group">
									<b>Image:</b> <img src="Images/<?php echo $data['Image']; ?>" style="width: 100px; height: 100px;"><br><br>
									<b>Upload New Image:</b> <input type="file" name="upload_img" class="btn btn-warning col-sm-2">
								    <b>OR</b> <input type="submit" value="Delete Image" name="delete_img" class="btn btn-danger">
								    <span style="color: red; display: none;" id="image">*Image must have .jpeg, .jpg or .png extension only</span>
								</p>
							<?php
						}
						else
						{
							?>
								<p class="form-group">
									<b>Upload New Image:</b> <input type="file" name="upload_img" class="btn btn-warning col-sm-2">
									<span style="color: red; display: none;" id="image">*Image must have .jpeg extension only</span>
								</p>
							<?php
						}

						?>

							<p class="form-group">
								<b>First Name:</b> 
								<input type="text" name="fname" class="form-control col-md-3" value="<?php if(isset($_REQUEST['fname'])) echo $_REQUEST['fname']; else echo $data['First Name']; ?>">
								<span style="color: red; display: none;" id="fname">*Field input is required</span>
								<span style="color: red; display: none;" id="ifname">*Field is in improper format</span>
							</p>

							<p class="form-group">
								<b>Last Name:</b> 
								<input type="text" name="lname" class="form-control col-md-3" value="<?php if(isset($_REQUEST['lname'])) echo $_REQUEST['lname']; else echo $data['Last Name']; ?>">
								<span style="color: red; display: none;" id="lname">*Field input is required</span> 
								<span style="color: red; display: none;" id="ilname">*Field input is in improper format</span>
							</p>

							<p class="form-group">
								<b>Gender: </b>
								<span style="color: red; display: none;" id="gender">*Field input is required</span> 
								
								<?php
									$select_gender = "SELECT * FROM `Gender`";
									$run_gender = mysqli_query($conn, $select_gender);

									$Gender_all = array();
									$i = 1;
									
									while ($data_gender = mysqli_fetch_assoc($run_gender)) 
									{
										$Gender_all[$i++] = $data_gender['Gender'];
									}
									
									foreach ($Gender_all as $key => $value) 
									{
										?>
										<input type="radio" name="Gender" value="<?php echo $key; ?>" <?php if($data['Gender'] == $key) echo "checked"; ?>> <?php echo $value; ?>
										<?php
									}
								?>
							</p>

							<p class="form-group">
								<b>Hobbies: </b>
								<?php
									$Hobbies = explode(',', $data['Hobbies']);

									$select_Hobbies = "SELECT * FROM `Hobbies`";
									$run_Hobbies = mysqli_query($conn, $select_Hobbies);

									$Hobbies_all = array();
									$i = 1;
									
									while ($data_Hobbies = mysqli_fetch_assoc($run_Hobbies)) 
									{
										$Hobbies_all[$i++] = $data_Hobbies['Hobbies'];
									}

									foreach ($Hobbies_all as $key => $value) 
									{
										?>
											<input type="checkbox" name="Hobbies[]" value="<?php echo $key; ?>" <?php if(in_array($key, $Hobbies)) echo "checked"; ?>> <?php echo $value; ?>
										<?php
									}
								?>
							</p>

							<p class="form-group dropdown">
								<b>Occupation: </b>
								<?php
									$select_occu = "SELECT * FROM `Occupation`";
									$run_occu = mysqli_query($conn, $select_occu);

									$Occupation_all = array();
									$i = 1;
									
									while ($data_occu = mysqli_fetch_assoc($run_occu)) 
									{
										$Occupation_all[$i++] = $data_occu['Occupation'];
									}
								?>
								<select name="Occupation" data-toggle="dropdown">
									<option value="" disabled>Select your profession</option>
									<?php
										foreach ($Occupation_all as $key => $value) 
										{
											?>
												<option value="<?php echo $key; ?>" class="dropdown-item" <?php if($data['Occupation'] == $key) echo "selected"; ?>> <?php echo $value; ?>
											<?php
										}
									?>
								</select>
								<span style="color: red; display: none;" id="occupation">*Field input is required</span>
							</p>

							<b>Address: </b>
							<textarea name="address" class="form-control col-md-3" value="<?php if(isset($_REQUEST['address'])) echo $_REQUEST['address']; else echo $data['Address']; ?>"><?php if(isset($_REQUEST['address'])) echo $_REQUEST['address']; else echo $data['Address']; ?></textarea>
							<span style="color: red; display: none;" id="address">*Field input is required</span>
							<span style="color: red; display: none;" id="iaddress">*Field input is in improper format</span>

							<p class="form-group">
								<b>Phone number: </b>
								<input type="number" name="phone" class="form-control col-md-3" value="<?php if(isset($_REQUEST['phone'])) echo $_REQUEST['phone']; else echo $data['Phone']; ?>">
								<span style="color: red; display: none;" id="phone">*Field input is required</span>
								<span style="color: red; display: none;" id="iphone">*Field input is in improper format</span>
							</p>

							<p>
								<input type="submit" name="submit" value="Update" class="form-control col-md-3 btn btn-secondary">
							</p>
						<?php
					}
				}
			}
			else
			{
				echo mysqli_error($conn);
			}
		?>
	</form>
</body>
</html>

<?php

	if (isset($_REQUEST['delete_img'])) 
	{
		$conn = mysqli_connect("localhost","root","Bytes@123","details");

		if($conn)
		{
			$conn = mysqli_connect("localhost","root","Bytes@123","details");

			$select = "SELECT `Image` FROM `users` WHERE `id` = '$id'";
			$run = mysqli_query($conn, $select);
			$data = mysqli_fetch_assoc($run);
			$img = $data['Image'];

			unlink($img);

			$delete = "UPDATE `users` SET `Image`= 'user.png' WHERE `id` = '$id'";
			$run = mysqli_query($conn, $delete);

			if($run)
			{
				echo "<script>alert('Image deleted successfully');</script>";
				echo "<script>window.location.replace('Edit.php?uid='+".$id.");</script>";
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

	if (isset($_REQUEST['submit'])) 
	{
		$conn = mysqli_connect("localhost","root","Bytes@123","details");	
		$flag = 0;
		if($conn)
		{
			if(!isset($_REQUEST['fname']) || empty($_REQUEST['fname']))
			{
				$flag++;
				?>
				<script>
					document.getElementById("fname").style.display = "inline-flex";
				</script>
				<?php
			}

			if (preg_match("/[^a-z]/i", $_REQUEST["fname"])) 
			{
				$flag++;
				?>
				<script>
					document.getElementById("ifname").style.display = "inline-flex";
				</script>
				<?php
			}

			if(!isset($_REQUEST['lname']) || empty($_REQUEST['lname']))
			{
				$flag++;
				?>
				<script>
					document.getElementById("lname").style.display = "inline-flex";
				</script>
				<?php
			}

			if (preg_match("/[^a-z,]/i", $_REQUEST["lname"])) 
			{
				$flag++;
				?>
				<script>
					document.getElementById("ilname").style.display = "inline-flex";
				</script>
				<?php
			}

			if(!isset($_REQUEST['address']) || empty($_REQUEST['address']))
			{
				$flag++;
				?>
				<script>
					document.getElementById("address").style.display = "inline-flex";
				</script>
				<?php
			}

			if (preg_match("/[^a-z0-9-, ]/i", $_REQUEST["address"])) 
			{
				$flag++;
				?>
				<script>
					document.getElementById("iaddress").style.display = "inline-flex";
				</script>
				<?php
			}

			if(!isset($_REQUEST['Gender']) || empty($_REQUEST['Gender']))
			{
				$flag++;
				?>
				<script>
					document.getElementById("fname").style.display = "inline-flex";
				</script>
				<?php
			}

			if(!isset($_REQUEST['phone']) || empty($_REQUEST['phone']))
			{
				$flag++;
				?>
				<script>
					document.getElementById("phone").style.display = "inline-flex";
				</script>
				<?php
			}

			if (preg_match("/[^0-9]/i", $_REQUEST["phone"]) || strlen($_REQUEST['phone']) > 10 || strlen($_REQUEST['phone']) < 9) 
			{
				$flag++;
				?>
				<script>
					document.getElementById("iphone").style.display = "inline-flex";
				</script>
				<?php
			}

			if (!empty($_FILES['upload_img']['name'])) 
			{
				$path_parts = pathinfo($_FILES['upload_img']['name']);
				$ext = $path_parts['extension'];

				$conn = mysqli_connect("localhost","root","Bytes@123","details");
				$select = "SELECT `Image` FROM `users` WHERE `id` = '$id'";
				$run = mysqli_query($conn, $select);
				$data = mysqli_fetch_assoc($run);
				$img = $data['Image'];

				unlink($img);

				if ($ext !== "jpeg" && $ext !== "jpg" && $ext !== "png")	 
				{
					?>
						<script>
							document.getElementById("image").style.display = "inline-flex";
						</script>
					<?php
					goto Error;
				}
			}

			$fname = $_REQUEST['fname'];
			$lname = $_REQUEST['lname'];
			$address = $_REQUEST['address'];
			$phone = $_REQUEST['phone'];
			$gender = $_REQUEST['Gender'];
			$Hobbies = $_REQUEST['Hobbies'];
			echo $h = @implode(',', $Hobbies);
			$occupation = $_REQUEST['Occupation'];

			if(!empty($_FILES['upload_img']['name']) && $flag == 0)
			{
				$img_name = $_FILES['upload_img']['name'];
				$img_path = __DIR__."/Images/".basename($img_name);
				$file_store = move_uploaded_file($_FILES['upload_img']['tmp_name'], $img_path);

				$update = "UPDATE `users` SET `Image` = '$img_name', `First Name` = '$fname', `Last Name` = '$lname', `Gender` = '$gender', `Hobbies` = '$h', `Occupation` = '$occupation', `Address` = '$address', `Phone` = '$phone' WHERE `id` = '$id'";
		
				$run = mysqli_query($conn, $update);
				echo "<script>alert('Record updated successfully!');</script>";

				if($run)
				{
					?>
					<script>
						window.location.replace("Dashboard.php?start=0&num=5"); 
					</script>
					<?php
				}
				else
				{
					echo mysqli_error($conn);
				}
			}

			else if(!isset($_REQUEST['upload_img']) && $flag == 0)
			{
				$update = "UPDATE `users` SET `First Name` = '$fname', `Last Name` = '$lname', `Gender` = '$gender', `Hobbies` = '$h', `Occupation` = '$occupation', `Address` = '$address', `Phone` = '$phone' WHERE `id` = '$id'";
		
				$run = mysqli_query($conn, $update);
				echo "<script>alert('Record updated successfully!');</script>";

				if($run)
				{
					?>
					<script>
						window.location.replace("Dashboard.php?start=0&num=5"); 
					</script>
					<?php
				}
				else
				{
					echo mysqli_error($conn);
				}
			}
			else
			{
				?>
					<span style="color: red;" id="empty_req">*Please fill out all the required fields</span>
				<?php
			}
		}
		else
		{
			echo mysqli_error($conn);
		}
	}
	Error:
?>
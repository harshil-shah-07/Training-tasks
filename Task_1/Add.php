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
	<a href="Dashboard.php">Go to dashboard</a>
	<form class="form ml-5 mt-1" method="POST" action="" enctype="multipart/form-data">

		<h3><b>Add a new user</b></h3>

		<p class="form-group">
			<b>Image:</b> 
			<input type="file" name="image" placeholder="Upload your image" class="form-control col-md-3">
			<span style="color: red; display: none;" id="image">Image must have .jpeg, .jpg or .png extension only</span>	
			<span style="color: red; display: none;" id="img_size">File size should not exceed 18kB</span>			
		</p>


		<p class="form-group">
			<b><span style="color: red;">*</span>First Name:</b> 
			<input type="text" name="fname" class="form-control col-md-3" value="<?php if(isset($_REQUEST['fname'])) echo $_REQUEST['fname']; ?>">
			<span style="color: red; display: none;" id="fname">Field input is required</span>
			<span style="color: red; display: none;" id="ifname">Field is in improper format</span>
		</p>

		<p class="form-group">
			<b><span style="color: red;">*</span>Last Name:</b> 
			<input type="text" name="lname" class="form-control col-md-3" value="<?php if(isset($_REQUEST['lname'])) echo $_REQUEST['lname'];?>">
			<span style="color: red; display: none;" id="lname">Field input is required</span> 
			<span style="color: red; display: none;" id="ilname">Field input is in improper format</span>
		</p>

		<p class="form-group">
			<b><span style="color: red;">*</span></b>
			<b>Gender: </b>
			
			<?php
				$conn = mysqli_connect("localhost","root","Bytes@123","details");
				$select = "	SELECT * FROM `Gender`";
				$run = mysqli_query($conn, $select);

				$Gender_all = array();
				$i = 1;
				
				while ($data = mysqli_fetch_array($run)) 
				{
					$Gender_all[$i++] = $data['Gender'];
				}
				
				foreach ($Gender_all as $key => $value) 
				{
					?>
					<input type="radio" name="Gender" value="<?php echo $key; ?>" <?php if($_REQUEST['Gender'] == $key) echo "checked"; ?>> <?php echo $value; ?>
					<?php
				}
			?>
			<span style="color: red; display: none;" id="gender">Field input is required</span> 
		</p>

		<p class="form-group">
			<b>Hobbies: </b>
			<?php
				$select = "	SELECT * FROM `Hobbies`";
				$run = mysqli_query($conn, $select);

				$Hobbies_all = array();
				$i = 1;
				
				while ($data = mysqli_fetch_array($run)) 
				{
					$Hobbies_all[$i++] = $data['Hobbies'];
				}				

				foreach ($Hobbies_all as $key => $value) 
				{

					?>
						<input type="checkbox" name="Hobbies[]" value="<?php echo $key; ?>" <?php 
						if ($_REQUEST['Hobbies']) {
							if(in_array($key, $_REQUEST['Hobbies'])) echo "checked";
						}; ?>> <?php echo $value; ?>
					<?php
				}
			?>
		</p>

		<p class="form-group dropdown">
			<span style="color: red;">*</span>
			<b>Occupation: </b>
			<?php
				$select = "	SELECT * FROM `Occupation`";
				$run = mysqli_query($conn, $select);

				$Occupation_all = array();
				$i = 1;
				
				while ($data = mysqli_fetch_array($run)) 
				{
					$Occupation_all[$i++] = $data['Occupation'];
				}
			?>
			<select name="Occupation" data-toggle="dropdown">
				<option value="" disabled>Select your profession</option>
				<?php
					foreach ($Occupation_all as $key => $value) 
					{
						?>
							<option value="<?php echo $key; ?>" class="dropdown-item" <?php if($_REQUEST['Occupation'] == $key) echo "selected"; ?>> <?php echo $value; ?>
						<?php
					}
				?>
			</select>
			<span style="color: red; display: none;" id="occupation">*Field input is required</span>
		</p>

		<span style="color: red;">*</span>
		 
		<b>Address: </b>
		<textarea name="address" class="form-control col-md-3" value="<?php if(isset($_REQUEST['address'])) echo $_REQUEST['address']; ?>"><?php if(isset($_REQUEST['address'])) echo $_REQUEST['address']; ?></textarea>
		<span style="color: red; display: none;" id="address">Field input is required</span>
		<span style="color: red; display: none;" id="iaddress">Field input is in improper format</span>
		
		<p class="form-group">
			<span style="color: red;">*</span>
			<b>Phone number: </b>
			<input type="text" name="phone" class="form-control col-md-3" value="<?php if(isset($_REQUEST['phone'])) echo $_REQUEST['phone']; ?>">
			<span style="color: red; display: none;" id="phone">Field input is required.</span>
			<span style="color: red; display: none;" id="iphone">Field input is in improper format.</span>
		</p>

		<p>
			<input type="submit" name="submit" class="form-control col-md-3 btn btn-secondary">
		</p>

	</form>
</body>
</html>

<?php
	if (isset($_REQUEST['submit'])) 
	{
		$flag = 0;
		$conn = mysqli_connect("localhost","root","Bytes@123","details");	
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

			if (preg_match("/[^a-z]/i", $_REQUEST["lname"])) 
			{
				$flag++;
				?>
				<script>
					document.getElementById("ilname").style.display = "inline-flex";
				</script>
				<?php
			}

			if(!isset($_REQUEST['Gender']) || empty($_REQUEST['Gender']))
			{
				$flag++;
				?>
				<script>
					document.getElementById("gender").style.display = "inline-flex";
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

			if(!empty($_REQUEST['address']))
			{
				if(strlen($_REQUEST['address']) < 10)	
				{
					$flag++;
					?>
						<script>
							document.getElementById("iaddress").style.display = "inline-flex";
						</script>
					<?php
				}
			}

			if(!isset($_REQUEST['Occupation']) || empty($_REQUEST['Occupation']))
			{
				$flag++;
				?>
				<script>
					document.getElementById("occupation").style.display = "inline-flex";
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

			if (preg_match("/[^0-9]/i", $_REQUEST["phone"])) 
			{
				$flag++;
				?>
					<script>
						document.getElementById("iphone").style.display = "inline-flex";
					</script>
				<?php
			}

			if(!empty($_REQUEST['phone']))
			{
				if(strlen($_REQUEST['phone']) > 10 || strlen($_REQUEST['phone']) < 9)	
				{
					$flag++;
					?>
						<script>
							document.getElementById("iphone").style.display = "inline-flex";
						</script>
					<?php
				}
			}

			if (!empty($_FILES['image']['name'])) 
			{
				$path_parts = pathinfo($_FILES['image']['name']);
				$ext = $path_parts['extension'];

				if ($ext !== "jpeg" && $ext !== "jpg" && $ext !== "png")	 
				{
					echo $ext;
					$flag++;
					?>
					<script>
						document.getElementById("image").style.display = "inline-flex";
					</script>
					<?php
				}
			}

			$fname = $_REQUEST['fname'];
			$lname = $_REQUEST['lname'];
			$address = $_REQUEST['address'];
			$phone = $_REQUEST['phone'];
			$Hobbies = $_REQUEST['Hobbies'];
			$gender = $_REQUEST['Gender'];
			$occupation = $_REQUEST['Occupation']; 

			$h = @implode(',', $Hobbies);

			if(!empty($_FILES['image']['name']) && $flag == 0)
			{
				$img_name = $_FILES['image']['name'];
				$img_path = "/var/www/html/Task_1/Images/".basename($img_name);

				$file_store = move_uploaded_file($_FILES['image']['tmp_name'], $img_path);

				if($file_store)
				{
					$insert = "INSERT INTO `users` (`Image`, `First Name`, `Last Name`, `Gender`, `Hobbies`, `Occupation`, `Address`, `Phone`) VALUES('$img_name', '$fname', '$lname', '$gender', '$h', '$occupation', '$address', $phone) ";
		
					$run = mysqli_query($conn, $insert);

					if($run)
					{
						echo "<script>alert('Record added successfully!');</script>";
						?>
						<script>
							window.location.replace("Dashboard.php?start=0&num=5"); 
						</script>
						<?php
						goto Error;
					}
				}
			}

			elseif (empty($_FILES['image']['name']) && $flag == 0) 
			{
				$insert = "INSERT INTO `users` (`First Name`, `Last Name`, `Gender`, `Hobbies`, `Occupation`, `Address`, `Phone`) VALUES('$fname', '$lname', '$gender', '$h', '$occupation', '$address', $phone) ";
		
				$run = mysqli_query($conn, $insert);

				if($run)
				{
					echo "<script>alert('Record added successfully!');</script>";
					?>
					<script>
						window.location.replace("Dashboard.php?start=0&num=5"); 
					</script>
					<?php
				}
			}
		}
		Error:
	}
?>

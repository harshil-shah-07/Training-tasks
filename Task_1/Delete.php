<?php

	$id = $_REQUEST['did'];

	$conn = mysqli_connect("localhost","root","Bytes@123","details");

	$delete = "DELETE FROM `users` WHERE `id` = '$id'";

	$run = mysqli_query($conn, $delete);

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
?>
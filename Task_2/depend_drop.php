<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Dependent Dropdown</title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	  	<script>
	  		function country_submit()
	  		{
	  			var country = document.getElementById('Country').value;

	  			document.getElementById('City').options.length = 1;
	  			
	  			var xhttp = new XMLHttpRequest();
	  			xhttp.open("GET","get_state.php?country="+country,true);
	  			xhttp.send();

	  			xhttp.onreadystatechange = function()
	  			{
	  				if(xhttp.status == 200 && xhttp.readyState == 4)
	  				{
	  					document.getElementById("State").style.visibility = "visible";

	  					var response = JSON.parse(xhttp.responseText);
	  					var txt = "<option value=''>Select any State</option>";

	  					for(let value of response)
	  					{
	  						txt = txt + "<option value=" + value + ">" + value + "</option>";
	  					}
	  					document.getElementById("State").innerHTML = txt;	
	  				}
	  			}
	  		}

	  		function state_submit()
	  		{
	  			var state = document.getElementById('State').value;
	  			
	  			var xhttp = new XMLHttpRequest();
	  			xhttp.open("GET","get_city.php?state="+state,true);
	  			xhttp.send();

	  			xhttp.onreadystatechange = function()
	  			{
	  				if(xhttp.status == 200 && xhttp.readyState == 4)
	  				{
	  					document.getElementById("City").style.visibility = "visible";

	  					var response = JSON.parse(xhttp.responseText);
	  					var txt = "<option value=''>Select any City</option>";

	  					for(let value of response)
	  					{
	  						txt = txt+"<option value="+value+">"+value+"</option>";
	  					}
	  					document.getElementById("City").innerHTML = txt;	
	  				}
	  			}
	  		}

	  		// function city_submit()
	  		// {	
	  		// 	var country = document.getElementById("Country").value;
	  		// 	var state = document.getElementById("State").value;
	  		// 	var city = document.getElementById("City").value;

	  		// 	if(country.length == 0 || state.length == 0 || city.length == 0)
	  		// 	{
	  		// 		document.getElementById("demo").innerHTML = "Please select the valid location";
	  		// 	}
	  		// 	else
	  		// 	{
	  		// 		document.write("Country => "+country+", State => "+state+", City => "+city);
	  		// 	}
	  		// }
	  	</script>
	</head>

	<body class="container">
		<h1><center>Select Country, State & City for exact location</center></h1><br><br>

		<div class="dropdown">
			<select id="Country" data-toggle="dropdown" onchange="country_submit()">
				<option class="dropdown-item" value="">Select any Country</option>
				<option class="dropdown-item" value="U.S.A">U.S.A</option>
				<option class="dropdown-item" value="Australia">Australia</option>
				<option class="dropdown-item" value="India">India</option>
			</select>
		</div>

		<div class="dropdown" data-toggle="dropdown" onchange="state_submit()" style="margin-left: 450px; margin-top: -20px; visibility: hidden;">
			<select id="State">
				<option value="">Select any State</option>
			</select>
		</div>

		<div class="dropdown" data-toggle="dropdown" onchange="city_submit()" style="margin-left: 900px; margin-top: -20px; visibility: hidden;" id="City_2">
			<select id="City">
				<option value="">Select any City</option>
			</select>
		</div>
	</body>
</html>
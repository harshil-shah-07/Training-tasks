<html>
    <head>
        <title>Users list</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Loading Bootstrap and jQuery CDN file -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>

        <h2><center><b>SELECT USER</b></center></h2>
        
        <center>
            <form action="taskList2.php" method="GET" class="form" style="margin-top: 17%;">

                <select name="user" id="user" class="form-control" style="width: 500px;">
                    <option value="" disabled>Select User</option>
                    <option value="Ketan">Ketan</option>
                    <option value="Anand">Anand</option>
                    <option value="Jaydeep">Jaydeep</option>
                    <option value="Maharshi">Maharshi</option>
                    <option value="Sweta">Sweta</option>
                    <option value="Meree">Meree</option>
                    <option value="Harshil">Harshil</option>
                    <option value="Anjali">Anjali</option>
                    <option value="Chirag">Chirag</option>
                    <option value="Chetan">Chetan</option>
                </select>
                <br>
                <input type="submit" class="btn btn-secondary" value="Submit">
            </form>
        </center>

    </body>
</html>
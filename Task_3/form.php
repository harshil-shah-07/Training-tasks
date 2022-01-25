<?php require("header.php"); ?>

    <body>
        <p>
            <a href="index.php">Go to Dashboard</a>
            <h2><center><b>ADD A NEW USER</b></center></h2>
        </p>
        <form action="store.php" method="GET" class="mt-4">
            <center>
                <p class="form-group">
                    First Name <input type="text" name="fname" id="fname" class="form-control col-md-4" value="<?php if($_REQUEST['First_Name']) echo $_REQUEST['First_Name']; else echo $data['First_Name']; ?>">
                    <?php
                        if($_REQUEST['fnameErr'] == 1) {
                            echo "<span style='color: red;'>Please Enter First Name field</span>";
                        }
                    ?>
                </p>

                <p class="form-group">
                    Last Name <input type="text" name="lname" id="lname" class="form-control col-md-4" value="<?php if($_REQUEST['Last_Name']) echo $_REQUEST['Last_Name']; else echo $data['First_Name']; ?>" >
                    <?php
                        if($_REQUEST['lnameErr'] == 1) {
                            echo "<span style='color: red;'>Please Enter Last Name field</span>";
                        }
                    ?>
                </p>

                <p class="form-group">
                    Email Address <input type="text" name="email" id="email" class="form-control col-md-4" value="<?php if($_REQUEST['Email']) echo $_REQUEST['Email']; else echo $data['First_Name']; ?>" >
                    <?php
                        if($_REQUEST['emailErr'] == 1) {
                            echo "<span style='color: red;'>Please Enter Email field</span>";
                        }
                    ?>
                </p>

                <p class="form-group">
                    <input type="submit" name="submit" class="btn btn-secondary col-md-4" value="Submit">
                </p>
            </center>
        </form>

        <p id="demo"></p>
    </body>
</html>
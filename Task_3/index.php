<?php require("header.php"); ?>
    <body>
        <h1><center><b>DASHBOARD</b></center></h1>

        <div>
            <center>
                <a href="add.php">
                    <button class="btn btn-outline-primary col-lg-10 mt-4">Add a new user</button>
                </a>
            </center>
        </div>

        <?php
            if($_SESSION['user'] == "new addition") {
                unset($_SESSION['user']);
                echo "<script>alert('New record added!');</script>";
            }
        ?>

        <div>
            <h3 class="mt-4"><b><center>User Records</center></b></h3>
        </div>

        <table class="table mt-4 table-striped table-hover table-dark table-bordered col-10" style="margin-left: 110px; text-align: center;">
            <thead class="thead-light mx-auto">
                <tr>
                    <th>id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require("database.php");

                    $select = "SELECT * FROM `users` LIMIT ".$num;
                    $run = mysqli_query($conn, $select);

                    if($run) {
                        while ($data = mysqli_fetch_assoc($run)) {
                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['First_Name']; ?></td>
                                    <td><?php echo $data['Last_Name']; ?></td>
                                    <td><?php echo $data['Email']; ?></td>
                                    <td>
                                        <a href="edit.php?uid=<?php echo $data['id']; ?>">
                                            <button class="btn btn-outline-success">Edit</button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <button class="btn btn-outline-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>
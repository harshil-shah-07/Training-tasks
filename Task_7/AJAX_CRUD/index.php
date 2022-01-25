<html>
    <head>
        <title>AJAX CRUD Ops.</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Loading Bootstrap and jQuery CDN file -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Loading Bootstrap Glyphicon library -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!-- Loading functions.js file -->
        <script src="functions.js"></script>
    </head>

    <body>  

        <h2><b><center>AJAX CRUD</center></b></h2>

        <button class="btn btn-outline-primary col-sm-2" style="margin-left: 74.5%;" onclick="showNewModal()">
            <i class="fas fa-user-plus">  New User</i>
        </button>

        <div style="margin-left: 8.3%;" class="dropdown">
            <select name="records" id="records" onchange="dispRecords(this.value)" class="dropdown-toggle" data-toggle="dropdown"> 
                <div class="dropdown-menu">
                    <?php
                        $j = 1;
                        for ($i = 1; $i <= 2; $i++) 
                        { 
                            $j = $i * 5;
                            ?>
                                <option value="<?php echo $j; ?>">
                                    Display <?php echo $j; ?> records
                                </option>
                            <?php
                        }
                    ?>
                </div>
            </select>
        </div>

        <p id="demo"></p>

        <?php require("modal.html"); ?>

        <?php
            $conn = mysqli_connect("localhost", "root", "Bytes@123", "test");

            if($conn) {
                ?>
                    <div>
                        <h3 class="mt-4"><b><center>User Records</center></b></h3>
                    </div>

                    <table class="table mt-4 table-striped table-hover table-dark table-bordered col-10" style="margin-left: 110px; text-align: center;">
                        <thead class="thead-light mx-auto">
                            <tr>
                                <th>id</th>
                                <th>Image</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Gender</th>
                                <th>Hobbies</th>
                                <th>Occupation</th>
                                <th>About</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $num = $_SESSION['num'] ?? 5;
                                if (isset($_SESSION['num'])) {
                                    session_destroy();
                                }
                                $select = "SELECT * FROM `users` LIMIT 0, ".$num;
                                $run = mysqli_query($conn, $select);

                                if ($run) {
                                    while ($data = mysqli_fetch_assoc($run)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $data['id']; ?></td>
                                                <td>
                                                    <img src="Images/<?php echo $data['image']; ?>" style="width: 50; height: 50;">
                                                </td>
                                                <td><?php echo $data['firstName']; ?></td>
                                                <td><?php echo $data['lastName']; ?></td>
                                                <td><?php echo $data['email']; ?></td>
                                                <td><?php echo $data['gender']; ?></td>
                                                <td><?php echo $data['hobbies']; ?></td>
                                                <td><?php echo $data['occupation']; ?></td>
                                                <td><?php echo $data['about']; ?></td>
                                                <td>
                                                    <button class="btn btn-outline-success" onclick="fetchUser(<?php echo $data['id']; ?>)"><i class="fas fa-user-edit"></i></button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-danger" onclick="deleteUser(<?php echo $data['id']; ?>)"><i class="fas fa-user-slash"></i></button>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                    <ul class="pagination justify-content-center">
                        <?php
                            $select = "SELECT COUNT(*) FROM `users`";
                            $run = mysqli_query($conn, $select);
                            $data = mysqli_fetch_assoc($run);

                            $count = $data['COUNT(*)']; 
                            $page = ceil($count/$num);

                            $start = 0;

                            for ($i = 0; $i < $page; $i++) { 
                                $start = $i * $num;
                                ?>
                                    <li class="page-link" id="<?php echo $i + 1; ?>" onclick="pagination(<?php echo $start; ?>, <?php echo $num; ?>)">  
                                        <?php echo $i + 1; ?>
                                    </li> 
                                <?php
                            }
                        ?>
                    </ul>
                    <script>
                        $(document).ready(function(){
                            $("ul").find("li#"+1).css("background-color", "#4287f5").css("color", "#ffffff");
                        });
                    </script>
                <?php
            } else {
                echo mysqli_error($conn);
            }
        ?>
    </body>
</html>
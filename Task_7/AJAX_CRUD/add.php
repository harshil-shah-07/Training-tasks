    <?php

    $conn = mysqli_connect("localhost", "root", "Bytes@123", "test");
    
    if ($conn) {
        $base_query = "INSERT INTO `users` SET `firstName` = '".$firstName."', `lastName` = '".$lastName."', `email` = '".$email."', `gender` = '".$gender."', `occupation` = '".$occupation."', `about` = '".$about."'";

        if (!empty($hobbies)) {
            $insert = $base_query.", `hobbies` = '".$hobbies."'";
        } else {
            $insert = $base_query;
        }

        if (!empty($flag_img == 1)) {
            $insert = $insert.", `image` = '".$img_name."'";
        }

        $run = mysqli_query($conn, $insert);

        if ($run) {
            require("select.php");
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo mysqli_error($conn);
    }
?>
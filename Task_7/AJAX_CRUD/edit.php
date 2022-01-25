<?php

    $id = $_REQUEST['id'];

    $conn = mysqli_connect("localhost", "root", "Bytes@123", "test");

    $update = "UPDATE `users` SET `firstName` = '".$firstName."', `lastName` = '".$lastName."', `email` = '".$email."', `gender` = '".$gender."', `hobbies` = '".$hobbies."', `occupation` = '".$occupation."', `about` = '".$about."'";

    if (($flag_img == 1)) {
        $update = $update.", `image` = '".$img_name."' WHERE `id` = ".$id;
    } else {
        $update = $update." WHERE `id` = ".$id;
    }
    $run = mysqli_query($conn, $update);

    if($run) {
        require("select.php");
    } else {
        echo mysqli_error($conn);
    }
?>
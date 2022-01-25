<?php
    $id = $_REQUEST['userId'];
    $conn = mysqli_connect("localhost", "root", "Bytes@123", "test");

    if ($conn) {
        $delete = "DELETE FROM `users` WHERE `id` = ".$id;
        $run = mysqli_query($conn, $delete);

        if ($run) { 
            require("select.php");
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo mysqli_error($conn);
    }
?>
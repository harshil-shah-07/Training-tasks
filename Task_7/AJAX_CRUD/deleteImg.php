<?php
    $id = $_REQUEST['id'];

    $conn = mysqli_connect("localhost", "root", "Bytes@123", "test");
    $update = "UPDATE `users` SET `image` = 'user.png' WHERE `id` = ".$id;
    $run = mysqli_query($conn, $update);
    
    if($run) {
        require "select.php";
    } else {
        echo mysqli_error($conn);
    }
?>
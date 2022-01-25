<?php
    $id = $_REQUEST['userId'];

    $conn = mysqli_connect("localhost", "root", "Bytes@123", "test");
    $select = "SELECT * FROM `users` WHERE `id` = '".$id."'";
    $run = mysqli_query($conn, $select);

    $user = array();
    $user_hobbies = array();

    while ($data = mysqli_fetch_assoc($run)) {
        array_push($user, $data['id']);
        array_push($user, $data['image']);
        array_push($user, $data['firstName']);
        array_push($user, $data['lastName']);
        array_push($user, $data['email']);
        array_push($user, $data['gender']);
        array_push($user, explode(", ", $data['hobbies']));
        array_push($user, $data['occupation']);
        array_push($user, $data['about']);
    }
    
    $userData = json_encode($user);

    echo $userData;

?>
<?php session_start();

    if (!isset($conn)) {
        $conn = mysqli_connect("localhost", "root", "Bytes@123", "test");
    }

    $num = $_REQUEST['num'] ?? 5;
    $start = $_REQUEST['start'] ?? 0;

    $select = "SELECT * FROM `users` LIMIT ".$start.", ".$num;
    $run_select = mysqli_query($conn, $select);

    $select_count = "SELECT COUNT(*) FROM `users`";
    $run_count = mysqli_query($conn, $select_count);
    $data_count = mysqli_fetch_assoc($run_count);
    $count = $data_count['COUNT(*)']; 
    $page = ceil($count/$num);

    if ($run_select) {
        $row = array();

        while ($data = mysqli_fetch_assoc($run_select)) {
            $user = array();
            array_push($user, $data['id']);
            array_push($user, $data['image']);
            array_push($user, $data['firstName']);
            array_push($user, $data['lastName']);
            array_push($user, $data['email']);
            array_push($user, $data['gender']);
            array_push($user, $data['hobbies']);
            array_push($user, $data['occupation']);
            array_push($user, $data['about']);
            array_push($row, $user);
        }

        array_push($row, $page);
        array_push($row, $start);
        array_push($row, $num);

        $userData = json_encode($row);

        echo $userData;
    } else {
        echo mysqli_error($conn);
    }
?>
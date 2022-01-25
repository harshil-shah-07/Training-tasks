<?php
    $imgs = $_REQUEST['imgs']; 

    $image_names = [];

    for ($i = 0; $i < count($imgs); $i++) { 
        array_push($image_names, substr($imgs[$i], 12, strlen($imgs[$i])));  
    }

    for ($i = 0; $i < count($imgs); $i++) { 
        $image_path = __DIR__."/Images/".$image_names[$i];
        move_uploaded_file($image_names[$i], $image_path);
    }

    $imgs = @implode(", ", $image_names);

    $conn = mysqli_connect("localhost", "root", "Bytes@123", "test");

    if ($conn) {
        
        $insert = "INSERT INTO `coverImgs` (`images`) VALUES('".$imgs."')";
        $run = mysqli_query($conn, $insert);

        if($run) {
            $select = "SELECT `images` FROM `coverImgs`";
            $run_select = mysqli_query($conn, $select);

            $imgs = array();

            if ($run_select) {
                while ($data = mysqli_fetch_assoc($run_select)) {
                    array_push($imgs, $data['images']);
                };
                echo json_encode($imgs);
            } else {
                echo mysqli_error($conn);
            }
        } else {
            echo mysqli_error($conn);
        } 
    } else {
        echo mysqli_error($conn);
    }
?>
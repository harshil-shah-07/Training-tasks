<?php
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $email = $_REQUEST['email'];
    $gender = $_REQUEST['gender'];
    $h = $_REQUEST['hobbies'];
    $hobbies = @implode(", ", $h);
    $occupation = $_REQUEST['occupation'];
    $about = $_REQUEST['about'];
    $type = $_REQUEST['type'];

    $errors = array("errors");

    if (!empty($_FILES['image']['name'])) {

        $path_parts = pathinfo($_FILES['image']['name']);
        $ext = $path_parts['extension'];

        if ($ext !== "jpeg" && $ext !== "jpg" && $ext !== "png")	 
        {
            $err_img = "*Image must have .jpeg, .jpg or .png extension";
            array_push($errors, $err_img);
            $flag_img_err = 1;
        } else {
            $flag_img_err = 0;
        }
    }

    if (empty($firstName) || empty($lastName) || empty($email) || empty($gender) || empty($occupation) || empty($about)) {
        
        if ($firstName == "") {
            $err_fname = "*First Name field must not be vacant";
            array_push($errors, $err_fname);
        }
        if ($lastName == "") {
            $err_lname = "*Last Name field must not be vacant";
            array_push($errors, $err_lname);
        }
        if ($email == "") {
            $err_email = "*Email field must not be vacant";
            array_push($errors, $err_email);
        }
        if ($gender == "") {
            $err_gender = "*Gender field must not be vacant";
            array_push($errors, $err_gender);
        }
        if ($occupation == "") {
            $err_occupation = "*Occupation field must not be vacant";
            array_push($errors, $err_occupation);
        }
        if ($about == "") {
            $err_about = "*About field must not be vacant";
            array_push($errors, $err_about);
        }
        $errors = json_encode($errors);
        echo $errors; die;
    }

    if (!empty($_FILES['image']['name']) && $flag_img_err == 0) {

        $img_name = $_FILES['image']['name'];
        $img_path = __DIR__."/Images/".basename($img_name);

        $file_store = move_uploaded_file($_FILES['image']['tmp_name'], $img_path);

        $flag_img = 1;
    } elseif (!empty($_FILES['image']['name']) && $flag_img_err == 1) {
        $errors = json_encode($errors);
        echo $errors; die;
    } else {
        $flag_img = 0;
    }

    if ($type == "ADD") {
        require("add.php");
    } elseif ($type == "EDIT") {
        require("edit.php");
    }
?>
<?php
    require("database.php");

    $fname = test_input($_REQUEST['fname']);
    $lname = test_input($_REQUEST['lname']);
    $email = test_input($_REQUEST['email']);
    
    $fnameErr = 0;
    $lnameErr = 0;
    $emailErr = 0;
    $flag = 0;

    if(empty($fname) || $fname == "") {
        $flag++;
        $fnameErr = 1;
    } 

    if(empty($lname) || $lname == "") {
        $flag++;
        $lnameErr = 1;
    } 

    if (empty($email) || $email == "") {
        $flag++;
        $emailErr = 1;
    } 
        
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($flag == 0) {

        $insert = "INSERT INTO `users` (`First_Name`, `Last_Name`, `Email`) VALUES ('$fname', '$lname', '$email')";
        $run = mysqli_query($conn, $insert);

        if($run) {
            $_SESSION['user'] = "new addition";
            header('Location: index.php');
        } else {
            echo mysqli_error($conn);
        }
    } else {
        header("Location: add.php?fnameErr=".$fnameErr."&lnameErr=".$lnameErr."&emailErr=".$emailErr."&First_Name=".$fname."&Last_Name=".$lname."&Email=".$email);
    }
?>
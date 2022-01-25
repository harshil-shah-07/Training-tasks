<?php 

    if (!empty($_FILES['inputFile']['name'])) {

        $pathParts = pathinfo($_FILES['inputFile']['name']);
        $ext = $pathParts['extension'];

        if ($ext == "csv") {
            $filename = $_FILES['inputFile']['tmp_name'];

            if($_FILES['inputFile']['size'] > 0) {
                $file = fopen($filename, "r");

                $records = 0;

                while (($data = fgetcsv($file, 500, ",")) && $records < 300) {

                    $conn = mysqli_connect("localhost", "root", "Bytes@123", "keyolo_airbnb");

                    $insert = "INSERT INTO `airbnb_seedlist2_test6` (`airid`, `pricerange`, `pagenum`, `datetime`, `stateurl`, `downloaded_date`, `detail_processed`, `detail_failed`, `detail_downloaded_date`, `is_non_us`, `country`) VALUES ('".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6]."', '".$data[7]."', '".$data[8]."', ".$data[9].", '".$data[10]."', '".$data[11]."')";
                
                    $run = mysqli_query($conn, $insert);

                    if ($run) {
                        $records++;
                    } else {
                        echo "Data inserted successfully";
                    }
                }
                echo "File imported successfully.";
            } else {
                echo "File size is not adequate.";
            }
        } else {
            echo "File must have .csv extension.";
        }
    } else {
        echo "Please select a file.";
    }
?>
<?php session_start(); include('contents.php'); ?>

        <h2><center><b>FILE OPERATIONS</b></center></h2>

        <center>

            <?php
                function display()
                {
                    $message = $_SESSION['file'];
                    session_destroy();

                    ?>
                         <span class="alert <?php if($message == "deleted") echo "alert-danger"; elseif($message == "copied") echo "alert-info"; ?> alert-dismissible fade show" role="alert">
                             <strong><?php echo "File ".$message ;?> successfully</strong> 
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </span> 
                     <?php
                }

                if (isset($_SESSION['file'])) {
                    display();
                }
            ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form mt-4">

                <p>
                    <b>Name: </b><input type="text" name="name" id="name" class="form-control col-4" value="<?php echo $_REQUEST['name']; ?>" <?php if (isset($_REQUEST['name'])) echo "readonly"; ?>>
                    <span style="color: red; "><?php echo $err_name; ?></span>
                </p>

                <label for="add_contents" class="form-label"><b>File Contents: </b></label>
                <textarea name="contents" id="contents" cols="30" rows="5" class="form-control col-4"><?php echo $_REQUEST['contents']; ?></textarea>
                <span style="color: red;"><?php echo $err_contents; ?></span><br>

                <p>
                    <input type="submit" name="submit" value="Add content" class="btn btn-outline-primary col-md-4">
                </p>

            </form>

        </center>
    </body>
</html>
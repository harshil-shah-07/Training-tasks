<html>
    <head>
        <title>Send a mail</title>
        <!-- Bootstrap CDN -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    </head>
    <body>

    <h2><center><b>SEND A MAIL</b></center></h2>

    <center>
        <div class="col-md-6 mt-4">
            <form method="POST" action="mailer.php" enctype="multipart/form-data">

                <div class="md-3">
                    <label for="from_name" class="form-label"><b>Source's Name: </b></label>
                    <input type="text" class="form-control" id="from_name" name="from_name" 
                    value="<?php echo (isset($_POST['from_name'])) ? $_POST['from_name'] : $user_data['from_name'];?>">
                </div>
                <br>

                <div class="md-3">
                    <label for="from_email" class="form-label"><b>Source's Email Id: </b></label>
                    <input type="text" class="form-control" id="from_email" name="from_email" 
                    value="<?php echo (isset($_POST['from_email'])) ? $_POST['from_email'] : $user_data['from_email'];?>">
                </div>
                <br>

                <div class="md-3">
                    <label for="to_name" class="form-label"><b>Recipient's Name: </b></label>
                    <input type="text" class="form-control" id="to_name" name="to_name" 
                    value="<?php echo (isset($_POST['to_name'])) ? $_POST['to_name'] : $user_data['to_name'];?>">
                </div>
                <br>
                
                <div class="md-3">
                    <label for="to_email" class="form-label"><b>Recipient's Email Id: </b></label>
                    <input type="text" class="form-control" id="to_email" name="to_email" 
                    value="<?php echo (isset($_POST['to_email'])) ? $_POST['to_email'] : $user_data['to_email'];?>">
                </div>
                <br> 

                <div class="md-3">
                    <label for="subject" class="form-label"><b>Subject of Mail: </b></label>
                    <input type="text" class="form-control" id="subject" name="subject" 
                    value="<?php echo (isset($_POST['subject'])) ? $_POST['subject'] : $user_data['subject'];?>">
                </div>
                <br> 

                <div class="md-3">
                    <label for="body" class="form-label"><b>Mail Body: </b></label>
                    <textarea name="body" id="body" cols="65" rows="5"><?php echo (isset($_POST['body'])) ? $_POST['body'] : $user_data['body'];?></textarea>
                    <span style="color:red"><?php echo $error_body; ?></span>
                </div>
                <br>
                
                <input type="hidden" name="type" value="ADD">
                <button type="submit" class="btn btn-primary col-md-12">Submit</button>
            </form>
        </div>
    </center>
    </body>
</html>
<script>
    CKEDITOR.replace("body",{width: "500", height: "200"})
</script>
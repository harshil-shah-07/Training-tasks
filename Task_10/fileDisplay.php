<html>

    <head>
        <title>Multiple images preview and uploading</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Loading Bootstrap and jQuery CDN file -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Loading Bootstrap Glyphicon library -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <link rel="shortcut icon" href="/favicon.ico">
    </head>

    <body class="container">

        <p id="demo"></p>

        <form method="POST" class="form" id="myForm" enctype="multipart/formdata">
            <span><b>Cover Images: </b></span>
            <div id="previewImg" style="height: 288px; border: 2px solid rebeccapurple;"></div>
            <div>
                <label for="coverImage"><b>Cover Image: </b></label>
                <input type="file" multiple name="coverImg[]" id="coverImg">
            </div>
            <input type="button" value="Submit" id="imgSubmit">
        </form>

    </body>

    <!-- JS functions & jQuery code-->
    <script>
        let fileNames = [];
        $(document).ready(function() {

            $("#coverImg").change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[0]);
                    
                    fileNames.push($("#coverImg").val());

                    reader.onload = function(e) {
                        $("#previewImg").append("<div style='width: 120px; height: 140px;'><button type='button' class='close' onclick='deletePreviewImg(this)'>&times;</button><div style='display: none;'>"+fileNames[0]+"</div><img id='img1' src='"+e.target.result+"' style='width: 120px; height: 120px;'></div>");

                        // var tmppath = URL.createObjectURL(event.target.files);

                        // console.log(tmppath);
                    }
                }
            });

            $("#imgSubmit").on("click", function(){
                $.ajax({
                    url: "fileUpload.php",
                    type: "POST",
                    data: {
                        imgs: fileNames
                    },
                    // dataType : 'json',
                    success: function(result) {
                        console.log(result);
                    }
                });
            });
        });

        function deletePreviewImg(input) {
            fileNames.splice(fileNames.indexOf($(input).next().text()), 1);
            $(input).parent().remove();
        }

        function move() {
            var myObject, f;
            myObject = new ActiveXObject("Scripting.FileSystemObject");
            f = myObject.GetFile("c:\\test.txt");
            f.Move("D:\\");
        }
    </script>
</html>
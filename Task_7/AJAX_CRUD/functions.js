function addUser() {
    concealErrors();
    var front_errors = validateUser();
    if (front_errors == 0) {
        $("#myModal").modal('hide');
        var formData = new FormData(document.getElementById("myForm"));        
        $.ajax ({
            url: "validation.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(result) {
                var userData = JSON.parse(result);
                $("#type").val('ADD');
                if (userData[0] == "errors") {
                    displayErrors(userData);
                } else {
                    displayTable(userData);
                }
            }
        });
    } else {
        $("#myModal").modal('show');
    }
}

function fetchUser(id) {
    $.ajax({
        url: "update.php",
        type: "GET",
        data: {
            userId: id
        },
        success: function(result) {
            var userData = JSON.parse(result);

            $(".modal-title").html("<b>EDIT USER DATA</b>");
            $("#id").val(userData[0]);
            $("#imgDisplay").attr("src", "Images/"+userData[1]);
            $("#delImg").prop("disabled", false);
            $("#image").val('');
            $("#firstName").val(userData[2]);
            $("#lastName").val(userData[3]);
            $("#email").val(userData[4]);
            $("input[type=radio][value="+userData[5]+"]").prop('checked', true);
            if (userData[5].length > 1) {
                for (let index = 0; index < userData[6].length; index++) {
                    $("input[type=checkbox][value="+userData[6][index]+"]").prop('checked', true);
                }
            }
            $("#occupation").val(userData[7]);
            $("#about").val(userData[8]);
            $("#type").val("EDIT");
            $("#submitData").attr("onclick", "editUser()");

            $("#myModal").modal('show');
        }
    });
}

function closeModal() {
    $(".modal-title").html("<b>ADD A NEW USER</b>");
    $("#id").val('');
    $("#imgDisplay").attr("src", "Images/user.png");
    $("#image").val('');
    $("#firstName").val('');
    $("#lastName").val('');
    $("#email").val('');
    $("input[type=radio]").prop('checked', false);
    $("input[type=checkbox]").prop('checked', false);
    $("#occupation").val('');
    $("#about").val('');
    $("#type").val('ADD');
    $("#delImg").prop("disabled", true);
    concealErrors();
    $("#myModal").hide();
}

function editUser() {
    concealErrors();    
    var front_errors = validateUser();
    if (front_errors == 0) { 
        $("#myModal").modal('hide');
        var formData = new FormData(document.getElementById("myForm"));
        $.ajax({
            url: "validation.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(result) {
                var userData = JSON.parse(result);
                $("#type").val('ADD');
                if (userData[0] == "errors") {
                    displayErrors(userData);
                } else {
                    displayTable(userData);
                } 
            }
        });
    } else {
        $("#myModal").show();
    }
}

function deleteUser(id) {
    $.ajax({
        url: "delete.php",
        type: "GET",
        data: {
            userId: id
        },
        success: function (result) {
            var userData = JSON.parse(result);
            $("type").val('ADD');
            closeModal();
            displayTable(userData);
        }
    });
}

function displayTable(userData) {
    var table = "";

    for (let user = 0; user < userData.length - 3; user++) {
        table += "<tr>";
        for (let data = 0; data < userData[user].length; data++) {
            if (data == 1) {
                table = table + "<td><img src='Images/"+userData[user][data]+"' style='width: 50; height: 50;'></td>"
            } else {
                table = table + "<td>" + userData[user][data] + "</td>";
            } 
            
            if (data == 0) {
                var user_id = userData[user][data];
            }
        }
        table += "<td><button class='btn btn-outline-success' onclick='fetchUser("+user_id+")'><i class='fas fa-user-edit'></i></button></td>";
        table += "<td><button class='btn btn-outline-danger' onclick='deleteUser("+user_id+")'><i class='fas fa-user-slash'></i></button></td>";
        table += "</tr>";
    }

    var paginate = ""; var start = 0;
    var num = userData[userData.length - 1];
    var i = 0;
    for (let index = 0; index < userData[userData.length - 3]; index++, i++) {
        start = i * num;
        paginate = paginate + "<li class='page-link' id='"+(i+1)+"' onclick='pagination("+start+", "+num+")'>"+(i+1)+"</li>";
    }

    var id = userData[userData.length - 2] / userData[userData.length - 1];

    closeModal();
    $("tbody").html(table);
    $("ul.pagination").html(paginate);
    $("ul.pagination").find("li#"+(id+1)).css("background-color", "#4287f5").css("color", "#ffffff");
}

function concealErrors() {
    $("#err_fname").text('');
    $("#err_lname").text('');
    $("#err_email").text('');
    $("#err_gender").text('');
    $("#err_occupation").text('');
    $("#err_about").text('');
    $("#err_img").text('');
}

function displayErrors(userData) {
    for (let index = 1; index < userData.length; index++) {
        if (userData[index] == "*Image must have .jpeg, .jpg or .png extension") {
            $("#err_img").html(userData[index]);
        }
        if (userData[index] == "*First Name field must not be vacant") {
            $("#err_fname").html(userData[index]);
        }
        if (userData[index] == "*Last Name field must not be vacant") {
            $("#err_lname").html(userData[index]);
        }
        if (userData[index] == "*Email field must not be vacant") {
            $("#err_email").html(userData[index]);
        }
        if (userData[index] == "*Gender field must not be vacant") {
            $("#err_gender").html(userData[index]);
        }
        if (userData[index] == "*Occupation field must not be vacant") {
            $("#err_occupation").html(userData[index]);
        }
        if (userData[index] == "*About field must not be vacant") {
            $("#err_about").html(userData[index]);
        }
    }
    $("#myModal").modal('toggle');
}

function validateUser() {
    var front_errors = 0;

    var fname = $("#firstName").val();
    var lname = $("#lastName").val();
    var email = $("#email").val();

    var fname_pattern = /[^a-zA-Z]+/;
    var lname_pattern = /[^a-zA-Z]+/;
    var email_pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    var fname_result = fname_pattern.test(fname);
    if (fname_result == true) {
        $("#err_fname").html("*First Name field is in improper format");
        front_errors++;
    }

    var lname_result = lname_pattern.test(lname);
    if (lname_result == true) {
        $("#err_lname").html("*Last Name field is in improper format");
        front_errors++;
    } 

    var email_result = email_pattern.test(email);
    if (email_result == false) {
        $("#err_email").html("*Email field is in improper format");
        front_errors++;
    } 

    return front_errors;
}

function deleteImage() {
    var id = $("#id").val();
    $.ajax({
        url: "deleteImg.php",
        type: "GET",
        data: {
            id: id
        },
        success: function(result) {
            var userData = JSON.parse(result);
            closeModal();
            $("#myModal").modal('hide');
            displayTable(userData);
        }
    });
}

function showNewModal() {
    $("input[type=radio]").prop('checked', false);
    $("input[type=checkbox]").prop('checked', false);
    closeModal();
    $("#myModal").modal('toggle');
}

function pagination(start, num) {
    var id = start/num;
    $("ul.pagination").find("li").css("background-color", "").css("color", "");
    $("ul.pagination").find("li#"+(id+1)).css("background-color", "#4287f5").css("color", "#ffffff");
    $.ajax({
        url: "select.php",
        type: "GET",
        data: {
            start: start,
            num: num
        },
        success: function(result) {
            var userData = JSON.parse(result);
            displayTable(userData);
        }
    })
}

function dispRecords(num) {
    $.ajax({
        url: "select.php",
        type: "GET",
        data: {
            num: num
        },
        success: function(result) {
            var userData = JSON.parse(result);
            displayTable(userData);
        }
    })
}

$(document).ready(function() {
    $("#image").change(function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            var fileName = $("#image").val();

            reader.onload = function(e) {
                $("#imgDisplay").attr("src", e.target.result);
            }
        }
    });

    $("#coverImg").change(function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            var fileName = $("#image").val();

            reader.onload = function(e) {
                $("#previewImg").append("<div style='width: 120px; height: 140px;'><button type='button' class='close' onclick='deletePreviewImg(this)'>&times;</button><img id='img1' src='"+e.target.result+"' style='width: 120px; height: 120px;'></div>");
            }
        }
    });
});

function deletePreviewImg(input) {
    $(input).parent().remove();
}
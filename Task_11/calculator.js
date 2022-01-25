$(document).ready(function() {

    var a = [], b = [], operator = "", opFlagged = 0, bFlagged = 0, resFlagged = 0;

    $(".col").on("mouseover", function() {
        $(this).css("background-color", "yellow");
    });

    $(".col").on("mouseleave", function() {
        $(this).css("background-color", "");
    });

    $(".num").on("click", function() {

        if (resFlagged == 1) {
            clearAll();
        }

        $(this).css("background-color", "green");
        var val = $(this).find("b").text();
        display(val);

        if (opFlagged == 0) {
            a.push(val);
        } else {
            b.push(val);
            bFlagged = 1;
        }
    });

    $(".op").on("click", function() {
        if (bFlagged == 0) {
            $(this).css("background-color", "green");
            operator = $(this).find("input[type=hidden]").val();
            opFlagged = 1;
            display(operator);
        }
    });

    $("#result").on("click", function() {

        $(this).css("background-color", "green");
        
        if (a.length > 0 && b.length > 0) {

            var str_a = "", str_b = "";

            for (let i = 0; i < a.length; i++) str_a += a[i];

            for (let i = 0; i < b.length; i++) str_b += b[i];

            var num_a = Number(str_a);
            var num_b = Number(str_b);

            switch (operator) {
                case "+":
                    var result = num_a + num_b;
                    $("#calculator").val(num_a + " " + operator + " " + num_b + " = " + result);
                    break;
                
                case "-":
                    var result = num_a - num_b;
                    $("#calculator").val(num_a + " " + operator + " " + num_b + " = " + result);
                    break;
                    
                case "*":
                    var result = num_a * num_b;
                    $("#calculator").val(num_a + " " + operator + " " + num_b + " = " + result);
                    break;

                case "/":
                    var result = num_a / num_b;
                    $("#calculator").val(num_a + " " + operator + " " + num_b + " = " + result);
                    break;

                default:
                    break;
            }

            resFlagged = 1;
        } else {
            clearAll();
        }
    });
    
    $("#clear").on("click", clearAll = () => {
        $("#clear").css("background-color", "green");
        a = []; b = []; operator = ""; 
        str_a = ""; str_b = ""; opFlagged = 0;
        num_a = ""; num_b = ""; result = "";
        $("#calculator").val(""); bFlagged = 0;
        resFlagged = 0; $("#clear").css("background-color", "");    
    });

    display = (val) => {
        var str = $("#calculator").val();
        if (isNaN(val)) {

            if (str.endsWith(" + ")) {
                str = replaceOp(str, " + ", val);
            } else if (str.endsWith(" - ")) {
                str = replaceOp(str, " - ", val);
            } else if (str.endsWith(" * ")) {
                str = replaceOp(str, " * ", val);
            } else if (str.endsWith(" / ")) {
                str = replaceOp(str, " / ", val);
            } else {
                str += " " + val + " ";
            }

        } else {
            str += val;
        }
        $("#calculator").val(str);
    }

    replaceOp = (str, op, val) => {
        str = str.replace(op, " " + val + " ");
        return str;
    }
});

function test1()
{
    let fileExt = "pdf"
    const availableExtensions = ['pdf', 'xls'];
    console.log(availableExtensions.includes(fileExt));
}
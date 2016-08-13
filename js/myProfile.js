
$(document).ready(function () {
$("#fileUploadField").on("change", function () {
        $("#profilePicForm").submit();        
    });

    $("input[type='text'], input[type='password'], input[type='email'], input[type='number']").focus(function () {
        $(this).animate({
            padding: '12px'
            , margin: '-4px'
        }, 500);

    });
    $("input[type='text'], input[type='password'], input[type='email'], input[type='number']").blur(function () {
        $(this).animate({

            padding: '8px'
            , margin: '0'
        }, 500);
    });

});

function verifySignUpInputLetters(id) {

    var name = document.getElementById(id).value;
    var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
    var checkCharacters = false;
    var checkNumber = false;
    var nome1 = "";
    var nome2 = "";
    for (var i = 0; i < name.length; i++) {
        for (var j = 0; j < specialChars.length; j++) {
            if (name[i] == specialChars[j]) {
                var checkCharacters = true;
                for (var l = 0; l < name.length - 1; l++) {
                    nome1 += name[l];
                }
            }
        }

        if (!isNaN(name[i])) {
            var checkNumber = true;
            for (var l = 0; l < name.length - 1; l++) {
                nome2 += name[l];
            }


        }
    }
    if (checkCharacters || checkNumber) {
        if (checkCharacters) {
            alert("character is not accepted");
            document.getElementById(id).value = nome1;
        }
        if (checkNumber) {
            alert("Number is not accepted");
            document.getElementById(id).value = nome2;
        }
    }

}

function verifySignUpInputLettersLength(id) {
    if ((document.getElementById(id).value).length < 5 && (document.getElementById(id).value).length != 0) {
        alert('Name must be more than 5 letters!');
        document.getElementById(id).focus();
    }

}
String.prototype.replaceAt = function (index, character) {
    return this.substr(0, index) + character + this.substr(index + character.length);
}

function verifySignUpNumber(id) {
    var number = document.getElementById(id).value;
    var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
    var checkCharacters = false;
    var checkLetter = false;
    var number1 = "";
    var number2 = "";

    for (var i = 0; i < number.length; i++) {
        if (i!=0 && i!= 3 && i!=4  && i!= 10) {
            for (var j = 0; j < specialChars.length; j++) {
                if (number[i] == specialChars[j]) {
                    var checkCharacters = true;
                    for (var l = 0; l < number.length - 1; l++) {
                        number1 += number[l];
                    }
                }
            }

            if (isNaN(number[i])) {
                var checkLetter = true;
                for (var l = 0; l < number.length - 1; l++) {
                    number2 += number[l];
                }
            }
        }
    }
    if (checkCharacters || checkLetter) {
        if (checkCharacters) {
              alert("character is not accepted");
            document.getElementById(id).value = number1;
            return 0;
        }
        if (checkLetter) {
             alert("Letter is not accepted");
            document.getElementById(id).value = number2;
            return 0;
        }
    }
    var maskNumber = "";
    if (number.length > 15) {
        for (var i = 0; i < 15; i++) {
            maskNumber += number[i];
        }
    } else {
        if (number.length == 1) {
            maskNumber += "(" + number[0];
        } else {
            if (number.length == 3) {
                for (var i = 0; i < number.length; i++) {
                    maskNumber += number[i];
                }
                maskNumber += ") ";
            } else {
                if (number.length == 10) {
                    for (var i = 0; i < number.length; i++) {
                        maskNumber += number[i];
                    }
                    maskNumber += "-";
                } else {
                    for (var i = 0; i < number.length; i++) {
                        maskNumber += number[i];
                    }
                }
            }
        }
    }
    document.getElementById(id).value = maskNumber;
}











  
window.onload = function(){
                mostraForm(0);
            }
       
            
function mostraForm(num){
    
    var form1 = document.getElementById('profilePictureDiv');
    var form2 = document.getElementById("profileInfoForm");
    var form3 = document.getElementById("profileAddressForm");
    var form4 = document.getElementById("profilePasswordForm");

    var form5 = document.getElementById('deleteUserAccountForm');
    switch(num){
            
        case 0 :
            $(form1).hide(0);
            $(form2).hide(0);
            $(form3).hide(0);
            $(form4).hide(0);
            $(form5).hide(0);
            break;
        case 1:
            $(form1).show(300);
            $(form2).hide(400);
            $(form3).hide(400);
            $(form4).hide(400);
            $(form5).hide(400);
            //form2.style.display = "none";
            //form3.style.display = "none";
        break;
        case 2:
          
            $(form1).hide(400);
            $(form2).show(400);
            $(form3).hide(400);
            $(form4).hide(400);
            $(form5).hide(400);
            //form1.style.display = "none";
            //form2.style.display = "block";
            //form3.style.display = "none";
            break;
        case 3:
         
            $(form1).hide(400);
            $(form2).hide(400);
            $(form3).show(400);
            $(form4).hide(400);
            $(form5).hide(400);
           // form1.style.display = "none"
            //form2.style.display = "none";
            //form3.style.display = "block";
            break;
        
        case 4:
            $(form1).hide(400);
            $(form2).hide(400);
            $(form3).hide(400);
            $(form4).show(400);
            $(form5).hide(400);
            break;
        case 5:
            $(form1).hide(400);
            $(form2).hide(400);
            $(form3).hide(400);
            $(form4).hide(400);
            $(form5).show(400);
            break;
            
            
        case 11:
            $(form1).show(0);
            $(form2).hide(0);
            $(form3).hide(0);
            $(form4).hide(0);
            $(form5).hide(0);
        break;
            
        case 44:
            $(form1).hide(0);
            $(form2).hide(0);
            $(form3).hide(0);
            $(form4).show(0);
            $(form5).hide(0);
            break;
        }
}

function enableChangeButton(id){
    document.getElementById(id).disabled = false;
}

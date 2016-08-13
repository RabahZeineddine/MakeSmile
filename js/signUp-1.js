function verifySignUp_1InputUsername(id){

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

function verifySignUpInputUsernameLength(id){
 
      if ((document.getElementById(id).value).length < 5 && (document.getElementById(id).value).length != 0) {
        alert('Name must be more than 5 letters!');
        document.getElementById(id).focus();
    }
    
}
     



String.prototype.replaceAt=function(index, character) {
    return this.substr(0, index) + character + this.substr(index+character.length);
}
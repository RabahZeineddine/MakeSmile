$(document).ready(function () {
   $(".itemPicture").on("change", function () {
        $(".addPicture").submit();        
    });

});

function enableChangeButton(id){
    document.getElementById(id).disabled = false;
    
}

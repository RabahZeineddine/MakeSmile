$(document).ready(function () {
    
    $("input[type='text'], input[type='password'], input[type='email'], input[type='number']").focus(function () {
        $(this).animate({
            padding: '12px',
            margin: '-4px'
        }, 500);
       
    });
    $("input[type='text'], input[type='password'], input[type='email'], input[type='number']").blur(function () {
        $(this).animate({

            padding: '8px',
            margin: '0'
        }, 500);
    });
});
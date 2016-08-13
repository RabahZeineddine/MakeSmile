$(document).ready(function(){
     var back_images = ['images/home/slide-img1.jpg','images/home/slide-img2.jpg','images/home/slide-img3.jpg'];
        
    var step = 0;
    var tamanho = back_images.length;
    slideit();
    
    
    function slideit(){
        if(step < tamanho){
            $('.slideshow').css('background-image', 'url(' + back_images[step] + ')');
         
            step++;
            
        setTimeout(slideit, 4000);
        }else{
            step = 0 ;
            slideit();
        }
    }
    
});
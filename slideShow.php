
<?php
$slideimages = array("url('../images/home/slide-img1.jpg',url('../images/home/slide-img2.jpg',url('../images/home/slide-img3.jpg'");// create new array to preload images
  


    //variable that will increment through the images
    $step = 0;
    $tamanho = count($slideimages);

function slideit() {
    if ($step < ($tamanho - 1)) {
        $step++;
    } else {
        $step = 0;
    }
//    document.getElementById("slideshow").style.backgroundImage = slideimages[step];
    
         
}

?>
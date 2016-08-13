<?php 
    session_start();
    $username="";
    if( isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    $image_source="";
    if(isset($_POST['image_source'])){
        $image_source = $_POST['image_source'];
        
        
        rename("img//$username//profilePic//temp//$image_source","img//$username//profilePic//$image_source");
        $path = "img/$username/profilePic/temp/*";
        $files = glob($path); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }
        
    }
//    $image_old_source="";
//    if(isset($_POST['image_old_source'])){
//        $image_old_source = $_POST['image_old_source'];
//    }
    include 'userCRUD.php';


    echo $old_picture;
    readByUsername($username);
    changeProfilePic($image_source);
   
 $old_picture = "img//$username//profilePic//".$_SESSION['image_source'];
    unlink($old_picture);

   $_SESSION['image_source'] = $image_source;
//"profilePicture".$_SESSION['profilePicType'];

?>
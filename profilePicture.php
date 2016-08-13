<?php 
  $image_source = "images\\home\\proPic.png";
            $max_size = 100000;
           
            if(isset($_POST['MAX_SIZE_FILE'])){
                $max_size = $_POST['MAX_SIZE_FILE'];
          
            $allowed_types = array("image/png","image/jpeg");
            $file = $_FILES['PROFILE_PIC'];
            if($file['error']!= 0 ){
                echo "ERROR ON ULPOAD THE PICTIRE";
                switch($arquivo['error']){
                    case UPLOAD_ERR_INI_SIZE: // o arquivo excedeu o tamanho maximo
                        echo "<br>Maximum size exceeded";
                    break;
                        
                    case UPLOAD_ERR_FROM_SIZE: //the file is big but it did't exceed the max size
                        echo "<br>big file size..";
                    break;
                        
                    case ULPOAD_ERR_PARTIAL: // connection timed out during upload
                        echo "<br>Connection timed out";
                    break;
                        
                    case UPLOAD_ERR_NO_FILE: // When the user doesn't send any file
                        echo "<br>No uploaded file";
                    break;
                }
                exit; // stop the code.
            }
            
            if($file['size']==0 || $file['tmp_name']==null){
                //tmp_name it is a temporary name to the uploaded file
                echo "<p>Empty file or not found</p>";
                exit;
            }
        
            if($file['size']>$max_size){
                echo "<p>big size file</p>";
                exit;
            }
        
            if(array_search($file['type'],$allowed_types) === FALSE){
                echo "<p>File type is invalid</p>";
                exit;            
            }
        
            $name = $file['name'];
            $destiny =  "img\\";
        
       
            if(!file_exists($destiny)){
                mkdir($destiny, 0777,true);
            }
             
            switch($file['type']){
                case "image/png":
                    $name .= ".png";
                    $_SESSION['profilePicType'] = ".png"; // to move the pic with the right extension
                    break;
                    
                case "image/jpeg":
                    $name .= ".jpg";
                    $_SESSION['profilePicType'] = ".jpg";
                    break;
            }
       
            move_uploaded_file($file['tmp_name'],$destiny.$name);
            $image_source = "img\\$name";
        
            }


?>
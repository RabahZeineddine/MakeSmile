<!DOCTYPE html>
<html>

<head>
    <title>Sign up</title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <script src="js/jquery.js">
    </script>
    <script src="js/signUp.js"></script>
</head>

<body>
    <?php 
        
        session_start();
        
            $image_source  = "proPic.png";
            $max_size = 100000;
           
            if(isset($_POST['MAX_SIZE_FILE'])){
                $max_size = $_POST['MAX_SIZE_FILE'];
          
            $allowed_types = array("image/png","image/jpeg");
            $file = $_FILES['PROFILE_PIC'];
            if($file['error']!= 0 ){
                echo "ERROR ON ULPOAD THE PICTIRE";
                switch($file['error']){
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
        
          //  $name = $file['name'];
            $name = date("Y-m-d-H-i-s");
            
            $destiny =  "img\\$name\\temp\\";
        
       
            if(!file_exists($destiny)){
                mkdir($destiny, 0777,true);
            }
             
            switch($file['type']){
                case "image/png":
                    $name .= ".png";
                    break;
                    
                case "image/jpeg":
                    $name .= ".jpg";
                    break;
            }
       
            move_uploaded_file($file['tmp_name'],$destiny.$name);
            $image_source = $name;
        
            
        }
        ?>

    <?php  include 'header.php'; ?>
                <section class="signup_section_body">
                     <?php
            $nameInputValue = "";
            $lastnameInputValue = "";
            $numberInputValue = ""; 
            $genderInputValue = "";
        
             if(isset ($_SESSION['dbMsg-signUp']) && strcmp($_SESSION['dbMsg-signUp'], "")!=0 ){
                    $nameInputValue = $_SESSION['nameInputValue'];
                    $lastnameInputValue =  $_SESSION['lastnameInputValue'];
                    $numberInputValue = $_SESSION['numberInputValue'];
                
                     $image_source = $_SESSION['profilePictureValue'];
                    echo "<div> <p class='erro'>".$_SESSION['dbMsg-signUp']."</p></div>";
                    $_SESSION['dbMsg-signUp'] = "";
            }
        
           
            $genderMaleValue = "checked";
            $genderFemaleValue ="";
            if(strcmp($genderInputValue,"male")==0){
                $genderMaleValue = "checked";
                $genderFemaleValue ="";
            }else{
                if(strcmp($genderInputValue,"female")==0){
                    $genderFemaleValue = "checked";
                    $genderMaleValue = "";
                }
            }
        ?>
                    <div class="signup_section_container">
                        <form action="signUp.php" method="post" enctype="multipart/form-data" class="signupProfilePicForm">
                            <div class="hiddenFileInputContainter">
                                <img src="img/<?php echo $image_source; ?>" alt="profile pic" class="signup_profile_pic" />
                                <input type="file" name="PROFILE_PIC" accept="image/*" class="signupInputFile" value="<?php echo $image_source ?>" />
                            </div>
                            <input type="hidden" name="MAX_SIZE_FILE" value="100000" />
                        </form>
                        <form action="signUp-1.php" method="post" class="signup_info">
                            <div class="signup_name_lastname_div">

                                <input type="text" name="name" placeholder="Name" id="signup-name" value="<?php echo $nameInputValue; ?>" required="required" title="required!" class="signup_input_name" oninput="verifySignUpInputLetters(this.id)" onfocusout="verifySignUpInputLettersLength(this.id)" />
                                <input type="text" name="lastname" placeholder="Lastname" value="<?php echo $lastnameInputValue  ; ?>" required="required" title="required!" class="signup_input_lastname" id="signup-lastname" oninput="verifySignUpInputLetters(this.id)" onfocusout="verifySignUpInputLettersLength(this.id)" />

                            </div>
                            <div class="signup_input_gender_div">

                                <input type="radio" name="gender" id="male" <?php echo $genderMaleValue; ?> value="male"/>
                                <label for="male">Male</label>

                                <input type="radio" name="gender" <?php echo $genderFemaleValue; ?> id="female" value="female" />
                                <label for="female">Female</label>

                            </div>
                            <div class="signup_email_number_div">

                                <input type="email" name="email" placeholder="Email" required="required" class="signup_input_email" />
                                <input type="text" name="number" placeholder="Phone: (  )     - " value="<?php echo $numberInputValue; ?>" id="signup-number" class="signup_input_number" oninput="verifySignUpNumber(this.id)" />

                            </div>
                            <div class="signup_submit_div">

                                <input type="hidden" value="<?php echo $image_source ?>" name="PROFILE_PIC" />

                                <input type="submit" value="Next" class="signup_next_button" />

                            </div>
                        </form>
                    </div>
                </section>
                <footer>
                    <p>Copyright @2016</p>
                </footer>
        </body>

</html>
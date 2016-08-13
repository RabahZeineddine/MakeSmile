<?php
// Start the session
session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>My Profile</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <link type="text/css" rel="stylesheet" href="css/myProfile.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="js/jquery.js">
        </script>
        <script src="js/myProfile.js"></script>
    </head>

    <body>
        <?php
                $user_name = "";
                $user_lastname = "";
                $user_gender = "";
                $user_email = "";
                $user_number ="";
                $user_username = "";
                $user_address = "";
                $user_addNumber ="";
                $user_complement = "";
                $user_cep = "";
                $user_country = "";
                $user_state = "";
                $user_city = "";
               
            $enableStatus = "disabled";
        
        
            
            $current_Sidebar=array('sideList',' ');
            if(isset($_SESSION['username'])){
                $username = $_SESSION['username'];
                include 'side.php';
            }
            
            
            $current_image_source = "img\\$username\\profilePic\\".$_SESSION['image_source'];
            
            
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
        
           // $namePic = "newProfilePicture";
            $namePic = date("Y-m-d-H-i-s");
            $destiny = "img\\$username\\profilePic\\temp\\";
        
       
            if(!file_exists($destiny)){
                mkdir($destiny, 0777,true);
            }
             
            switch($file['type']){
                case "image/png":
                    $namePic  .= ".png";
                    break;
                    
                case "image/jpeg":
                    $namePic .= ".jpg";
                    break;
            }
            $image_old_source = $image_source;
          move_uploaded_file($file['tmp_name'],$destiny.$namePic);

            
            $current_image_source = $destiny.$namePic;
            $image_source = $namePic;
            $enableStatus = "";
        
            }
        
        //------------ pegar informacoes do DB ---------
        //step1: connect 
        include 'connect_mysql.php';
        
        //step2 : create sql
        $sql = "SELECT * FROM users WHERE username='$username'";
        
        //step3 treat the result
        
        $result = mysqli_query($connection,$sql);
        if($result && mysqli_num_rows($result)>0){
            while($row =  mysqli_fetch_array($result)){
                $user_name = $row['name'];
                $user_lastname = $row['lastname'];
                $user_gender = $row['gender'];
                $user_email = $row['email'];
                $user_number = $row['number'];
                $user_username = $row['username'];
                $user_address = $row['address'];
                $user_addNumber = $row['addNumber'];
                $user_complement = $row['complement'];
                $user_cep = $row['CEP'];
                $user_country = $row['country'];
                $user_state = $row['state'];
                $user_city = $row['city'];
            }   
        }
       
        $genderMaleValue = "";
        $genderFemaleValue = "";
        if(strcmp($user_gender,"female")==0){
            $genderMaleValue = "";
            $genderFemaleValue = "checked";
        }else{
            $genderMaleValue ="checked";
            $genderFemaleValue = "";
        }
        //step 4 : 
        mysqli_close($connection);
        
        ?>

            <section class="<?php echo $class_Section ?>">
                <section>
                    <?php include 'topMenu.php'; ?>
                </section>

                <?php 
                        
                            
                     
                     if(isset($_GET['command'])){
                         if(strcmp($_GET['command'],"prof")==0){
                             echo "<script>window.onload = function(){mostraForm(11);}</script>";
                         }
                         if(strcmp($_GET['command'],"password")==0){
                             echo "<script>window.onload = function(){mostraForm(44);}</script>";
                         }
                     }
                        ?>
                    <div class="divPerfil" onclick="mostraForm(1)">Update Profile Picture
                    </div>
                    <div id="profilePictureDiv">
                        <form action="myProfile.php?command=prof" method="post" enctype="multipart/form-data" id="profilePicForm">
                            <div id="signupRegisterPic" class="hiddenFileInputContainter">
                                <img src="<?php echo $current_image_source; ?>" alt="profile pic" id="cadastro_Profile_Pic" class="fileDownload" />
                                <input type="file" name="PROFILE_PIC" class="hidden" accept="image/*" id="fileUploadField" />
                            </div>
                            <input type="hidden" name="MAX_SIZE_FILE" value="100000" />
                        </form>
                        <form action="changeProfilePic.php" method="post" class="profilePicturForm">
                            <p>change profile picture</p>
                            <input type="hidden" name="image_source" value="<?php echo $image_source ?>" />

                            <input type="submit" id="changeButton" value="CHANGE" <?php echo $enableStatus; ?>/>
                        </form>
                    </div>
                    <div class="divPerfil" onclick="mostraForm(2)">Update Info
                    </div>
                    <form class="profileInfoForm" id="profileInfoForm" action="changeUserInfo.php" method="post">
                        <fieldset>
                            <legend>Info</legend>
                            <p>
                                <input type="text" name="name" placeholder="Name" value="<?php echo $user_name; ?>" required="required" title="required!" class="name-input" oninput="verifySignUpInputLetters(this.id)" onfocusout="verifySignUpInputLettersLength(this.id)" onchange="enableChangeButton('infoButton')" />
                                <input type="text" name="lastname" placeholder="Lastname" value="<?php echo $user_lastname  ; ?>" required="required" title="required!" class="lastname-input" oninput="verifySignUpInputLetters(this.id)" onfocusout="verifySignUpInputLettersLength(this.id)" onchange="enableChangeButton('infoButton')" />
                            </p>
                            <p>
                                <input type="radio" name="gender" id="male" <?php echo $genderMaleValue; ?> value="male" onchange="enableChangeButton('infoButton')" />
                                <label for="male">Male</label>

                                <input type="radio" name="gender" <?php echo $genderFemaleValue; ?> id="female" value="female" onchange="enableChangeButton('infoButton')" />
                                <label for="female">Female</label>
                            </p>
                            <p>
                                <input type="email" name="email" placeholder="Email" required="required" class="email-input" value="<?php echo $user_email; ?>" disabled/>
                                <input type="text" name="number" placeholder="Phone: (  )     - " value="<?php echo $user_number; ?>" class="number-input" oninput="verifySignUpNumber(this.id)" onchange="enableChangeButton('infoButton')" />
                            </p>
                            <p>
                                <input type="text" name="username" value="<?php echo $user_username; ?>" placeholder="Username" required="required" class="username-input" disabled/>

                            </p>

                            <p>
                                <input type="submit" value="CHANGE" disabled id="infoButton" />
                            </p>
                        </fieldset>
                    </form>
                    <div class="divPerfil" onclick="mostraForm(3)">Update Address
                    </div>
                    <form action="changeUserAddress.php" method="post" class="profileAddressForm" id="profileAddressForm">
                        <fieldset>
                            <legend>Address</legend>
                            <p>
                                <input type="text" name="address" placeholder="Address" required="required" class="address-input" value="<?php echo $user_address ?>" onchange="enableChangeButton('addressButton')" />
                                <input type="number" name="addNumber" placeholder="Number" required="required" class="addNumber-input" value="<?php echo $user_addNumber; ?>" onchange="enableChangeButton('addressButton')" />
                            </p>
                            <p>
                                <input type="text" name="complement" placeholder="Complement" class="complement-input" value="<?php echo $user_complement; ?>" onchange="enableChangeButton('addressButton')" />
                            </p>
                            <p>
                                <input type="text" name="CEP1" placeholder="Postal-code" required="required" class="cep1-input" value="" onchange="enableChangeButton('addressButton')" /> -
                                <input type="text" name="CEP2" required="required" class="cep2-input" pattern={3} onchange="enableChangeButton('addressButton')" value="" />
                            </p>
                            <p>
                                <select name="country" required="required" class="country-select" onchange="enableChangeButton('addressButton')">
                                    <option value="<?php echo $user_country;?>">
                                        <?php echo $user_country;?>
                                    </option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Lebanon">Lebanon</option>
                                </select>
                                <select name="state" required="required" class="state-select" onchange="enableChangeButton('addressButton')">
                                    <option value="<?php echo $user_state;?>">
                                        <?php echo $user_state;?>
                                    </option>
                                    <option value="SP">SP</option>
                                    <option value="RJ">RJ</option>
                                </select>
                            </p>
                            <p>
                                <input type="text" name="city" placeholder="City" required="required" class="city-input" value="<?php echo $user_city; ?>" onchange="enableChangeButton('addressButton')" />
                            </p>
                            <p>
                                <input type="submit" value="CHANGE" disabled id="addressButton" />
                            </p>
                        </fieldset>
                    </form>
                    <div class="divPerfil" onclick="mostraForm(4)">Change Password
                    </div>
                    <form action="changeUserPass.php" method="post" class="profilePasswordForm" id="profilePasswordForm">
                        <?php 
                     if(isset ($_SESSION['passwordAlert']) && strcmp($_SESSION['passwordAlert'], "")!=0 ){
                    echo "<p class='erro'>".$_SESSION['passwordAlert']."</p>";
                                 $_SESSION['passwordAlert']= "";
                                 
            }
                    
                    ?>
                            <fieldset>
                                <legend>Change Password</legend>

                                <p>
                                    <input type="password" name="currentPassword" placeholder="Current password" required="required" class="password-input" />
                                </p>
                                <p>
                                    <input type="password" name="newPassword" placeholder="New password" required="required" class="password-input" onchange="enableChangeButton('passButton')" />
                                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required="required" class="confirmPassword-input" />
                                </p>
                                <p>
                                    <input type="submit" value="CHANGE" id="passButton" disabled/>
                                </p>
                            </fieldset>
                    </form>
                    <div class="divPerfil" onclick="mostraForm(5)">Delete Account
                    </div>
                    <form action="profileDeleteForm.php" method="post" class="deleteUserAccountForm" id="deleteUserAccountForm">
                        <fieldset>
                            <legend>Delete Account</legend>
                            <input type="submit" value="DELETE" id="deleteUserButton" />
                            <a href="myProfile.php">
                                <div id="cancelDeleteUserButton">CANCEL</div>
                            </a>
                        </fieldset>
                    </form>
                    <?php 
                include 'footer.php';    
            ?>
            </section>

    </body>

    </html>
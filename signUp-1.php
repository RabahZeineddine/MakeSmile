<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8" />
    <link  type="text/css" rel="stylesheet" href="css/style.css"  />
    <link type="text/css" rel="stylesheet" href="css/index1.css" />
    <link rel="stylesheet" type="text/css" href="css/login1.css" />
    <script src="js/jquery.js">
    </script>
    <script src="js/login.js"></script>
    <script src="js/signUp-1.js"></script>
</head>

<body>
    <?php 
    
        session_start();
    
        $name="";
        if(isset($_POST['name'])){
            $name=$_POST['name'];
        }
        $lastname="";
        if(isset($_POST['lastname'])){
            $lastname=$_POST['lastname'];
        }
        $gender = "";
        if(isset($_POST['gender'])){
            $gender = $_POST['gender'];
        }
        $email = "";
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        $number = "";
        if(isset($_POST['number'])){
            $number = $_POST['number'];
        }
        $image_source = "";
        if(isset($_POST['PROFILE_PIC'])){
            $image_source = $_POST['PROFILE_PIC'];
        }
        
    
    //------------ Verify email in DB - --------------
    
      //Step 1: connection
        include "connect_mysql.php";
        
        //Step 2: prepare an sql
        $sql = "SELECT * FROM users WHERE email='$email'";
        
        //Step 3: treat the result
        $result = mysqli_query($connection,$sql);
        
        if($result && mysqli_num_rows($result)>0){
            if(strcmp($email,"")==0){
                $_SESSION['dbMsg-signUp'] = "Email needed!";
            }else{
                
            $_SESSION['dbMsg-signUp'] = "Email already exists!";  
            }
            $_SESSION['nameInputValue'] = $name;
            $_SESSION['lastnameInputValue'] = $lastname;
            $_SESSION['numberInputValue'] = $number;
            $_SESSION['genderInputValue'] = $gender;
            $_SESSION['profilePictureValue'] = $image_source;
            header('Location: signUp.php');
            
        }else{
            //nothing let the user rgisters :p
        }
      

    ?>
    
    <?php include'header.php'; ?>
    <section class="signup_1_section_body">
     <?php
        
             if(isset ($_SESSION['dbMsg-signUp-1']) && strcmp($_SESSION['dbMsg-signUp-1'], "")!=0 ){
                    echo "<p class='erro'>".$_SESSION['dbMsg-signUp-1']."</p>";
                    $_SESSION['dbMsg-signUp-1'] = "";
            }
             $usernameInputValue = "";
             if(isset ($_SESSION['errormsg-signUp-1']) && strcmp($_SESSION['errormsg-signUp-1'], "")!=0 ){
                    $usernameInputValue = $_SESSION['usernameInputValue'];
                    echo "<p class='erro'>".$_SESSION['errormsg-signUp-1']."</p>";
                    $_SESSION['errormsg-signUp-1'] = "";
            }
        ?>
    <form action="SignUp-2.php" method="post" class="signup_1_form">
        <fieldset class="signup1_fieldset">
            <legend >Register </legend>
           
            <div class="signup_1_username_div">
                 
                <input type="text" name="username" value="<?php echo  $usernameInputValue; ?>" placeholder="Username" required="required" id="signUp_username" oninput="verifySignUp_1InputUsername(this.id)" onfocusout="verifySignUpInputUsernameLength(this.id)"/>
            </div>
            <div class="signup_1_passwords_div">
            
                <input type="password" name="password" placeholder="Password" required="required" id="signup1-pass"/>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required="required" id="signup1-pass2"/>
            
            </div>
            <div class="signup_1_submit_div">
                <input type="hidden" name="name" value="<?php echo $name; ?>"/>
                <input type="hidden" name="lastname" value="<?php echo $lastname; ?>"/>
                <input type="hidden" name="gender" value="<?php echo $gender; ?>"/>
                <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                <input type="hidden" name="number" value="<?php echo $number; ?>"/>
                <input type="hidden" name="PROFILE_PIC" value="<?php echo $image_source; ?>"/>
                <input type="submit" value="Next" class="signup1_next_button" />
            </div>
        </fieldset>
    </form>
    </section>
     <footer id="login_footer">
        <p>Copyright @2016</p>
    </footer>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <script src="js/jquery.js">
    </script>
    <script src="js/login.js"></script>
</head>

<body>

    <?php 
        session_start();
    
    
        $username="";
        if( isset($_POST['username']) ){
            $username = $_POST['username'];
        }
    
        //------------ Verify username in DB ------------------
    
        //Step 1:  Connection
        include "connect_mysql.php";
    
        //Step 2: Prepare an sql
        $sql = "SELECT * FROM users WHERE username='$username'";
    
        //Step 3: treat the result
        
        $result = mysqli_query($connection,$sql);
        if($result && mysqli_num_rows($result)>0){
            $_SESSION['dbMsg-signUp-1'] = "Username already exists!";
            header('Location: signUp-1.php');
        }
    
        //step 4: close db
        mysqli_close($connection);
        
        $password = "";
        if( isset($_POST['password'])){
            $password = $_POST['password'];
        }
        $confirmPassword = "";
        if( isset($_POST['confirmPassword'])){
            $confirmPassword = $_POST['confirmPassword'];
        }
        if( strcmp($password,$confirmPassword)!=0){
            $_SESSION['usernameInputValue'] = $username;
            $_SESSION['errormsg-signUp-1'] = "Passwords do not match!";
            header('Location:signUp-1.php');
            exit;
        }else{
            
            
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
   //     echo $image_source;
        
        $namePic = $image_source;
        $destiny = "img\\$username\\";
        $newDestinyWithName = $destiny.$namePic;
        }
    
        if(!file_exists($destiny)){
            mkdir($destiny,0777,true);
        }
    //"img\\".$_SESSION['profilePic']
    
       if(file_exists("img\\".$image_source)){
           rename("img\\".$image_source,$newDestinyWithName);
       $image_destiny =$namePic;
            
    }
   
    ?>



        <header>
            <nav id="login_nav">
                <ul>
                    <a href="login.php">
                        <input type="button" value="Login" id="header_Login_button" />
                    </a>
                    <a href="about.php">
                        <li>
                            Who we are?
                        </li>
                    </a>
                    <a href="contact.php">
                        <li>
                            Contact us
                        </li>
                    </a>
                </ul>
            </nav>
        </header>
        <section id="signup2-back">
            <form action="final-signUp.php" method="post" id="signup2_form">
                <fieldset id="signup2_fieldset">
                    <legend>Register</legend>

                    </div>
                    <div id="signup2_info1">
                        <p>
                            <input type="text" name="address" placeholder="Address" required="required" id="signup2_address" />
                            <input type="number" name="addNumber" placeholder="Number" required="required" id="signup2_number" />
                        </p>
                        <p>
                            <input type="text" name="complement" placeholder="Complement" id="signup2_complement" />
                        </p>
                        <p>
                            <input type="text" name="CEP1" placeholder="Postal-code" required="required" id="signup2_postCode1" /> -
                            <input type="text" name="CEP2" required="required" id="signup2_postCode2" pattern={3}/>
                        </p>
                        <p>
                            <select name="country" required="required" id="signup2_select1">
                                <option value="">Choose your country</option>
                                <option value="brazil">Brazil</option>
                                <option value="lebanon">Lebanon</option>
                            </select>
                            <select name="state" required="required" id="signup2_select2">
                                <option value="">State</option>
                                <option value="sp">SP</option>
                                <option value="rj">RJ</option>
                            </select>
                        </p>
                        <p>
                            <input type="text" name="city" placeholder="City" required="required" id="signup2_city" />
                        </p>
                        <p>
                            <input type="hidden" name="username" value="<?php echo $username; ?>" />
                            <input type="hidden" name="password" value="<?php echo $password; ?>" />
                            <input type="hidden" name="name" value="<?php echo $name; ?>" />
                            <input type="hidden" name="lastname" value="<?php echo $lastname; ?>" />
                            <input type="hidden" name="gender" value="<?php echo $gender ?>" />
                            <input type="hidden" name="email" value="<?php echo $email; ?>" />
                            <input type="hidden" name="number" value="<?php echo $number; ?>" />
                            <input type="hidden" name="PROFILE_PIC" value="<?php echo $image_destiny; ?>" />
                            <input type="submit" value="Finish" id="signup2_finish_button" />
                        </p>
                    </div>

                </fieldset>
            </form>
        </section>
        <footer id="login_footer">
            <p>Copyright @2016</p>
        </footer>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="js/jquery.js"></script>
    <script src="js/login.js"></script>
</head>

<body>
    <?php include 'header.php'; ?>

        <section class="login_section_container">

            <?php 
                session_start();
            
                if( isset($_SESSION['wrongUsernameMsg']) && strcmp($_SESSION['wrongUsernameMsg'], "")!=0 ){
                      echo "<p class='erro'>".$_SESSION['wrongUsernameMsg']."</p>";
                        unset($_SESSION['wrongUsernameMsg']);
                }
            
                $usernameLoginValue= "";

                if(isset ($_SESSION['wrongPasswordMsg']) && strcmp($_SESSION['wrongPasswordMsg'], "")!=0 ){
                        echo "<p class='erro'>".$_SESSION['wrongPasswordMsg']."</p>";
                        unset($_SESSION['wrongPasswordMsg']);

                }

                $focusOnPass = "";
                if( isset($_SESSION['usernameLoginValue']) && strcmp($_SESSION['usernameLoginValue'],"")!=0){
                    $usernameLoginValue = $_SESSION['usernameLoginValue'];
                    unset($_SESSION['usernameLoginValue']);
                    $focusOnPass = "autofocus";

                }

                if(isset($_COOKIE['username'])){
                    $usernameLoginValue = $_COOKIE['username'];
                }
            ?>

                <form action="Control.php?cmd=verifyLogin" method="post" class="loginForm">
                    <fieldset>
                        <p>
                            <input type="text" name="username" placeholder="Username" required="required" id="username" value="<?php echo $usernameLoginValue; ?>" />
                        </p>
                        <p>
                            <input type="password" name="password" placeholder="Password" required="required" <?php echo $focusOnPass; ?>/>
                        </p>
                        <p>
                            <input type="checkbox" id="rememberUser" name="rememberUser" checked/>
                            <label for="rememberUser">Keep my username saved?</label>
                        </p>
                        <p>
                            <input type="submit" value="Login" class="loginButton" />
                        </p>
                    </fieldset>
                </form>
        </section>
        <footer>
            <p>Copyright @2016</p>
        </footer>
</body>

</html>
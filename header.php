
<?php 
    
    $button_value = "";
    $button_a = "";

    if(strcmp(basename($_SERVER['PHP_SELF']),"login.php") == 0){
        $button_value = "Sign up";
        $button_a = "signUp.php";
    }else{
        $button_value = "Login";
        $button_a = "login.php";
    }


?>

<header>
        <nav class="header_nav">
            <ul>
                <li>
                    <a href="contact.php">Contact us</a>
                </li>
                <li>
                    <a href="about.php">Who we are?</a>
                </li>
                <li>
                    <a href="<?php echo $button_a; ?>">
                        <input type="button" value="<?php echo $button_value; ?>" class="header_button" />
                    </a>
                </li>
            </ul>
        </nav>
</header>
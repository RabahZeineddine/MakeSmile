<?php
// Start the session
session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Contact us</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <script src="js/jquery.js"></script>
    </head>

    <body>



        <?php
            $current_Sidebar=array(' ',' ');
            if(isset($_SESSION['username'])){
                include 'side.php';
            }else{
                $class_Section="mainSectionGuest";

            }
        ?>
                <section class="<?php echo $class_Section ?>">
                    <section>
                        <?php include 'topMenu.php'; ?>
                    </section>
                    <section class="contact_Section">
                        <div class="contact_Section_Title">
                            <h2>Contact us</h2>
                        </div>
                        <div class="contact_Section_Hands">
                            <div class="div-img-1">
                                <img src="images/about/left.png" alt="left hand pic" />
                            </div>
                            <div class="div-img-2">
                                <img src="images/about/right.png" alt="right hand pic" />
                            </div>
                        </div>
                        <div class="contact_Section_Info">

                            <form action="contact_Sucess.php" method="post">
                                <?php 
                        if(isset($_SESSION['username'])){
                           echo "
                                
                        <div>
                            <textarea class='contact_message' cols='40' rows='10' placeholder='Enter your message here' ></textarea>
                        </div>
                       ";
                       }else{
                echo "
                        <div>
                            <input type='text' name='contact_name' class='contact_name' placeholder='Name'
                        </div>
                        <div>
                            <input type='email' class='contact_email' placeholder='Email' />
                        </div>
                        <div>
                            <textarea class='contact_message' cols='40' rows='10' placeholder='Enter your message here' ></textarea>
                        </div>
                       ";     
                        }
                    ?>
                                    <div>
                                        <input type="submit" value="Send" class="contact_send_button" />
                                    </div>
                            </form>

                        </div>

                    </section>
                    
                    <?php  include 'footer.php' ?>
                </section>
           


    </body>

    </html>
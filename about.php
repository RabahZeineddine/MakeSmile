<?php
// Start the session
session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>About</title>
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
                <section class="about_Section">
                    <div class="about_Section_Title">
                        <h2>About us</h2>
                    </div>
                    <div class="about_Section_Hands">
                        <div class="div-img-1">
                            <img src="images/about/left.png" alt="left hand pic" />
                        </div>

                        <div class="div-img-2">
                            <img src="images/about/right.png" alt="right hand pic" />
                        </div>
                    </div>
                    <div class="about_Section_Content">
                        <div class="about_Section_Content_Title">
                            <p>
                                <i>“Why keep everything and heap so many things that are no longer used, if it is possible to move to someone else and make them smile?”
                                </i>
                            </p>
                        </div>
                        <div class="about_Section_Content_Text">
                            <p class="about_section_content_text_1">MakeSmile is a donation website and our mission is to make the swap or donation of products in an easier and funnier way. Open your MakeSmile shop, look for friends and products that you want, navigate in your feed and see what is trending, and search for your favorite brands, from the vintage ones to the most current items. Donate by just taking a picture.
                            </p>
                            <p class="about_section_content_text_2">MakeSmile is home to influential trendsetters, emerging and established creatives from fashion, accessories, decoration and electronics.
                            </p>
                        </div>
                    </div>
                </section>
                <?php include 'footer.php'; ?>
            </section>
    </body>

    </html>
<?php
// Start the session
session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Home</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <script src="js/jquery.js">
        </script>
        <script src="js/slideShow.js"></script>
    </head>

    <body>
        <?php
        
            $current_Sidebar=array(' ',' ');
            if( isset($_SESSION["username"])){
                include 'side.php';
            }else{
                $class_Section="mainSectionGuest";
            }    
    ?>
        
            <section class="<?php echo $class_Section ?>">
                <section>
                    <?php include 'topMenu.php'; ?>
                </section>
                <section class="first_section">
                    <article class="slideshow"></article>
                </section>
                <section class="some_Products">
                    <div class="some_Products_title">
                        <h2>Some products</h2>
                    </div>
                    <div class="some_Products_Hands">
                        <div class="div-img-1">
                            <img src="images/home/left.png" alt="pic" />
                        </div>
                        <div class="div-img-2">
                            <img src="images/home/right.png" alt="pic" />
                        </div>
                    </div>
                    <div class="some_Products_items">
                        <div class="first_div">
                            <figure>
                                <img src="" alt="3rd pic" class="third_pic" />
                            </figure>
                            <figure>
                                <img src="" alt="2nd pic" class="second_pic" />
                            </figure>

                            <figure>
                                <img src="" alt="1st pic" class="first_pic" />
                            </figure>
                        </div>
                        <div class="second_div">
                            <figure>
                                <img src="" alt="2nd pic" class="second_pic" />
                            </figure>
                            <figure>
                                <img src="" alt="1st pic" class="first_pic" />
                            </figure>

                            <figure>
                                <img src="" alt="3rd pic" class="third_pic" />
                            </figure>
                        </div>

                        <div class="third_div">
                            <figure>
                                <img src="" alt="1st pic" class="first_pic" />
                            </figure>
                            <figure>
                                <img src="" alt="3rd pic" class="third_pic" />
                            </figure>
                            <figure>
                                <img src="" alt="2nd pic" class="second_pic" />
                            </figure>
                        </div>
                    </div>
                </section>

                <section class="top_Trending">
                    <div>
                        <h2>Top Trending</h2>
                    </div>
                    <div class="pic_top_Trending">
                        <img class="top_second" />
                        <img class="top_first" />
                        <img class="top_third" />
                    </div>
                </section>
                <?php include 'footer.php'; ?>
            </section>
        


    </body>

    </html>
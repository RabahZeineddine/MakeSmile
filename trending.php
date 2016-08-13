<?php
// Start the session
session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Trending</title>
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
                <section class="trending_Section">
                    <div class="trending_Section_Title">
                        <h2>Trends</h2>
                    </div>
                    <div class="trending_Section_Hands">
                        <div class="div-img-1">
                            <img src="images/trending/left.png" alt="left hand pic" />
                        </div>
                        <div class="div-img-2">
                            <img src="images/trending/right.png" alt="right hand pic" />
                        </div>
                    </div>
                </section>
                <section>

                    <section class="trending_category">
                        <div>
                            <a href="trendingCategory.php?category=clothes"><img src="images/trending/clothes.jpg" alt="clothes image" />
                            </a>
                        </div>
                        <div>
                            <a href="trendingCategory.php?category=decoration"><img src="images/trending/decoration.jpg" alt="decoration image" />
                            </a>
                        </div>
                        <div>
                            <a href="trendingCategory.php?category=electronic"><img src="images/trending/electronic.jpg" alt="electronic image" />
                            </a>
                        </div>
                    </section>
                </section>
                <?php include 'footer.php'; ?>
            </section>
        
    </body>

    </html>
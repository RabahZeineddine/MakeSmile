<?php
// Start the session
session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Products</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="css/home.css" />
        <script src="js/jquery.js">
        </script>
        <script src="sideBar.js">
        </script>
    </head>

    <body>
        <?php
            $current_Sidebar=array(' ',' ');
            $check = $_SESSION['logged'];
            if($check){
                $username= $_SESSION["username"] ;
                include 'sideBar.php';
            }else{
                $id_Section="mainSectionGuest";
                $id_Header = "headerGuest";  
            }
            include 'topMenu.php';
        ?>

            <section id="<?php echo $id_Section ?>">
               <section class="products_items">
                    <section class="products_items_1" id="trending_1st_item">
                        <figure>
                            <img src="" alt="1st item"/>
                            <figcaption>1st item</figcaption>
                        </figure>
                    </section>
                    <section class="products_items_1">
                        <figure>
                            <img src="" alt="2nd item"/>
                            <figcaption>2nd item</figcaption>
                        </figure>
                    </section>
                    <section class="products_items_1">
                        <figure>
                            <img src="" alt="3rd item"/>
                            <figcaption>3rd item</figcaption>
                        </figure>
                    </section>
           
                <p style="clear:both"></p>
                    <section class="products_items_1" id="trending_1st_item">
                        <figure>
                            <img src="" alt="4th item"/>
                            <figcaption>4th item</figcaption>
                        </figure>
                    </section>
                    <section class="products_items_1">
                        <figure>
                            <img src="" alt="5th item"/>
                            <figcaption>5th item</figcaption>
                        </figure>
                    </section>
                    <section class="products_items_1">
                        <figure>
                            <img src="" alt="6th item"/>
                            <figcaption>6th item</figcaption>
                        </figure>
                    </section>
                                
                
                </section>
                <p style="clear:both"></p>
                    
                <?php include 'footer.php'; ?>
            </section>
    </body>

    </html>
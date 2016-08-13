<?php
// Start the session
session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Clothes</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <script src="js/jquery.js">
        </script>
        <script src="sideBar.js">
        </script>
    </head>

    <body>
        <?php
            $current_Sidebar=array(' ',' ');
            if(isset($_SESSION['username'])){
            $username= $_SESSION["username"] ;
            include 'side.php';
            }else{
                $class_Section="mainSectionGuest";
            }
        ?>

            <section class="<?php echo $class_Section ?>">
                <section>
                    <?php include 'topMenu.php'; ?>
                </section>
                <section>


                    <section class="myDonations_Section">

                        <div class="donated_Items">
                            <?php 
                        
                        include 'connect_mysql.php';
                     
                        $sql = "SELECT clothes.id_item,clothes.item_title,clothes.item_picture,users.username FROM clothes INNER JOIN users ON clothes.id_user=users.id_user ORDER BY date DESC";
                     
                        $stmt=$connection->prepare($sql);
                        $stmt->execute();
                        $stmt->bind_result($db_id_item,$db_item_title,$db_item_picture,$db_username);
                        $stmt->store_result();
                        if($stmt->num_rows>0){
                            
                                        echo "<div class='donated_Items_sub'>";
                            while($stmt->fetch()){
                                echo "
                                            <div class='item_Donated_Father_Div'>
                                                    <div class='item_donated'>
                                                        <a href=''>
                                                        <figure>
                                                            <img src='img//$db_username//posts//clothes//$db_item_picture' alt='donated item'/>
                                                            <figcaption>$db_item_title</figcaption>
                                                        </figure>
                                                        </a>
                                                    </div>
                                                </div>
                        ";
                            }
                        
                                        echo "</div>";
                        }else{
                            echo "<p id='firstItemMessage'>There is no item available!</p>";
                        }
                   
                        $stmt->close();
                        $connection->close();
                    ?>

                        </div>
                    </section>
                </section>
                <?php include 'footer.php'; ?>
            </section>
    </body>

    </html>
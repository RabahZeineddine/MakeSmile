<?php
// Start the session
session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Clothes</title>
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
            if(isset($_SESSION['username'])){
            $username= $_SESSION["username"] ;
            include 'sideBar.php';
            }else{
                $id_Section="mainSectionGuest";
                $id_Header = "headerGuest";  
            }
            include 'topMenu.php';
        ?>

            <section id="<?php echo $id_Section ?>">
                   
                    <?php 
                        
                        $id_post = "";
                        $item_title="";
                        if(isset($_GET['id'])){
                            $id_post = $_GET['id'];
                        }
                        include 'connect_mysql.php';
                     
                        $sql = "SELECT * FROM posts WHERE id_post=$id_post";
                     
                        $result = mysqli_query($connection,$sql);
                     
                        if($result && mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_array($result)){
                                
                            }   
                        }else{
                            echo "<p id='firstItemMessage'>Somethin went wrong!</p>";
                        }
                    ?>
                  
                
              
                <?php include 'footer.php'; ?>
            </section>
    </body>

    </html>
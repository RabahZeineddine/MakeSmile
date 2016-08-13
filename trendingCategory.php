<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        <?php if(isset($_GET['category'])) echo $_GET['category'];?>
    </title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
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
                <section>
                    <section class="myDonations_Section">
                        <div>
                            <div class="donated_Items">
                                <?php 
                        
                    //------------ Get elements from DB -------
                        
                        include 'connect_mysql.php';
                    
                        $db_table_array = array();
                    
                        $category = "";
                        if(isset($_GET['category'])){
                            $category = $_GET['category'];


                            $stmt = $connection->prepare("SELECT id_table,table_name FROM tables");
                            $stmt->execute();
                            $stmt->bind_result($db_id_table,$db_table_name);
                            $stmt->store_result();
                            if($stmt->num_rows>0){
                                while($stmt->fetch()){
                                    $db_table_array[$db_id_table]=$db_table_name;
                                }
                            }
                            
                            $checkTableCategory = 0 ;
                            for($i=0;$i<count($db_table_array);$i++){
                                if(strcmp($category,$db_table_array[$i])==0){
                                    $checkTableCategory = 1;
                                }
                            }
                            if($checkTableCategory==0){
                                header('Location:messyuser.php');
                            }
                        }
                    
                    
                
                     
                        $sql = "SELECT $category.id_item,$category.item_title,$category.item_picture,users.username FROM $category INNER JOIN users ON $category.id_user=users.id_user ORDER BY date DESC";
                     
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
                                                        <a href='trendingItems.php?id=$db_id_item&category=$category'>
                                                        <figure>
                                                            <img src='img//$db_username//posts//$category//$db_item_picture' alt='donated item'/>
                                                            <figcaption>$db_item_title</figcaption>
                                                        </figure>
                                                        </a>
                                                    </div>
                                                </div>
                        ";
                            }
                        
                                        echo "</div>";
                        }else{
                            echo "<div class='noItemAvailable'><p>There is no item available!</p></div>";
                        }
                   
                        $stmt->close();
                        $connection->close();
                    ?>

                            </div>
                        </div>
                    </section>
                </section>
                <?php include 'footer.php'; ?>
            </section>
    </body>

    </html>
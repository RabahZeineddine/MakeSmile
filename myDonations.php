<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Donations</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <script src="js/jquery.js"></script>
    </head>
    <body>
        <?php
        
            $user_id = "";
            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
            }
            
            $current_Sidebar=array(' ','sideList');
            include 'side.php';
        ?>
        <section class="<?php echo $class_Section ?>">
            <section>
                <?php include 'topMenu.php'; ?>
            </section>
            
                <?php if(isset($_SESSION['alertMessage']) && strcmp($_SESSION['alertMessage'],"")!=0){
                     echo "<section><p class='erro'>".$_SESSION['alertMessage']."</p></section>";
                        unset($_SESSION['alertMessage']);
                     echo "<script>
                            window.setTimeout(function() {
                                window.location = 'myDonations.php';
                              }, 4000);
                            </script>";
                } ?>
            
                
            <section class="myDonations_Father_Section" id="myDonations_Father_Section">
                <section class="myDonations_Section">
                    
                    <div class="add_Div">
                        <a href="donationItem.php">
                            <button class="add_Donation_Button">Add a donation</button>
                        </a>
                    </div>
                    <div>
                        <div class="donated_Items">
                            <?php 
                            
                                $CHECK_ITEMS = 1;
                            
                                //------------ Get elements from DB -------
                                $db_table_array = array();
                                
                                
                                //step 1: Connection
                    
                                include 'connect_mysql.php';
                            
                                $stmt = $connection->prepare("SELECT id_table,table_name FROM tables");
                                $stmt->execute();
                                $stmt->bind_result($db_id_table,$db_table_name);
                                $stmt->store_result();
                                if($stmt->num_rows>0){
                                    while($stmt->fetch()){
                                        $db_table_array[$db_id_table]=$db_table_name;
                                    }
                                }
                               
                            
                                for($i=0 ; $i < count($db_table_array);$i++){
                                     //Step 2: Prepare a bind
                                    $sql = "SELECT id_item,item_title,item_picture FROM ".$db_table_array[$i]." WHERE id_user= ? ORDER BY date DESC";
                                    
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param("i",$user_id);
                                    $stmt->execute();
                                    $stmt->bind_result($db_id_item,$db_item_title,$db_item_picture);
                                    
                                    //Stroe Results
                                    $stmt->store_result();

                                    if($stmt->num_rows>0){
                                        $CHECK_ITEMS = 0 ;
                                        echo "<div class='category_items'><p>".$db_table_array[$i]."</p></div>";
                                        echo "<div class='donated_Items_sub'>";
                                        while($stmt->fetch()){
                                            echo"
                                                <div class='item_Donated_Father_Div'>
                                                    <div class='item_donated'>
                                                        <figure>
                                                            <img src='img//".$_SESSION['username']."//posts//".$db_table_array[$i]."//$db_item_picture' alt='donated item'/>
                                                            <figcaption>$db_item_title</figcaption>
                                                        </figure>
                                                        <div class='material-icons-div'>
                                                            <div>
                                                                <a href='Control.php?cmd=editDonatedItem&id=$db_id_item&category=".$db_table_array[$i]."'><i class='material-icons'>mode_edit</i>
                                                                </a>
                                                                <a href='myDonations.php?cmd=deleteItem&id=$db_id_item&category=".$db_table_array[$i]."&item_pic=$db_item_picture' ><i class='material-icons'>delete</i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ";
                                        }
                                        echo "</div>";
                                    }else{
                                    }
                                }
                                
                            $stmt->close();
                            $connection->close();
                            
                            if($CHECK_ITEMS==1){
                                echo "<div class='NoDonatedItems'>Add Your First Item!</div>";
                            }
            ?>
                            </div>
                        </div>
                    </section>
            </section>
            
                <?php include 'footer.php'; ?>
        </section>
        <?php 
        
            $cmd = "";
            $id_item =-1;
            $category="";
            $item_picture="";
            if(isset($_GET['cmd'])){
                $cmd=$_GET['cmd'];
                if(strcmp($cmd,"deleteItem")==0){
                    if(isset($_GET['id'])) $id_item = $_GET['id'];
                    if(isset($_GET['category'])) $category = $_GET['category'];
                    if(isset($_GET['item_pic'])) $item_picture = $_GET['item_pic'];
                    
                    echo "
                    <section class='deletePopupWindow'> 
                        <section class='deletePopupWindowBox'> 
                            <p>Are you sure you want to delete ?</p>
                            <div class='deleteButtonsDiv'>
                                <a href='myDonations.php''><button class='deletePopupNoButton'>No</button></a>
                                <a href='Control.php?cmd=deleteDonatedItem&id=$id_item&category=$category&item_pic=$item_picture'><button class='deletePopupYesButton'>Yes</button></a>
                            </div>
                        </section>
                    </section>
                    ";
                }
            }
        ?>
    </body>
</html>
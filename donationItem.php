<?php session_start(); ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Donation Item</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <link type="text/css" rel="stylesheet" href="css/add.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <script src="js/jquery.js">
        </script>
        <script src="js/donationItem.js"></script>
    </head>

    <body>
        <?php 
            $current_Sidebar=array(' ',' ');
            $username = $_SESSION['username'];
            include 'side.php';
    
            $max_size = 10000000000;
            $inputPictureText = "No file chosen";
        
            $form_action = "Control.php?cmd=uploadNewItem";
            $id_item = "";
            $item_title ="";
            $item_description= "";
            $item_category = "Select the category";
            $item_category_value = "";
            $image_source   = "img//proPic.png";
            $form_button_value = "Add";
    
    
            if(isset($_SESSION['id_item'])) $id_item = $_SESSION['id_item'];
            if(isset($_SESSION['item_title'])) $item_title = $_SESSION['item_title'];
            if(isset($_SESSION['item_description'])) $item_description = $_SESSION['item_description'];
            if(isset($_SESSION['item_category'])){
                    $item_category = $_SESSION['item_category'];
                    $inputPictureText = $_SESSION['item_picture'];
                    $form_action = "Control.php?cmd=updateOldItem";
                    $form_button_value = "Edit";
                    $item_category_value = $item_category;
            }
        
            if(isset($_GET['cmd'])){
                $cmd = $_GET['cmd'];
                if(strcmp($cmd,"editExistedItem")==0){
                    if(isset($_SESSION['item_picture'])) $image_source = "img//$username//posts//$item_category//".$_SESSION['item_picture']; 
                    
                    $item_picture_source = $_SESSION['item_picture'];
                }else{
                    header('Location:messyUser.php');
                    exit;
                }
            }
            
    
            if(isset($_POST['MAX_SIZE_FILE'])){
                
                $max_size = $_POST['MAX_SIZE_FILE'];
                
                $allowed_types = array("image/png","image/jpeg");
                    
                $file  = $_FILES['PictureInputFile'];
                if($file['error']!=0){
                    switch($file['error']){
                        case UPLOAD_ERR_INI_SIZE:
                            $_SESSION['FileError']="Maximum size exceeded";
                            
                            break;
                        case  UPLOAD_ERR_FROM_SIZE:
                            $_SESSION['FileError']="Big file size..";
                        break;
                    
                        case UPLOAD_ERR_PARTIAL:
                            $_SESSION['FileError']="Connection timed out!";
                        break;
                        case UPLOAD_ERR_NO_FILE: 
                            $_SESSION['FileError']="No uploaded file";
                        break;
                    }
                    header('Location:donationitem.php');
                    exit;
                }
            
        
            if($file['size']==0 || $file['tmp_name']==null){
                $_SESSION['FileError']="Empty file or not found";
                header('Location:donationitem.php');
                exit;
            }
        
            if($file['size']> $max_size){
                $_SESSION['FileError']="Big size file";
                header('Location:donationitem.php');
                exit;
            }
        
            if(array_search($file['type'],$allowed_types) === FALSE){
                $_SESSION['FileError']="File type is invalid";
                header('Location:donationitem.php');
                exit;
            }
        
            $name = date("Y-m-d-H-i-s");
            $destiny= "img\\$username\\posts\\temp\\";
        
            if(!file_exists($destiny)){
                mkdir($destiny,0777,true);
            }
        
            switch($file['type']){
                case "image/png":
                    $name .= ".png";
                    break;
                case "image/jpeg":
                    $name .= ".jpg";
                    break;
            }
            move_uploaded_file($file['tmp_name'],$destiny.$name);
            $image_source = $destiny.$name;
            $item_picture_source = $name;
            $inputPictureText = $file['name'];
                
            }else{
                unset($_POST['PictureInputFile']);
            }
    
        
        ?>
            <section class="<?php echo $class_Section ?>">
                <section>
                    <?php include 'topMenu.php'; ?>
                </section>
                <section>
                    <?php if( isset($_SESSION['FileError']) && strcmp($_SESSION['FileError'],"")!=0){
                     echo "<p class='erro'>".$_SESSION['FileError']."</p>";
                        unset($_SESSION['FileError']);
                } ?>
                </section>
                <section>
                    <div class="add_content">
                        <div>
                            <img src="<?php echo $image_source; ?>" alt="insert image" class="add_item_picture" />
                        </div>
                        <div>
                            <form action="donationItem.php" method="post" enctype="multipart/form-data" class="addPictureForm">
                                <div class="inputFileDiv">
                                    <button id="pictureButton">Select an image</button>
                                    <label for="pictureButton">
                                        <?php echo $inputPictureText; ?>
                                    </label>
                                    <input type="file" name="PictureInputFile" class="PictureInputFile" accept="image/*" />
                                </div>

                                <input type="hidden" name="MAX_SIZE_FILE" value="1000000000000000" />
                            </form>
                        </div>
                        <div>
                            <form action="<?php echo $form_action; ?>" method="post" class="item_info">
                                <div>
                                    <label for="title-add">item Name</label>
                                    <br>
                                    <input type="text" name="title" id="title-add" required="required" value="<?php echo $item_title; ?>">
                                    <select required="required" name="category">
                                        <option value="<?php echo $item_category_value; ?>">
                                            <?php echo $item_category; ?>
                                        </option>
                                        <option value="clothes">Clothes</option>
                                        <option value="electronic">Electronic</option>
                                        <option value="decoration">Decoration</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="add-description">Description:</label>
                                    <br>
                                    <textarea id="add-description" name="description" rows="5" cols="50" required="required">
                                        <?php echo $item_description; ?>
                                    </textarea>
                                    <input type="hidden" name="item_picture" value="<?php echo $item_picture_source; ?>" />
                                    <input type="hidden" name="username" value="<?php echo $username; ?>" />
                                </div>
                                <div>
                                    <input type="submit" value="<?php echo $form_button_value;?>" />
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <?php include 'footer.php';?>
            </section>
    </body>

    </html>
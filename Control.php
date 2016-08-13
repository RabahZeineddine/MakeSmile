<?php 
    session_start();

    $user_username="";
    $user_name="";
    $user_lastname="";
    $user_gender="";
    $user_email="";
    $user_number="";
    $user_image_source="";
    $user_address="";
    $user_addNumber=0000;
    $user_complement="";
    $user_CEP = "";
    $user_country="";
    $user_state="";
    $user_city="";

    function readByUsername($u){
        
        global $user_username, $user_name, $user_lastname, $user_gender, $user_email, $user_number ,$user_image_source, $user_address, $user_addNumber, $user_complement,$user_CEP,$user_country, $user_state, $user_city;
        
        //Step : Connection
        include 'connect_mysql.php';
        
        //Step 2: Prepare a bind
        $sql = "SELECT username,name,lastname,gender,email,number,image_source,address,addNumber,complement,CEP,country,state,city FROM users WHERE username=?";
        
        $stmt = $connection->prepare($sql);
        
        $stmt->bind_param("s",$u);
        
        $stmt->execute();
        $stmt->bind_result($db_username,$db_name,$db_lastname,$db_gender,$db_email,$db_number,$db_image_source,$db_address,$db_addNumber,$db_complement,$db_CEP,$db_country,$db_state,$db_city);
        
        //Store Results;
        
        $stmt->store_result();
        
        if($stmt->num_rows>0){
            while($stmt->fetch()){
                $user_username= $db_username;
                $user_name= $db_name;
                $user_lastname= $db_lastname;
                $user_gender= $db_gender;
                $user_email= $db_email;
                $user_number= $db_number;
                $user_image_source= $db_image_source;
                $user_address= $db_address;
                $user_addNumber= $db_addNumber;
                $user_complement= $db_complement;
                $user_CEP = $db_CEP;
                $user_country= $db_country;
                $user_state= $db_state;
                $user_city= $db_city;    
            }
        }
        
        //step 4 : close connection
        $stmt->close();
        $connection->close();
    }


function uploadNewItem ($category,$title,$description,$image_source,$user_id){
   
}




    if(isset($_GET['cmd'])){
        $cmd = $_GET['cmd'];
        
        //it comes from login.php
        if(strcmp($cmd,"verifyLogin")==0){
            $user_username = "";
            $user_password = "";
            $rememberUser = "";
            
            if( isset($_POST['username'])) $user_username = strip_tags($_POST['username']);
            
            if( isset($_POST['password'])) $user_password =
            md5(strip_tags($_POST['password']));
            
            if( isset($_POST['rememberUser'])){
                $rememberUser = $_POST['rememberUser'];
                setcookie("username",$user_username,time() + (60*60*24*7));
            }else{
                setcookie("username",$user_username,time() - 60);
            }
            
            
            
            //---------- Verify in the DB --------
            //Step 1: Connection
            include "connect_mysql.php";
            
            //Step 2: Prepare a bind
            $stmt = $connection->prepare("SELECT username,password,image_source,id_user FROM users WHERE username= ?");
            $stmt->bind_param("s",$user_username);
            
            $stmt->execute();
            $stmt->bind_result($db_username,$db_password,$db_image_source,$db_id_user);
            //Store result
            $stmt->store_result();
            if($stmt->num_rows>0){
                while($stmt->fetch()){
                    if(strcmp($user_password,$db_password)==0){
                        // If Right Password 
                        
                        $_SESSION["username"] = $db_username;
                        $_SESSION['image_source'] = $db_image_source;
                        $_SESSION['user_id'] = $db_id_user;
                        header('Location:home.php');
                        exit;
                    }else{
                        //Wrong Password
                        
                        $_SESSION['wrongPasswordMsg'] = "Wrong password!";
                        $_SESSION['usernameLoginValue'] = $user_username;
                        header('Location:login.php');
                        exit;
                    }
                }
            }else{
                //wrong username or not registered
                $_SESSION['wrongUsernameMsg'] = "Username does not exists! <a href='signUp.php'>Sign up here.</a>";
                header('Location:login.php');
                exit;
            }
            
            
            $stmt->close();
            $connection->close();
        }else if(strcmp($cmd,"uploadNewItem")==0){
                $username="";
                if(isset($_POST['username'])) $username = $_POST['username'];
                
                $title="";
                if(isset($_POST['title'])) $title=$_POST['title'];
                
                $category = "";
                if(isset($_POST['category'])) $category = $_POST['category'];
                
                $description = "";
                if(isset($_POST['description'])) $description = $_POST['description'];
                
                $image_source = "";
                if(isset($_POST['item_picture'])) $image_source = $_POST['item_picture'];
                
                $destiny = "img\\$username\\posts";
                if(!file_exists($destiny)){
                    mkdir($destiny,0777,true);
                }
                $destinyNew = "img\\$username\\posts\\$category";
                if(!file_exists($destinyNew)){
                    mkdir($destinyNew,0777,true);
                }
                rename("img//$username//posts//temp//$image_source","img//$username//posts//$category//$image_source");
                
                $path = "img/$username/posts/temp/*";
                $files = glob($path); // get all file names
                foreach($files as $file){ // iterate files
                    if(is_file($file)) unlink($file); // delete file
                }
                
                $user_id="";
                if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
                
                //---- Connect to DB ------
                include 'connect_mysql.php';

                $sql = "INSERT INTO $category(item_title,item_description,item_picture,date,id_user) VALUES(?,?,?,now(),?)";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("sssi",$title,$description,$image_source,$user_id);
                $stmt->execute();
                if($stmt){
                    header('Location: myDonations.php');

                }else{
                    $_SESSION['alertMessage'] = "Something went wrong! try again!";
                    header('Location: myDonations.php');
                }

                $stmt->close();
                $connection->close();
            }else
            //another command content!
                
                if(strcmp($cmd,"deleteDonatedItem")==0){
                    $id_item= -1;
                    $category = "";
                    $item_pic="";
                    if(isset($_GET['id'])) $id_item= $_GET['id'];
                    if(isset($_GET['category'])) $category = $_GET['category'];
                    if(isset($_GET['item_pic'])) $item_pic = $_GET['item_pic'];
                    
                    include 'connect_mysql.php';
                    
                    $sql = "DELETE FROM $category WHERE id_item=?";
                    $stmt= $connection->prepare($sql);
                    $stmt->bind_param("i",$id_item);
                    $stmt->execute();
                    if($stmt){
                        $path = "img/".$_SESSION['username']."/posts/$category/$item_pic";
                        $files = glob($path); // get all file names
                        foreach($files as $file){ // iterate files
                            if(is_file($file)) unlink($file); // delete file
                        }
                        $_SESSION['alertMessage'] = "Deleted successfully!";
                        header('Location:myDonations.php');
                        exit;
                    }else{
                        $_SESSION['alertMessage'] = "Something went wrong! Try again.";
                        header('Location: myDonations.php');
                        exit;
                    }
                    
                    $stmt->close();
                    $connection->close();
                }else if(strcmp($cmd,"editDonatedItem")==0){
                        $id_item = -1;
                        $category = "";
                        if(isset($_GET['id'])) $id_item = $_GET['id'];
                        if(isset($_GET['category'])) $category = $_GET['category'];
                        
                        //--------- Get info from DB -- - - - - -
                    
                        include 'connect_mysql.php';
                    
                        //Step 2:
                        $sql = "SELECT id_item,item_title,item_description,item_picture FROM $category WHERE id_item=?";
                    
                        $stmt = $connection->prepare($sql);
                        $stmt->bind_param("i",$id_item);
                        $stmt->execute();
                        $stmt->bind_result($db_id_item,$db_item_title,$db_item_description,$db_item_picture);
                        // Store the results
                        $stmt->store_result();
                        
                        if($stmt->num_rows>0){
                            while($stmt->fetch()){
                                $_SESSION['id_item'] = $db_id_item;
                                $_SESSION['item_title'] = $db_item_title;
                                $_SESSION['item_description'] = $db_item_description;
                                $_SESSION['item_picture'] = $db_item_picture;
                                $_SESSION['item_category'] = $category;
                                header('Location:donationItem.php?cmd=editExistedItem');
                            }
                        }
                        
                }else if(strcmp($cmd,"updateOldItem")==0){
                    
                    $username = "";
                    if(isset($_POST['username'])) $username = $_POST['username'];
                    
                    $item_title = "";
                    if(isset($_POST['title'])) $item_title=$_POST['title'];
                    
                    $item_description = "";
                    if(isset($_POST['description'])) $item_description = $_POST['description'];
                    
                    $item_picture = "";
                    if(isset($_POST['item_picture'])) $item_picture = $_POST['item_picture'];
                    
                    $item_category = "";
                    if(isset($_POST['category'])) $item_category = $_POST['category'];
                    
                    $id_item = "";
                    if(isset($_SESSION['id_item'])) $id_item = $_SESSION['id_item'];
                    
                    $item_category_old = "";
                    if(isset($_SESSION['item_category'])) $item_category_old = $_SESSION['item_category'];
                    
                    $item_picture_old = "";
                    if(isset($_SESSION['item_picture'])) $item_picture_old = $_SESSION['item_picture'];
                    
                    $user_id="";
                    if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
                    
                    unset($_SESSION['id_item']);
                    unset($_SESSION['item_title']);
                    unset($_SESSION['item_description']);
                    unset($_SESSION['item_category']);
                    unset($_SESSION['item_picture']);
                    
                    
                    echo "Category: ".$_POST['category'];
                    
                    //------ DATABASE WORK :P -----//
                    
                    //Step 1: make connection
                    include 'connect_mysql.php';
                    
                    //Step 2:
                    if(strcmp($item_category,$item_category_old)!=0){
                        $sql = "INSERT INTO $item_category(item_title,item_description,item_picture,date,id_user) VALUES(?,?,?,now(),?)";
                        $stmt = $connection->prepare($sql);
                        $stmt->bind_param("sssi",$item_title,$item_description,$item_picture,$user_id);
                        $stmt->execute();
                        
                        if($stmt){
                            
                            $sql = "DELETE FROM $item_category_old WHERE id_item=?";
                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param("i",$id_item);
                            $stmt->execute();
                            if($stmt){
                                if(strcmp($item_picture,$item_picture_old)!=0){
                                    $path = "img/".$_SESSION['username']."/posts/$item_category_old/$item_picture_old";
                                    $files = glob($path); // get all file names
                                    foreach($files as $file){ // iterate files
                                        if(is_file($file)) unlink($file); // delete file
                                    }
                                    $destiny = "img\\$username\\posts";
                                    if(!file_exists($destiny)){
                                        mkdir($destiny,0777,true);
                                    }
                                    $destinyNew = "img\\$username\\posts\\$item_category";
                                    if(!file_exists($destinyNew)){
                                        mkdir($destinyNew,0777,true);
                                    }
                                    rename("img//$username//posts//temp//$item_picture","img//$username//posts//$item_category//$item_picture");

                                    $path = "img/$username/posts/temp/*";
                                    $files = glob($path); // get all file names
                                    foreach($files as $file){ // iterate files
                                        if(is_file($file)) unlink($file); // delete file
                                    }
                                }else{
                                    $destiny = "img\\$username\\posts";
                                    if(!file_exists($destiny)){
                                        mkdir($destiny,0777,true);
                                    }
                                    $destinyNew = "img\\$username\\posts\\$item_category";
                                    if(!file_exists($destinyNew)){
                                        mkdir($destinyNew,0777,true);
                                    }
                                    rename("img//$username//posts//$item_category_old//$item_picture_old","img//$username//posts//$item_category//$item_picture");
                                }
                                 $_SESSION['alertMessage'] = "Updated and moved successfully!";
                                header('Location:myDonations.php');
                                exit;
                                
                                
                            }else{
                                 $_SESSION['alertMessage'] = "Something went wrong! Try again.";
                                header('Location: myDonations.php');
                                exit;
                            }
                            
                        }else{
                             $_SESSION['alertMessage'] = "Something went wrong! Try again.";
                            header('Location: myDonations.php');
                            exit;
                        }
                    }else{
                        $sql = "UPDATE $item_category SET item_title=?,item_description=?,item_picture=?,date=now() WHERE id_item=?";
                        $stmt= $connection->prepare($sql);
                        $stmt->bind_param("sssi",$item_title,$item_description,$item_picture,$id_item);
                        $stmt->execute();
                        if($stmt){
                            if(strcmp($item_picture,$item_picture_old)!=0){
                                    // same category but different picture
                                    $path = "img/".$_SESSION['username']."/posts/$item_category/$item_picture_old";
                                    $files = glob($path); // get all file names
                                    foreach($files as $file){ // iterate files
                                        if(is_file($file)) unlink($file); // delete file
                                    }
                                   
                                    rename("img//$username//posts//temp//$item_picture","img//$username//posts//$item_category//$item_picture");

                                    $path = "img/$username/posts/temp/*";
                                    $files = glob($path); // get all file names
                                    foreach($files as $file){ // iterate files
                                        if(is_file($file)) unlink($file); // delete file
                                    }
                                }else{
                                // the same category and the same picture
                            }
                             $_SESSION['alertMessage'] = "Updated successfully!";
                            header('Location:myDonations.php');
                            exit;
                            
                        }else{
                             $_SESSION['alertMessage'] = "Something went wrong! Try again.";
                             header('Location: myDonations.php');
                             exit;
                        }
                    }
                    
                    $stmt->close();
                    $connection->close();
                
                }
            }    
?>
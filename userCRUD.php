<?php 
    $user_username="";
    $user_password="";
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

  /*  function readByUsername($u){
        
        global $user_username,$user_password, $user_name, $user_lastname, $user_gender, $user_email, $user_number ,$user_image_source, $user_address, $user_addNumber, $user_complement,$user_CEP,$user_country, $user_state, $user_city;
        
        //Step : connection
        include 'connect_mysql.php';
        
        //Step 2: prepare an sql
        $sql = "SELECT * FROM users WHERE username='$u'";
        
        //Step 3: treat the result
        
        $result = mysqli_query($connection,$sql);
        
        if($result && mysqli_num_rows($result)>0){
            while( $row = mysqli_fetch_array($result)){
                    $user_username= $row['username'];
                    $user_password= $row['password'];
                    $user_name= $row['name'];
                    $user_lastname= $row['lastname'];
                    $user_gender= $row['gender'];
                    $user_email= $row['email'];
                    $user_number= $row['number'];
                    $user_image_source= $row['image_source'];
                    $user_address= $row['address'];
                    $user_addNumber= $row['addNumber'];
                    $user_complement= $row['complement'];
                    $user_CEP = $row['CEP'];
                    $user_country= $row['country'];
                    $user_state= $row['state'];
                    $user_city= $row['city'];

            }
        }else{
            echo "<p>User doesnt exist!</p>";
            exit;
        }
        
        //step 4 : close connection
        mysqli_close($connection);
    }

*/
    function changeProfilePic($image){
        global $user_username;
        
        //step1
        include 'connect_mysql.php';
        
        //step2 s1l
        $sql = "UPDATE users SET image_source='$image' WHERE username='$user_username'";
        
        //step 3 treat the result
        $result = mysqli_query($connection,$sql);
        if($result===TRUE){
            header('Location: myProfile.php');
        }else{
            echo "<p>Something wrong with profile picture update!</p>";
        }
        
        //step 4 : close
        mysqli_close($connection);
    }

function changeUserInfo($name,$lastname,$gender,$number){
  global $user_username;
    
    include 'connect_mysql.php';
    $sql = "UPDATE users SET name='$name',lastname='$lastname',gender='$gender',number='$number' WHERE username='$user_username'";
    $result = mysqli_query($connection,$sql);
    if($result === TRUE){
        header('Location: myProfile.php');
        exit;
    }else{
        echo "<p>Something wrong with change info!</p>";
    }
    
    mysqli_close($connection);
}

function changeUserAddress($address,$addNumber,$complement,$CEP,$country,$state,$city){
    global $user_username;
    
    include 'connect_mysql.php';
    $sql = "UPDATE users SET address='$address',addNumber='$addNumber',complement='$complement',CEP='$CEP',country='$country',state='$state',city='$city' WHERE username='$user_username'";
    $result = mysqli_query($connection,$sql); 
    if($result===TRUE){
        header('Location:myProfile.php');
        exit;
    }else{
        echo "<p>Something wrong with change address!</p>";
    }
    mysqli_close($connection);
}

function verifyCurrentPassword($password){
    global $user_password;
    if(strcmp($password,$user_password)==0){
        return true;
    }else{
        return false;
    }
}

function  changeUserPassword($newPassword){
    global $user_username;
    
    include 'connect_mysql.php';
    $sql = "UPDATE users SET password='$newPassword' WHERE username = '$user_username'";
    
    $result = mysqli_query($connection,$sql);
    
    if($result === TRUE){
        $_SESSION['passwordAlert'] = "Password changed successfully";
        header('Location: myProfile.php');
        exit;
    }else{
        $_SESSION['passwordAlert'] = "Something went wrong! Try changing your password again.";
        header('Location: myProfile.php');
    }
}

function deleteUserProfile($username){
    global $user_username;
    
    include 'connect_mysql.php';
    $sql = "DELETE  FROM users WHERE username ='$user_username'";
    $result = mysqli_query($connection,$sql);
    if($result ===TRUE){
        header('Location: logout.php');
        exit;
    }
    mysqli_close($connection);
}

function uploadNewItem ($category,$title,$description,$image_source,$user_id){
    global $user_username;
    
    include 'connect_mysql.php';
    
    $sql = "INSERT INTO posts(item_title,item_description,item_picture,item_category,date,id_user,username) VALUES('$title','$description','$image_source','$category',now(),$user_id,'$user_username')";
    
    $result = mysqli_query($connection,$sql);
    if($result){
        header('Location: myDonations.php');
    }else{
        $_SESSION['donationAlert'] = "Something went wrong! try again!";
   
         header('Location: myDonations.php');
    }
    
    mysqli_close($connection);
}



function updateOldItem ($category,$title,$description,$image_source,$user_id,$id_post){
    global $user_username;
    
    include 'connect_mysql.php';
    
    $sql = "UPDATE posts SET item_title='$title',item_description='$description',item_picture='$image_source',item_category='$category',date=now(),id_user=$user_id,username='$user_username' WHERE id_post =$id_post";
    
    $result = mysqli_query($connection,$sql);
    if($result){
        header('Location: myDonations.php');
    }else{
        $_SESSION['donationAlert'] = "Something went wrong! try again!";
   
         header('Location: myDonations.php');
    }
    
    mysqli_close($connection);
}


function deleteDonatedItem($id_post){
    
    include 'connect_mysql.php';
    
    $sql = "DELETE FROM posts WHERE id_post=$id_post";
    
    $result = mysqli_query($connection,$sql);
    
    if($result === TRUE){
        header('Location:myDonations.php');
        exit;
    }else{
        //error write a message later!
        header('Location: myDonations.php');
    }
    
    mysqli_close($connection);
}
?>
<?php 
     $username="";
        if( isset($_POST['username']) ){
            $username = $_POST['username'];
        }
        
        $password = "";
        if( isset($_POST['password'])){
            $password = $_POST['password'];
        }

          $name="";
        if(isset($_POST['name'])){
            $name=$_POST['name'];
        }
        $lastname="";
        if(isset($_POST['lastname'])){
            $lastname=$_POST['lastname'];
        }
        $gender = "";
        if(isset($_POST['gender'])){
            $gender = $_POST['gender'];
        }
        $email = "";
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        $number = "";
        if(isset($_POST['number'])){
            $number = $_POST['number'];
        }
    
        $image_source = "";
        if(isset($_POST['PROFILE_PIC'])){
            $image_source = $_POST['PROFILE_PIC'];
        }
        $address = "";
        if( isset($_POST['address'])){
            $address = $_POST['address'];
        }
        $addNumber = 0;
        if( isset($_POST['addNumber'])){
            $addNumber = $_POST['addNumber'];
        }
        $complement = "";
        if( isset($_POST['complement'])){
            $complement = $_POST['complement'];
        }
        $CEP1 = "";
        if( isset($_POST['CEP1'])){
            $CEP1 = $_POST['CEP1'];
        }
        $CEP2 = "";
        if( isset($_POST['CEP2'])){
            $CEP2 = $_POST['CEP2'];
        }
        $country= "";
        if( isset($_POST['country'])){
            $country = $_POST['country'];
        }
        $state= "";
        if( isset($_POST['state'])){
            $state = $_POST['state'];
        }
        $city = "";
        if( isset($_POST['city'])){
            $city = $_POST['city'];
        }

        echo $image_source;

    $CEP = $CEP1."-".$CEP2;

// --------------------Data base ----------------
    
    // step 1 :  connection

    include "connect_mysql.php";
    
    // step 2 : prepare an sql/
    
    $sql = "INSERT INTO users(username,password,name,lastname,gender,email,number,image_source,address,addNumber,complement,CEP,country,state,city) VALUES('$username','$password','$name','$lastname','$gender','$email','$number','$image_source','$address',$addNumber,'$complement','$CEP','$country','$state','$city')";

    // step 3 : treat the results
    $result = mysqli_query($connection,$sql);
    
    if($result){
        header('Location:home.php');
    }else{
        echo "<p>Database Problem, try again</p>";
        header('Location: signUp-2.php');
    }

    // step 4 : close the connection
    mysqli_close($connection);


?>
<?php 
    session_start();
    
    $username="";
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    $address = "";
    if(isset($_POST['address'])){
        $address = $_POST['address'];
    }
    $addNumber = "";
    if(isset($_POST['addNumber'])){
        $addNumber = $_POST['addNumber'];
    }
    $complement = "";
    if(isset($_POST['complement'])){
        $complement = $_POST['complement'];
    }
    $CEP1 = "";
    if(isset($_POST['CEP1'])){
        $CEP1 = $_POST['CEP1'];
    }
    $CEP2 = "";
    if(isset($_POST['CEP2'])){
        $CEP2 = $_POST['CEP2'];
    }
    
    $CEP = $CEP1."-".$CEP2;
    
    $country = "";
    if(isset($_POST['country'])){
        $country = $_POST['country'];
    }
    $state = "";
    if(isset($_POST['state'])){
        $state = $_POST['state'];
    }
    $city = "";
    if(isset($_POST['city'])){
       $city = $_POST['city'];
    }
       
    include 'userCRUD.php';
    readByUsername($username);
    changeUserAddress($address,$addNumber,$complement,$CEP,$country,$state,$city);
    
?>
<?php 
    session_start();
    $username = "";
    if( isset($_SESSION['username'])){
        
        $username = $_SESSION['username'];
    }
    $name = "";
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }
    $lastname = "";
    if(isset($_POST['lastname'])){
        $lastname = $_POST['lastname'];
    }
    $gender="";
    if(isset($_POST['gender'])){
        $gender = $_POST['gender'];
    }
    $number = "";
    if(isset($_POST['number'])){
        $number = $_POST['number'];
    }

    include 'userCRUD.php';
    readByUsername($username);
    changeUserInfo($name,$lastname,$gender,$number);

?>
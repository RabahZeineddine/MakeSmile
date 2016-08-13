<?php 
    session_start();

    $username = "";
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    include 'userCRUD.php';
    readByUsername($username);
    deleteUserProfile($username);
?>
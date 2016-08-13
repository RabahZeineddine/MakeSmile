<?php 
    session_start();
    $username = "";
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    $currentPassword = "";
    if(isset($_POST['currentPassword'])){
        $currentPassword = $_POST['currentPassword'];
    }
    $newPassword = "";
    if(isset($_POST['newPassword'])){
        $newPassword = $_POST['newPassword'];
    }
    $confirmPassword = "";
    if(isset($_POST['confirmPassword'])){
        $confirmPassword = $_POST['confirmPassword'];
    }

    include 'userCRUD.php';
    readByUsername($username);
    if(verifyCurrentPassword($currentPassword)){
       if(strcmp($newPassword,$confirmPassword)==0){
           changeUserPassword($newPassword);
       }else{
           $_SESSION['passwordAlert'] = "Passwords do not match!";
           echo "new: $newPassword <br>confirm: $confirmPassword";
        header('Location:myProfile.php?command=password');
        exit;
       }
    }else{
         $_SESSION['passwordAlert'] = "Wrong Password! Confirm your current password.";
        header('Location:myProfile.php?command=password');
        exit;
    }
?>
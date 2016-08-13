<?php 

$image_source = "img\\".$_SESSION['username']."\\profilePic\\".$_SESSION['image_source'];
//$class_Header = "headerAdmin"; 
$class_Section = "mainSectionLoggedIn";

echo"
<aside class='sideBar'>
    <img src='$image_source' class='avatar' alt='avatar' />
    <p class='profileName'><strong>".$_SESSION['username']."</strong></p>
    <nav>
        <ul>
            <a href='myProfile.php'><li class='$current_Sidebar[0]'><i class='material-icons md-36'>account_box</i><span>My Profile</span></li></a>
            <a href='mydonations.php'><li class='$current_Sidebar[1]'><i class='material-icons md-36'>card_giftcard</i><span>My Donations</span></li></a>
        </ul>
    </nav>
</aside>
";

?>
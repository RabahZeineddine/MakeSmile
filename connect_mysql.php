<?php 
    require_once("db_config.php");
    
    $connection = new mysqli(HOST,USER,PASSWORD,DATABASE);
    
    // error treatment
    if($connection->connect_error) {
        die("CONNECTION ERROR WITH DATABASE: ".$connection->connect_error);
    }

?>
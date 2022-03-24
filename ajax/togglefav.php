<?php
session_start();
require_once(__DIR__.'/../includes/autoloader.php');
require_once(__DIR__.'/../includes/database.php');

if($_SESSION['user_data']){
    $centre_id = (int) $_POST['centre_id'];
    if($centre_id) {
        $Favourite = new Favourite($Conn);
        $toggle = $Favourite->toggleFavourite($_POST['centre_id']);
        if($toggle) {
            echo json_encode(array(
                "success" => true,
                "reason" => "Recipe was added to users favourites."
            ));
        }else{
            echo json_encode(array(
                "success" => true,
                "reason" => "Recipe was removed from users favourites."
            ));
        }
    }else{
        echo json_encode(array(
            "success" => false,
            "reason" => "Recipe ID not provided."
        ));
    }
}else{
    echo json_encode(array(
        "success" => false,
        "reason" => "User not logged in."
    ));
}
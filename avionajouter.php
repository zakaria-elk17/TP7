<?php
require_once "config.php";
session_start();

if (isset ($_POST["ajouterAvion"])) {
    if (!empty($_POST["idAvion"]) &&!empty($_POST["categorieAvion"]) 
    &&!empty($_POST["nombrePlace"]) &&!empty($_FILES["photo"])){

        $idAvion = $_POST["idAvion"];
        $categorieAvion = $_POST["categorieAvion"];
        $nombrePlace = $_POST["nombrePlace"];
        $photo = $_FILES['photo'];
        $photo_location = $_FILES['photo']['tmp_name'];
        $photo_name     = $_FILES['photo']['name'];
        $photo_up       = "photo/".$photo_name;

        print_r($photo);
        if (move_uploaded_file($photo_location, $photo_up)){
            $a = $pdo -> prepare("INSERT INTO avion VALUES(?, ?, ?, ?)");
            $a -> execute([$idAvion, $categorieAvion, $nombrePlace, $photo_up]);
        }
        $_SESSION["message"] = "valid";
        header("location:index.php");
        exit();
        
    } else {
        $_SESSION["message"] = "invalid";
        header("location:index.php");
        exit();
    }
}
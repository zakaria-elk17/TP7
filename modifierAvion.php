<?php
if (isset($_POST["modifierAvion"])) {
    require_once "config.php";
    session_start();

    if (!empty($_POST["idAvion"]) && !empty($_POST["categorieAvion"]) &&
     !empty($_POST["nombrePlace"]) && !empty($_FILES["photo"])){
        echo "fuck";
        $idAvion = $_POST["idAvion"];
        $categorieAvion = $_POST["categorieAvion"];
        $nombrePlace = $_POST["nombrePlace"];
        $photo = $_FILES["photo"];
        $photo_location = $_FILES['photo']['tmp_name'];
        $photo_name     = $_FILES['photo']['name'];
        $photo_up       = "photo/".$photo_name;


        if (move_uploaded_file($photo_location, $photo_up)){
            
            $a = $pdo -> prepare("UPDATE avion SET categorieAvion = ?, nombrePlace = ? , photo = ?  WHERE IdAvion = ?");
            $a -> execute([$categorieAvion, $nombrePlace, $photo_up, $idAvion]);
        }
        $_SESSION["message"] = "modified";
        header("location:index.php");
        exit();
    
    
    
    } else {
        $_SESSION["message"] = "invalid";
        header("location:modifier.php");
        exit();
    }

    




} else {
    header("location:modifier.php");
    exit();
}
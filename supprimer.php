<?php
if (isset($_POST["supprimer"])) {
    require_once "config.php";

    $IdAvion = $_POST["IdAvion"];
    
    $a = $pdo -> prepare("DELETE FROM AVION WHERE IdAvion = ? ");
    $a -> execute([$IdAvion]);

    header("location:index.php");
    exit();



} else {
    header("location:index.php");
    exit();
}
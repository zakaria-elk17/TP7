<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=aeroport", "root", "988109eeairakaZ");
}
catch (PDOException $e) {
    die ("ERROR =>". $e -> getMessage());
}
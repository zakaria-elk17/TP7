<?php
if (isset($_POST["modifier"])) {
require_once "config.php";
session_start();

    $IdAvion = $_POST["IdAvion"];

    $a = $pdo -> prepare("SELECT * FROM AVION WHERE IdAvion = ?");
    $a -> execute([$IdAvion]);
    $data = $a -> fetchAll(PDO::FETCH_OBJ);
    $data = $data[0];

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Avion</title>
    </head>
    <body>
        <header>
            <div class="container">
                <h1>Gestion des Vols</h1>
                <ul>
                    <li>Acceil</li>
                    <li>Acceil</li>
                    <li>Acceil</li>
                </ul>
            </div>
        </header>
        <div class="main">
            <div class="form_1">
                <h2>Ajouter un nouvel Avion</h2>
                <form action="modifierAvion.php" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($_SESSION["message"]) && $_SESSION["message"] === "invalid"){
                    ?>
                    <div class="message">
                        <span>Field Required !</span>
                    </div>
                    <?php } ?>
                    <div>
                        <label for="IdAvion">Avion id :</label>
                        <input type="number" name="idAvion" id="idAvion" value="<?= $data -> IdAvion ?>">
                    </div>
                    <div>
                        <label for="categorieAvion">Avion Categorie :</label>
                        <select name="categorieAvion" id="categorieAvion" value="<?= $data -> categorieAvion ?>">
                            <option value="Option 1">Option 1</option>
                            <option value="Option 2">Option 2</option>
                            <option value="Option 3">Option 3</option>
                        </select>
                    </div>
                    <div>
                        <label for="nombrePlace">Nombre des Places :</label>
                        <input type="number" name="nombrePlace" id="nombrePlace" value="<?= $data -> nombrePlace ?>">
                    </div>
                    <div>
                        <label for="photo">Avion Photo :</label>
                        <input type="file" name="photo" id="photo" value="<?= $data -> photo ?>">
                    </div>
                    <input type="submit" value="Modifier" name="modifierAvion">
                </form>
            </div>
        </div>
    </body>
</html>
<?php
} else {
    header("location:index.php");
    exit();
}
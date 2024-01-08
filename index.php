<?php
require_once "config.php";
session_start();

$a = $pdo -> query("SELECT * FROM AVION");
$data = $a -> fetchAll(PDO::FETCH_OBJ);

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
                <li>Acceuil</li>
                <li>Acceuil</li>
                <li>Acceuil</li>
            </ul>
        </div>
    </header>
    <div class="main">
        <div class="form_1">
            <h2>Ajouter un nouvel Avion</h2>
            <form action="avionajouter.php" method="post" enctype="multipart/form-data">
            <?php
                    if (isset($_SESSION["message"]) && $_SESSION["message"] === "invalid"){
                        echo "<div class='message red'><span>Field Required !</span></div>";
                        $_SESSION["message"] = "";
                        header("Refresh:2;url=index.php");
                    } else if (isset($_SESSION["message"]) && $_SESSION["message"] === "valid") {
                        echo "<div class='message green' style='color: green; background-color: rgb(0,255,0,0.2);' ><span>Avion ajouter avec succes !</span></div>";
                        $_SESSION["message"] = "";
                        header("Refresh:2;url=index.php");

                    } else if (isset($_SESSION["message"]) && $_SESSION["message"] === "modified") {
                        echo "<div class='message green' style='color: blue; background-color: rgb(0,0,255,0.2);' ><span>Avion Modifier avec succes !</span></div>";
                        $_SESSION["message"] = "";
                        header("Refresh:2;url=index.php");
                    }
            ?>
                <div>
                    <label for="idAvion">Avion id :</label>
                    <input type="number" name="idAvion" id="idAvion">
                </div>
                <div>
                    <label for="categorieAvion">Avion Categorie :</label>
                    <select name="categorieAvion" id="categorieAvion">
                        <option value="Option 1">Option 1</option>
                        <option value="Option 2">Option 2</option>
                        <option value="Option 3">Option 3</option>
                    </select>
                </div>
                <div>
                    <label for="nombrePlace">Nombre des Places :</label>
                    <input type="number" name="nombrePlace" id="nombrePlace">
                </div>
                <div>
                    <label for="photo">Avion Photo :</label>
                    <input type="file" name="photo" id="photo">
                </div>
                <input type="submit" value="Ajouter" name="ajouterAvion">
            </form>
        </div>
        <!-- ---------------------------------------------------------------------- -->
        <div class="form_1">
            <h2>Choisir un Avion</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="message">
                    <span>Field Required !</span>
                </div>
                <div>
                    <label for="nombreminimum">Nombre de Places minimum :</label>
                    <input type="number" name="nombreminimum" id="nombreminimum" value="<?= @$_POST["nombreminimum"] ?>">
                </div>
                <input type="submit" value="Choisir" name="choisir">
            </form>
        </div>
    </div>
    <div class="table">
        <table>
            <tr>
                <th></th>
                <th>Numéro Avion</th>
                <th>Nombre de Places</th>
                <th>Modification</th>
            </tr>
<?php 

if (isset($_POST["choisir"]) && !empty($_POST["nombreminimum"])) :
    foreach ($data as $i) :
        if ((int)($i -> nombrePlace) >= $_POST["nombreminimum"]) :
    
?>
            <tr>
                <td><img src="<?= $i -> photo ?>" alt=""></td>
                <td><?= $i -> IdAvion ?></td>
                <td><?= $i -> nombrePlace ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="IdAvion" value="<?= $i -> IdAvion ?>">
                        <input type="submit" name="modifier" value="Modifier" formaction="modifier.php">
                        <input type="submit" name="supprimer" value="Supprimer" formaction="supprimer.php">
                    </form>
                </td>
            </tr>
<?php
        endif;
    endforeach; 

else :
    foreach ($data as $i) :
?>
            <tr>
                <td><img src="<?= $i -> photo ?>" alt=""></td>
                <td><?= $i -> IdAvion ?></td>
                <td><?= $i -> nombrePlace ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="IdAvion" value="<?= $i -> IdAvion ?>">
                        <input type="submit" name="modifier" value="Modifier" formaction="modifier.php">
                        <input type="submit" name="supprimer" value="Supprimer" formaction="supprimer.php">
                    </form>
                </td>
            </tr>
<?php
    endforeach; 
endif;
?>
        </table>
    </div>
</body>
</html>
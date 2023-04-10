<!DOCTYPE html>
<?php
include "controls/Munkamenet.php";
Munkamenet::startSession();
?>
<html lang="hu">
<head>
    <title>Támogatók</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/galeria.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="media/icon.png" type="image/x-icon">
    <link rel="icon" href="media/icon.png" type="image/x-icon">
</head>
<body>
<?php
include_once('header.php');
require('controls/Muveletek.php');
if (isset($_POST["torles"])) {
    Muveletek::torol($_POST["torles"]);

}
?>
<main class="content">
    <div>
        <?php
        Munkamenet::mogyorosSuti();
        //var_dump($_SESSION["user"]['Név']);
        if (isset($_SESSION["user"]) && isset($_COOKIE[$_SESSION["user"]['Név']])) {
            echo("<p>" . $_COOKIE[$_SESSION["user"]['Név']] . " db sütid van.</p>");
            echo("<p>Reméljük ízlik a süti, amit a mókusoktól kaptál. Ha többet szeretnél, látogasd a galériánkat vagy nézegesd a támogatókat, ha többet szeretnél.</p>");
        } else {
            echo("Jajj még nincs sütid? Adunk egyet!");
        }
        ?>


    </div>
    <section class="gallery">


        <!-- A támogató neve és képe. Kattintva az adatlap jelenik meg a kép létrehozójának adataival-->
        <?php
        require_once 'controls/Muveletek.php';
        if (isset($_SESSION["user"])) {
            $felhasznalok = Muveletek::felhasznaloFajlbol();
            foreach ($felhasznalok as $felhasznalo) {
                echo '<a href="fiok.php?param=' . $felhasznalo->getNev() . '">';
                echo '<div class="image">';
                echo '<img src="' . $felhasznalo->getKep() . '" alt="' . $felhasznalo->getNev() . '" height="200px" width="200px">';
                echo '<div class="caption">' . $felhasznalo->getNev() . '</div>';
                echo '</div>';
                echo '</a>';
            }
        }
        ?>


        <!--Itt is szól a validátor a h1-6 tegek miatt, de azt írja, hogy divekkel is jó, mégis hibát dob-->
        <div class="image">
            <a href="media/elohely.jpg">
                <img src="media/elohely.jpg" alt="Kép 1">
            </a>
        </div>
        <div class="image">
            <a href="media/europai.jpg">
                <img src="media/europai.jpg" alt="Kép 2">
            </a>
        </div>
        <div class="image">
            <a href="media/evomokus.jpg">
                <img src="media/evomokus.jpg" alt="Kép 3">
            </a>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.querySelector('.navbar');
            navbar.classList.add('show');
        });
    </script>
</main>
<?php
include_once('footer.php')
?>
</body>
</html>

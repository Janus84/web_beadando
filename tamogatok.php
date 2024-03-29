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
        //var_dump($_SESSION["user"]['Név']);
        if (isset($_SESSION["user"]) && isset($_COOKIE[$_SESSION["user"]['Név']])) {
            Munkamenet::mogyorosSuti();
            echo("<p>" . $_COOKIE[$_SESSION["user"]['Név']] . " db sütid van.</p>");
            echo("<p>Reméljük ízlik a süti, amit a mókusoktól kaptál. Ha többet szeretnél, nézegesd a képeinket és támogatóinkat.</p>");
        } else {
            echo("Jajj még nincs sütid? Adunk egyet, csak jelentkezz be és nézelődj!");
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
                echo '<div class="image">';
                echo '<a href="'.$felhasznalo->getKep().'">';
                echo '<img src="' . $felhasznalo->getKep() . '" alt="' . $felhasznalo->getNev() . '"></a>';
//                echo '<div class="caption">' . $felhasznalo->getNev() . '</div>';
                echo '<div class="caption"><a href="fiok.php?param='.  $felhasznalo->getNev() . '">' . $felhasznalo->getNev() .'</a></div>';
                echo '</div>';
            }
//            echo '</div>';
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

</main>
<?php
include_once('footer.php')
?>
</body>
</html>
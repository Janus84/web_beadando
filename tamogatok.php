<!DOCTYPE html>
<?php
include "controls/Cookies.php";
Cookies::startSession();
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
include_once ('header.php')
?>
<main class="content">
    <div>
        <!-- Hogyha van süti elfogadás-->
        <p>Reméljük ízlik a süti, amit kaptál a mókusoktól</p>
        <p>Örülünk, hogy újra itt vagy. Látjuk, hogy fogytán a sütid, ezért kapsz tőlünk egy kis utánpótlást</p>
        <p>Rég jártál itt ezért elfogyott a sütid.  De ne aggódj, kapsz egy új adagot.</p>
    </div>
    <section class="gallery">


        <!-- A támogató neve és képe. Kattintva az adatlap jelenik meg a kép létrehozójának adataival-->

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
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.add('show');
        });
    </script>
</main>
<?php
include_once ('footer.php')
?>
</body>
</html>

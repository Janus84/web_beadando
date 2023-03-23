<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Mókus galéria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/galeria.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="media/icon.png" type="image/x-icon">
    <link rel="icon" href="media/icon.png" type="image/x-icon">
</head>
<body>
<header class="fixed_header">
    <img src="media/navmokus.jpg" alt="Mókus logó" id="logo">
    <div id="title">Mókus oldal</div>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Főoldal</a></li>
            <li><a href="mokusokrol.html">Mókusokról</a></li>
            <li><a href="eletmod.html">Életmód</a></li>
            <li class="selected"><a href="tamogatok.html">Galéria</a></li>
            <li><a href="urlap.php">Támogató leszek</a></li>
            <li><a href="kapcsolat.html">Kapcsolat</a></li>
        </ul>
    </nav>
</header>
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
<footer>
    © 2023 Mókus oldal
</footer>
</body>
</html>

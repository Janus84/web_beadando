<!DOCTYPE html>
<?php
include "controls/Cookies.php";
Cookies::startSession();
?>
<html lang="hu">
<head>
    <title>Életmód</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="media/icon.png" type="image/x-icon">
    <link rel="icon" href="media/icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
</head>
<body>
<?php
include_once ('header.php')
?>
<main class="content">
    <h1>Európai mókusok életmódja</h1>
    <p class="shadowed">Az európai mókusok aktív állatok, és a nap nagy részében a fák között mászkálnak. Az éjszakákat általában fészkeikben töltik, amelyeket a fák üregeiben vagy ágai között építenek fel.</p>
    <figure>
        <img src="media/feketemokus.jpg" alt="Fában levő mókus kép" width="400">
        <figcaption>Színük változó</figcaption>
    </figure>
    <h2 class="h2small">Milyen az európai mókus táplálkozása?</h2>
    <p>A mókusok általában magvakat és gyümölcsöket esznek, de előfordul, hogy a rovarokat, madarakat és tojásaikat is elfogyasztják.</p>
    <h2 class="h2small">Hogyan védekeznek az európai mókusok a ragadozók ellen?</h2>
    <p>Az európai mókusok nagyon jó ugrók és mászók, így ha észreveszik a ragadozót, általában gyorsan és ügyesen menekülnek a fák között. Emellett képesek úgy viselkedni, mintha betegek lennének, hogy eltérítsék a figyelmet a fészkeiktől.</p>
    <h1 id="elohely">A mókusok élőhelye</h1>
    <p>A mókusok az erdős területeken élnek, ahol bőven találnak fákat, melyekre mászhatnak és diókat, mogyorót, gyümölcsöt, rügyeket, gombákat és rovarokat találnak.</p>
    <h2 class="h2small">Milyen erdős területeket kedvelnek a mókusok?</h2>
    <p>A mókusok általában az olyan erdőket kedvelik, amelyekben megtalálhatóak a következők:<br>
        -kéreg- és tölgyfák<br>
        -mogyorófák<br>
        -fekete fenyők<br>
        -lombhullató fák<br></p>
    <figure>
    <img id="famokus" src="media/elohely.jpg" alt="Fában levő mókus kép" width="400">
    <figcaption>Ebben élek</figcaption>
    </figure>
    <h2 class="h2small">Hogyan építik fészkeiket?</h2>
    <p>A mókusok általában fákban építik fészkeiket. Az épületek egy kis üregből állnak, amelyet a mókusok maguk készítenek a fák kérgében, és mohával, levelekkel és fűvel díszítik.</p>
    <h3 id="mokusgondolat"> "De hideg van, <br> inkább visszamegyek"</h3>

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

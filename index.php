<!DOCTYPE html>
<?php
include "controls/Munkamenet.php";
Munkamenet::startSession();
?>
<html lang="hu">
<head>
    <title>Mókus oldal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="author" content="Kovács Imre, Molnár János"/>
    <meta name="description" content="Oldal a mókusok népszerűsítésére"/>
    <meta name="keywords" content="mókus, igazságtalanság, cuki"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="media/icon.png" type="image/x-icon">
    <link rel="icon" href="media/icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
</head>
<body>
<?php
include_once('header.php')


?>

<main class="content">
    <?php


    if (isset($_GET['hiba'])) {
        echo("<div class='error'>
        <p>Súlyos hiba: " . $_GET['hiba'] . ".</p>
    </div>");
    };


    ?>

    <article>
        <?php
        //$_SESSION!=null $$
        if (isset($_COOKIE["nev"])) {
            echo("<h1>Kedves " . $_COOKIE["nev"] . "</h1>");
        } else {
            echo("<h1>Kedves Leendő Támogatónk!</h1>");
        }
        ?>


        <p class="title_text">Üdvözlünk a mókus oldalon! Ez a lap a mókusok <strong>méltánytalan
                elhanyagoltságának</strong>
            és <strong>hátrányos megkülönböztetésük</strong> megszűntetéséért jött létre.
        <section>
            <h2>Néhány ok</h2>

            <h3>Mókusok táplálkozása</h3>
            <div>
                <img src="media/twril.gif" alt="szegény mókuska" class="gif">
                <p>Szegény éhező mókusok próbálnak túlélni a <b>téli hideg</b> időben, ezért a madáretetőkben található
                    <em><a href="mokusokrol.php#elelmezes">magvak korai begyűjtésére</a></em> fokozottan szükségük van.
                    A gonosz madarak nemhogy eleszik a szegény mókusok elől a táplálékot,
                    hanem még szörnyű csapdákat is állítanak. <i>Ez a madarakra igen jellemző</i></p>
            </div>


            <h3>Gyermekversek</h3>
            <p>Már kiskorunktól a múkusok ellen hangolás elkezdődik gyermekversek formájában.</p>
            <blockquote>
                "Mókuska mókuska Felmászott a fára<br/>
                Leesett leesett kitörött a lába<br/>
                Doktor bácsi
                <mark>ne gyógyítsa meg</mark>
                <br/>
                Huncut a mókus úgy is fára megy"<br/>
                <cite><a href="https://www.gyerekdal.hu/dal/mokuska-mokuska" target="_blank">Az idézet
                        forrása</a></cite>
            </blockquote>
            <p>A mókusok <em><a href="eletmod.php#elohely">élőhelye</a></em> igen is indokolja a fára mászás
                szükségességét</p>

            <audio controls>
                <source src="media/mokuska.mp3" type="audio/mpeg"/>
                Sajnos nem hallgatgatod meg ezt a szörnyű dalt.
            </audio>

        </section>
        <section>
            <h2>Következmények</h2>
            <p>A mókuskák jellemzően és igen méltánytalanul kiszorulnak a cukiságok köréből, ami az alábbiakban
                mutatkozik meg:</p>
            <ul>
                <li>Szinte beszerezhetetlen plüssök és hűtőmágnesek</li>
                <li>Nem forgalmazott mókusos pólók az általunk kedvelt fajtából</li>
                <li>Megfelelően létesített és mókustáplálkozást könnyített etetők létesítése változatos étrenddel</li>
                <li>Kutyák és Cicák mérhetetlen túlsúlya mellett még a nem létező mesebeli állatok is sűrűbben
                    megtalálhatóak
                </li>
            </ul>

            <a id="print_hidden" class="support" href="regisztracio.php">Segíts a mókusokon és kattints!</a>
        </section>
    </article>
</main>
<?php
include_once('footer.php')
?>
</body>
</html>

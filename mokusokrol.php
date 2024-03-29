<!DOCTYPE html>
<?php
include "controls/Munkamenet.php";
Munkamenet::startSession();
?>
<html lang="hu">
<head>
    <title>Mókusokról</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
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
    <h1>A mókusokról általánosságban</h1>
    <p>A mókusok a rágcsálók családjába tartoznak. A világon több mint 200 mókusfajta él, amelyek szerte a világon
        elterjedtek. A mókusokat már az ókori görögök is ismerték, és a középkorban Európában vadászták őket húsa és
        bundája miatt.</p>
    <p>Az 1800-as években Európából és Ázsiából importáltak mókusokat az Egyesült Államokba, hogy kertészek segítségével
        az egér- és patkány populációkat visszaszorítsák. Azóta a mókusok az USA-ban is nagyon elterjedtek.</p>

    <iframe id="print_hidden" class="center" width="560" height="315" src="https://www.youtube.com/embed/mYs0hCv3x4Y"
            allowfullscreen></iframe>


    <h2>Mókusfajták</h2>
    <p>A világon több mint 200 mókusfajta él. A legismertebb fajok közé tartozik a szürke mókus, az amerikai vörös
        mókus,az európai mókus, a japán maki és a törpe mókus. A mókusok általában 20-30 cm hosszúak, de vannak kisebb
        és nagyobb fajtáik is.</p>
    <figure>
        <img id="europeansquirrel" src="media/europai.jpg" alt="Európai mókus kép" width="400">
        <figcaption>A szívünkhöz legközelebb álló európai mókus</figcaption>
    </figure>
    <p>A mókusok szőrzete általában sűrű és puha, színe pedig változó lehet. A törpe mókusok például sárga, narancssárga
        vagy piros szőrzettel rendelkeznek, míg az amerikai vörös mókusok vörös-barnás árnyalatúak. A japán makik
        szőrzete pedig sötétbarna és fehér csíkozottsággal rendelkezik.</p>
    <p>A mókusok kiválóan alkalmazkodnak a környezetükhöz, és a fajtájuktól függően különböző élőhelyeken élnek. A törpe
        mókusok például általában az erdőkben élnek, míg az amerikai vörös mókusok parkokban és városi kertekben is
        megtalálhatóak.</p>
    <h2 id="elelmezes">Élelmezés</h2>
    <p>A mókusok étrendje változó, de általában magvakból, diófélékből, gyümölcsökből és rovarokból áll. A mókusok
        rendkívül ügyesek a magvak begyűjtésében és tárolásában, és képesek akár több ezer magot is elrejteni a
        télre.</p>
    <figure>
        <img src="media/evomokus.jpg" alt="Étkező mókus kép" width="400">
        <figcaption>Egy diót evő mókus</figcaption>
    </figure>
    <p>A mókusok hosszú téli álmot nem alszanak, de a hideg időjárás miatt az aktivitásuk csökkenhet. Az élelemhiány
        miatt a téli hónapokban a mókusok általában a korábban elrejtett magvakat fogyasztják.</p>
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

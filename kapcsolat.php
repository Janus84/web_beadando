<!DOCTYPE html>
<?php
include "controls/Munkamenet.php";
Munkamenet::startSession();
?>
<html lang="hu">
<head>
    <title>Kapcsolat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="media/icon.png" type="image/x-icon">
    <link rel="icon" href="media/icon.png" type="image/x-icon">
</head>
<body>
<!-- Kapcsolat helyet rólunk -->
<?php
include_once ('header.php')
?>
<main class="content">
    <h2 class="center">Az alkotókról</h2>
        <table class="skew">
            <caption>(azaz rólunk)</caption>
            <thead>
            <tr>
                <th id="oszlop1">Név:</th>
                <th id="oszlop2">Kovács Imre</th>
                <th id="oszlop3">Molnár János</th>
            </tr>
            </thead>

            <tr>
                <td headers="oszlop1">Mókusszakértési Szint:</td>
                <td headers="oszlop2">100</td>
                <td headers="oszlop3">150</td>
            </tr>
            <tr>
                <td headers="oszlop1">Mókus Önkormányzati (MÖK) Pozíció:</td>
                <td headers="oszlop2">Helyettes Államtitkár</td>
                <td headers="oszlop3">Mókusügyi Miniszter</td>
            </tr>
            <tr>
                <td headers="oszlop1">Bankszámlaszám (ha esetleg támogatnál minket):</td>
                <td headers="oszlop2 oszlop3" colspan="2" class="szamla">122333-44445-5555</td>

            </tr>
            <tr>
                <td headers="oszlop1">Email-cím:</td>
                <td headers="oszlop2">hyba28@gmail.com</td>
                <td headers="oszlop3">molnarjanos84@gmail.com</td>
            </tr>
        </table>
    <hr />
    <div>
        <p> Az oldal készítése során semmilyen mókusnak nem esett bántódása!</p>
        <p id="relative">Az alkotók egyébként épelmével rendelkező informatikusok, mégha ez nem is mindig látszik!</p>
    </div>


</main>
<?php
include_once ('footer.php')
?>
</body>
</html>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Mókus oldal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/urlap.css">
    <link rel="shortcut icon" href="media/icon.png" type="image/x-icon">
    <link rel="icon" href="media/icon.png" type="image/x-icon">
</head>
<body>
<!--<header class="fixed_header">-->
<!--    <img src="media/navmokus.jpg" alt="Mókus logó" id="logo">-->
<!--    <div id="title">Mókus oldal</div>-->
<!--    <nav class="navbar">-->
<!--        <ul>-->
<!--            <li><a href="index.php">Főoldal</a></li>-->
<!--            <li><a href="mokusokrol.html">Mókusokról</a></li>-->
<!--            <li><a href="eletmod.html">Életmód</a></li>-->
<!--            <li><a href="tamogatok.php">Galéria</a></li>-->
<!--            <li class="selected"><a href="urlap.html">Támogató leszek</a></li>-->
<!--            <li><a href="kapcsolat.html">Kapcsolat</a></li>-->
<!--        </ul>-->
<!--    </nav>-->
<!--</header>-->
<?php
session_start();
include "controls/Muveletek.php";


//Hogyha getbe kap paramétert, akkor mást ír k. Hogyha postba megkapja a saját űrlapját, akkor belép
$uzenet = "";
if ($_GET['param'] === "galeria") {
    $uzenet = "A galéria megtekintéséhez be kell jelentkeznie!";
} else if ($_GET['param'] === "logout") {
    $uzenet = "Sikeresen kijelentkeztél!";
} else if ($_GET['param'] === "reg") {
    $uzenet = "A regisztráció sikeres volt! Kérem jelentkezzen be!";
}

if (isset($_POST['submit'])) {
    Muveletek::bejelentkezes($uzenet);
}

?>
<main class="content">

    <h2>Ez itt a szöveg:</h2>
    <div>
        <?php
        echo("alma");
        echo "<p>" . $uzenet . "</p>";
        ?>
    </div>


    <form action="bejelentkezes.php" method="post" enctype="multipart/form-data" autocomplete="off">
<fieldset>
            <label for="nev">Név:</label>
            <input type="text" id="nev" name="nev" placeholder="Felhasználónév" value="<?php if (isset($_POST['nev'])) echo $_POST['nev']; ?>" required>

            <label for="jelszo">Jelszó:</label><br>
            <input type="password" id="jelszo" name="jelszo"><br><br>

        <div class="float-right">
            <input type="submit" value="Küldés" name="submit">
        </div>
</fieldset>
    </form>


</main>
<footer>
    © 2023 Mókus oldal
</footer>
</body>
</html>

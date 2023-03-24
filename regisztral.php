<!DOCTYPE html>
<?php
include "controls/Cookies.php";
Cookies::startSession();
?>
<html lang="hu">
<head>
    <title>Támogató leszek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/urlap.css">
    <link rel="shortcut icon" href="media/icon.png" type="image/x-icon">
    <link rel="icon" href="media/icon.png" type="image/x-icon">
</head>
<body>
<?php
include_once ('header.php')
?>

<?php
$hibak = [];
$sikeres = false;
echo("<p>start</p>");
if (isset($_POST['submit'])){
    include "controls/Regisztracio.php";
    Regisztracio::regisztral($hibak, $sikeres);
}
?>
<main class="content">

    <div>
    <p>Ide jönnek a hibák:</p>
        <?php
        if ($sikeres !== true){
            foreach ($hibak as $hiba) {
                echo "<p>" . $hiba . "</p>";
            }
        }
        ?>
    </div>

    <form action="regisztral.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <fieldset>
            <label for="nev" >Név:</label>
            <input type="text" id="nev" name="nev" placeholder="Felhasználónév" value="<?php if (isset($_POST['nev'])) echo $_POST['nev']; ?>" required>

            <label for="email">E-mail cím:</label>
            <input type="email" id="email" name="email" placeholder="tamogato@szeretemamokusokat.hu" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"required>

            <label for="jelszo1">Jelszó:</label><br>
            <input type="password" id="jelszo1" name="jelszo1"><br><br>
            <label for="jelszo2">Jelszó:</label><br>
            <input type="password" id="jelszo2" name="jelszo2"><br><br>

            <label for="uzenet">Itt tudsz kedves dolgokat mondani a mókusoknak:</label>
            <textarea id="uzenet" name="uzenet" value="<?php if (isset($_POST['nev'])) echo $_POST['nev']; ?>">Itt írok Nektek szépeket vagy leírom mivel támogatnálak Benneteket...</textarea>

        </fieldset>

        <fieldset>
            <label for="szint">Mennyire szereted a mókusokat? (1-5)</label>
            <input type="range" id="szint" name="szint" min="1" max="10" step="1" value="10">

            <p>Mi a kedvenc mókusfajtád?</p>
            <input type="radio" id="voros" name="mokusTipus" value="voros" checked="checked">
            <label for="voros">Vörös mókus (ez a helyes válasz)</label><br/>
            <input type="radio" id="szurke" name="mokusTipus" value="szurke">
            <label for="szurke">Szürke mókus</label><br/>
            <input type="radio" id="egyeb" name="mokusTipus" value="egyeb">
            <label for="egyeb">Egyéb mókuskákat szeretek</label>
        </fieldset>

        <label for="kep">Ha szeretnéd, hogy a galériában megjelenjen a kedvenc mókusos képed, ide tedd:</label><br/>
        <input type="file" id="kep" name="kep" accept="image/*">

        <hr/>
        <p> A Mókusok az adományozóknak szeretnek mogyorós finomságokkal kedveskedni</p>

        <input type="checkbox" id="suti" name="suti">
        <label for="suti">Elfogadom a sütit</label>

        <div class="float-right">
            <input type="submit" value="Küldés" name="submit">
        </div>
        <div class="float-left">
            <input type="reset" value="Adatok törlése">
        </div>
    </form>

        <p>Köszönjük hogy a mókusokra szánta idejét!</p>

</main>
<?php
include_once ('footer.php')
?>
</body>
</html>

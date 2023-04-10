<!DOCTYPE html>
<?php
include "controls/Munkamenet.php";
Munkamenet::startSession();
?>
<html lang="hu">
<head>
    <title>Bejelentkezés</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/urlap.css">
    <link rel="shortcut icon" href="media/icon.png" type="image/x-icon">
    <link rel="icon" href="media/icon.png" type="image/x-icon">
</head>
<body>
<?php
include_once('header.php')
?>
<?php
include "controls/Muveletek.php";

//Hogyha getbe kap paramétert, akkor kiírja miért jött ide. Hogyha postba megkapja a saját űrlapját, akkor belép
$uzenet = "";

if (isset($_POST["torles"])) {
    Muveletek::torol($_POST["torles"]);
    $uzenet = "Sikeresen törölted fiókodat!";
}
if (isset($_GET['param'])) {
    if ($_GET['param'] === "tamogatok") {
        $uzenet = "A támogatók megtekintéséhez be kell jelentkezned!";
    } else if ($_GET['param'] === "logout") {
        $uzenet = "Sikeresen kijelentkeztél!";
    } else if ($_GET['param'] === "reg") {
        $uzenet = "Támogató lettél! Kérem jelentkezz be!";
    }
}

if (isset($_POST['submit'])) {
    Muveletek::bejelentkezes($uzenet);
}

?>
<main class="content">

    <!-- TODO ezt meg kell csinálni-->
    <div>
        <?php if ($uzenet !== "") {
            echo "<p>" . $uzenet . "</p>";
        }
        ?>
    </div>

    <form action="bejelentkezes.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <fieldset>
            <label for="nev">Név:</label>
            <input type="text" id="nev" name="nev" placeholder="Felhasználónév"
                   value="<?php if (isset($_POST['nev'])) echo $_POST['nev']; ?>" required>

            <label for="jelszo">Jelszó:</label><br>
            <input type="password" id="jelszo" name="jelszo"><br><br>

            <div class="float-right">
                <input type="submit" value="Küldés" name="submit">
            </div>
        </fieldset>
    </form>


</main>
<?php
include_once('footer.php')
?>
</body>
</html>

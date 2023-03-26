<!-- TODO Ide jönnek a személyes adatok, vagy más személyes adatai, és a felhasználó törlése (ha saját vagy admin)-->
<?php
include "controls/Munkamenet.php";
Munkamenet::startSession();
?>
<?php

//include "config/DeleteUser.php";

$felhasznalo = $_SESSION['user'];

//var_dump($felhasznalo);
$uzenet = "";
$param=$_GET['param'];
if (isset($param) ){
    if($param === "login") {
        $uzenet = "<p>Sikeres bejelentkezés!</p>";
    }
    else{
        Munkamenet::mogyorosSuti();
        $uzenet = "<p>Kaptál egy mogyorós sütit!</p>";
    }
}

if (isset($_POST['torles'])){
    DeleteUser::deleteUser();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Fiók</title>
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
<main class="content">
    <!-- TODO hogyha másik fiók, akkor le kell szedni az adatokat és azt megjeleníteni, meg a cím is a másik felhasználó -->
    <h1>Felhasználó neve vagy akit nézeget</h1>
        <?php
        echo "<div>$uzenet</div>";
        ?>

    <section>
        <div>
            <?php if (isset($felhasznalo['KepURL']) && $felhasznalo['KepURL'] !== "") { ?>
                <figure>
                    <img src="<?php echo $felhasznalo['KepURL']?>" alt="Profilkép">
                </figure>
            <?php } ?>
        </div>
        <table>
            <tbody>
<!--            TODO adatok listázása engedélyek alapján-->

                    <?php foreach ($felhasznalo as $adatNeve => $adatTartalma) {
                        echo("<tr>");
                        if ($adatNeve !== "KepURL") {
                            echo("<th>$adatNeve</th>");

                            echo("<td>");
                            if ($adatNeve === "Kedvenc mókus") {
                                switch ($adatTartalma) {
                                    case "voros":
                                        echo("vörös mókuskák (ők a legaranyosabbak)");
                                        break;
                                    case "szurke":
                                        echo("szürke mókuskák (ők gyorsak)");
                                        break;
                                    case "egyeb":
                                        echo("egyéb mókusok (egyesek még repülni is tudnak)");
                                        break;
                                }
                            }else {
                                echo($adatTartalma);
                            }
                            echo("</td>");
                        }
                        echo("</tr>");

                    }
                    echo("</tr><th>Sütik száma</th><td>".$_COOKIE[$_SESSION['user']['Név']]."</td>");
                    ?>

            </tbody>
        </table>
    </section>
    <div>
        <form method="post" action="profil.php" >
<!--            TODO csak hogyha admin vagy saját maga-->
            <input type="submit" name="torles" value="Profil törlése" />
        </form>
    </div>
</main>

</body>
</html>
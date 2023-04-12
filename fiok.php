<?php
include "controls/Munkamenet.php";

Munkamenet::startSession();
?>
<?php
include "controls/Muveletek.php";

$felhasznalok = Muveletek::felhasznaloFajlbol();
if ((!(isset($_GET['param']))) || $_GET['param'] === 'login') {
    $felhasznalo = $_SESSION['user'];
} else {
    foreach ($felhasznalok as $felh) {
        if ($felh->getNev() === $_GET['param']) {
            $felhasznalo = $felh;
            break;
        }
    }
    if ($_SESSION['user']['Név'] === $_GET['param']) {
        $felhasznalo = $_SESSION['user'];
    }


}


$uzenet = "";

if (isset($_GET['param'])) {
    $param = $_GET['param'];
    if (isset($param)) {
        if ($param === "login") {
            $uzenet = "<p>Sikeres bejelentkezés!</p>";
        } else {
            Munkamenet::mogyorosSuti();
            $uzenet = "<p>Kaptál egy mogyorós sütit!</p>";
        }
    }
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
include_once('header.php')
?>
<main class="content">
    <?php
    if (!isset($_GET['param'])) {
        echo '<h1>Üdvözlöm kedves ' . $felhasznalo['Név'] . '! </h1>';
    } else if ((isset($_GET['param']) && $_GET['param'] === 'login') || ($_SESSION['user']['Név'] === $_GET['param'])) {
        echo '<h1>Üdvözlöm kedves ' . $felhasznalo['Név'] . '! </h1>';
    } else if (isset($_GET['param'])) {
        echo '<h1>Üdvözöllek ' . $_GET['param'] . ' oldalán! </h1>';
    }
    ?>

    <?php
    echo "<div>$uzenet</div>";
    ?>

    <section>
        <div>
            <?php
            if ((!(isset($_GET['param']))) || $_SESSION['user']['Név'] === $_GET['param'] || $_GET['param'] === 'login') {
                //print_r($felhasznalo);
                if (isset($felhasznalo['KepURL']) && $felhasznalo['KepURL'] !== "") { ?>
                    <figure>
                        <img src="<?php echo $felhasznalo['KepURL'] ?>" alt="Profilkép">
                    </figure>
                <?php }
            } else if ($felhasznalo->getAdatok() || $_SESSION['user']['Admin'] === "Igen") {
                ?>
                <figure>
                    <img src="<?php echo $felhasznalo->getKep() ?>" alt="Profilkép">
                </figure>
            <?php } else {
                ?>
                <figure>
                    <img src="media/evomokus.jpg" alt="Cuki mókuska">
                </figure>
                <?php
            }

            ?>

        </div>
        <table>
            <tbody>
            <!--            TODO adatok listázása engedélyek alapján-->

            <?php
            //print_r($_SESSION['user']);
            if ((!(isset($_GET['param']))) || $_SESSION['user']['Név'] === $_GET['param'] || $_GET['param'] === 'login') {
                foreach ($felhasznalo as $adatNeve => $adatTartalma) {
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
                        } else {
                            echo($adatTartalma);
                        }
                        echo("</td>");
                    }
                    echo("</tr>");

                }
                if (isset($_COOKIE[$_SESSION['user']['Név']])) {
                    echo("</tr><th>Sütik száma</th><td>" . $_COOKIE[$_SESSION['user']['Név']] . "</td>");
                } else {
                    echo("</tr><th>Sütik száma</th><td>0</td>");
                }
            } else if ($felhasznalo->getAdatok() || $_SESSION['user']['Admin'] === "Igen") {
                echo("<tr>");
                echo('<th>Név</th>');
                echo('<td>' . $felhasznalo->getNev() . '</td>');
                echo("</tr>");
                echo("<tr>");
                echo('<th>Email</th>');
                echo('<td>' . $felhasznalo->getEmail() . '</td>');
                echo("</tr>");
                echo("<tr>");
                echo('<th>Üzenet</th>');
                echo('<td>' . $felhasznalo->getUzenet() . '</td>');
                echo("</tr>");
                echo("<tr>");
                echo('<th>Kedvenc Mókus</th>');
//                echo('<td>' . $felhasznalo->getMokusTipus() . '</td>');

                echo('<td>');
                switch ($felhasznalo->getMokusTipus()) {
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
                echo('</td>');


                echo("</tr>");
                echo("<tr>");
                echo('<th>Mókusok kedvelése</th>');
                echo('<td>' . $felhasznalo->getSzint() . '</td>');
                echo("</tr>");

            } else {
                echo "Sajnos " . $felhasznalo->getNev() . " nevű felhasználó nem járult hozzá adatai megjelenítéséhez, 
                        itt egy cuki mókuska nézegesd ezt, természetesen a Süti így is jár neked!";
            }
            ?>

            </tbody>
        </table>
    </section>
    <?php
    if ((!(isset($_GET['param']))) || $_SESSION['user']['Név'] === $_GET['param'] || $_GET['param'] === 'login') {
        echo '<div>
            <form method="post" action="bejelentkezes.php" >
            <input type="hidden" name="torles" value="' . $felhasznalo['Név'] . '">
                <button type="submit">Profil törlése</button>
            </form>
            </div>';
    } else if ($_SESSION['user']['Admin'] === "Igen") {
        echo '<div>
            <form method="post" action="tamogatok.php" >
            <input type="hidden" name="torles" value="' . $_GET['param'] . '">';

        echo '<button type="submit">Profil törlése</button>
            </form>
            </div>';
    }

    ?>
</main>

</body>
</html>
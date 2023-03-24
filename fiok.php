<!-- TODO Ide jönnek a személyes adatok, vagy más személyes adatai, és a felhasználó törlése (ha saját vagy admin)-->
<?php
include "controls/Cookies.php";
Cookies::startSession();
?>
<?php

//include "config/DeleteUser.php";

$felhasznalo = $_SESSION['user'];

//var_dump($felhasznalo);
$uzenet = "";
$param=$_GET['param'];
if (isset($param) && strlen($param) > 0){
    if($param === "login"){
        $uzenet = "<p>Sikeres bejelentkezés!</p>";
    }
    if($param !== "login"){
        $uzenet = "<p>Információ a támogatóról:</p>";

    }
}

    //$_GET['param'] = "";



/*if (isset($_POST['delete'])){
    DeleteUser::deleteUser();
}*/
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
<main class="container">
    <h1>FIOK</h1>
    <div>
        <?php echo $uzenet;?>
    </div>
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
<!--            TODO ide kell egy táblázat az adatok listázásával engedélyek alapján-->

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

                    ?>




            </tbody>
        </table>
    </section>
    <div>
        <form method="post" action="profil.php" >
<!--            TODO hogyha admin vagy saját maga-->
            <input type="submit" name="delete" value="Profil törlése" />
        </form>
    </div>
</main>

</body>
</html>
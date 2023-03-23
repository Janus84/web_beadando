<!-- TODO Ide jönnek a személyes adatok, vagy más személyes adatai, és a felhasználó törlése (ha saját vagy admin)-->
<?php
//include "config/CheckCookies.php";
//CheckCookies::checkCookiesEnabled();

//include "config/DeleteUser.php";

$felhasznalo = $_SESSION['user'];

var_dump($felhasznalo);
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
            <caption>Profil</caption>
            <tbody>
<!--            TODO ide kell egy táblázat az adatok listázásával engedélyek alapján-->
            <?php foreach ($felhasznalo as $adatai => $felhasznaloAdatok) {?>
                <tr>
                    <?php if ($adatai !== "KepURL"){ ?>
                        <th><?php echo $adatai ?></th>
                        <td><?php if(trim($felhasznaloAdatok) === "") echo "Nincs megadva"; else echo $felhasznaloAdatok?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
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
<?php

// Get paraméter globális tömbbe
if (isset($GLOBALS['queryParams'])) {
    $queryParams = $GLOBALS['queryParams'];
} else {
    $queryParams = "";
}

// Navigációs elemek összeállítása
include_once "models/NavItem.php";

$navLista = [
    new Linkek("index.php" . $queryParams, "Főoldal"),
    new Linkek("mokusokrol.php" . $queryParams, "Mókusokról"),
    new Linkek("eletmod.php" . $queryParams, "Életmód"),
    new Linkek("tamogatok.php" . $queryParams, "Támogatók"),
    new Linkek("kapcsolat.php" . $queryParams, "Kapcsolat"),
];

// Bejelentkezés alapján megjelenik
if (isset($_SESSION['user'])) {
    $navLista[] = new Linkek("fiok.php" . $queryParams, "Fiókom");
    $navLista[] = new Linkek("kijelentkezes.php" . $queryParams, "Kijelentkezés");
} else {
    $navLista[] = new Linkek("urlap.php" . $queryParams, "Támogató leszek");
    $navLista[] = new Linkek("bejelentkezes.php" . $queryParams, "Bejelentkezés");
}

$location = explode("/", $_SERVER['REQUEST_URI'])[2];
if (strpos($location, "?")) {
    $location= explode("?", $location)[0];
}

//$GLOBALS['title'] = "";


echo '<header class="fixed_header">
    <img src="media/navmokus.jpg" alt="Mókus logó" id="logo">
    <div id="title">Mókus oldal</div>
    <nav class="navbar">
        <ul>
            <li class="selected"><a href="index.html">Főoldal</a></li>
            <li><a href="mokusokrol.html">Mókusokról</a></li>
            <li><a href="eletmod.html">Életmód</a></li>
            
            <!--Ez csak bejelentkezettnek -->
            <li><a href="tamogatok.php">Támogatók</a></li>


            <li><a href="kapcsolat.html">Kapcsolat</a></li>
            
            <li><a href="urlap.php">Támogató leszek</a></li>
            <li><a href="bejelentkezes.html">Támogató vagyok</a></li>
            <!--Vagy -->
            <li><a href="fiokom.html">Fiókom</a></li>          
            <li><a href="kijelentkezes.html">Kijelentkezés</a></li>
            
        </ul>
    </nav>
</header>';
?>

<?php
include_once "models/NavItem.php";

if (isset($GLOBALS['qetParams'])) {
    $qetParams = $GLOBALS['qetParams'];
} else {
    $qetParams = "";
}

//Létrehozzuk a navigációs elemeket és a linkekhez hozzáfűzzük a get paramétereket a sessionID miatt
$navElemek = [
    new NavItem("Főoldal", "index.php" . $qetParams),
    new NavItem("Mókusokról", "mokusokrol.php" . $qetParams),
    new NavItem("Életmód", "eletmod.php" . $qetParams),
    new NavItem("Támogatók", "tamogatok.php" . $qetParams),
    new NavItem("Kapcsolat", "kapcsolat.php" . $qetParams),
];

// Bejelentkezés alapján megjelenik
if (isset($_SESSION['user'])) {
    $navElemek[] = new NavItem("Fiókom", "fiok.php" . $qetParams);
    $navElemek[] = new NavItem("Kijelentkezés", "kijelentkezes.php" . $qetParams);
} else {
    $navElemek[] = new NavItem("Támogató leszek", "regisztracio.php" . $qetParams);
    $navElemek[] = new NavItem("Bejelentkezés", "bejelentkezes.php" . $qetParams);
}

//meghatározzuk a link elejét
$location = explode("/", $_SERVER['REQUEST_URI'])[2];
//hogyha van benne ?, akkor a végét levágjuk
if (strpos($location, "?")) {
    $location = explode("?", $location)[0];
} ?>

<header class="fixed_header">
    <img src="media/navmokus.jpg" alt="Mókus logó" id="logo">
    <div id="title">Mókus oldal</div>
    <nav class="navbar">
        <ul>
            <?php
            foreach ($navElemek as $elem) { ?>
                <li class="<?php if ($elem->getLink() === $location) echo "selected" ?>">
                    <a href=<?php echo $elem->getLink() ?>>
                        <?php echo $elem->getNev(); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</header>


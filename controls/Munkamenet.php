<?php

class Munkamenet
{
    public static function startSession()
    {
        //A session sütiben fog tárolódni
        //hogyha nem jött létre a session süti, akkor get-ben fogjuk tovább adni
        if (!isset($_COOKIE['PHPSESSID'])) {
            if (isset($_GET['session'])) {
                $id = session_id($_GET['session']); //itt állítom be a SESSION-t
                $sessionParam = "?session=" . $id;
                $GLOBALS['getParams'] = $sessionParam;
            } else {
                $GLOBALS['getParams'] = "";
            }
        }
        if (session_status() == PHP_SESSION_NONE) { //Hogyha van session, akkor nem hívom meg
            session_start();
        }
    }
    public static function stopSession()
    {
        if (isset($_COOKIE['PHPSESSID'])){
            setcookie(session_name(), session_id(), time() - 100000, "/");
        }
        session_destroy();
        header("Location: bejelentkezes.php?uzenet=logout");
    }

    public static function mogyorosSuti()
    {
        $mogyorosSuti = 1;
        if (isset($_COOKIE[$_SESSION["user"]['Név']])) {
            $mogyorosSuti = $_COOKIE[$_SESSION["user"]['Név']] + 1;
        }
        setcookie($_SESSION["user"]['Név'], $mogyorosSuti, time() + (60 * 1), "/"); //3 percre süti teszteléshez, hogy mennyire fogy a süti
        if(isset($_SESSION["user"]['Név'])){
            setcookie("nev", $_SESSION["user"]['Név'] , time() + (60 * 60 * 24 * 15), "/");
        }
    }

    public static function sutiTorles()
    {
        setcookie("mogyorosSuti", "", time() - 100000);
        setcookie("nev", "", time() - 100000);
    }
}

?>
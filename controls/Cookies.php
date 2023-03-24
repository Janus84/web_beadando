<?php

class Cookies
{

    public static function startSession()
    {
        //A session sütiben fog tárolódni
        session_start();

        //hogyha nem jött létre a session süti, akkor get-ben fogjuk tovább adni
        if (!isset($_COOKIE['PHPSESSID'])) {
            if (isset($_GET['session'])) {
                $id = session_id($_GET['session']); //itt állítom be a SESSIONT
                $sessionParam = "?session=" . $id;
                $GLOBALS['getParams'] = $sessionParam;
            } else {
                $GLOBALS['getParams'] = "";
            }
        }
    }

    public static function mogyorosSuti()
    {
        $mogyorosSuti = 1;
        if (isset($_COOKIE["mogyorosSuti"])) {
            $mogyorosSuti = $_COOKIE["mogyorosSuti"] + 1;
        }
        setcookie("mogyorosSuti", $mogyorosSuti, time() + (60 * 60 * 24 * 15), "/");
    }

    public static function setNameCookie()
    {
        if(isset($_SESSION["nev"])){
            setcookie("nev", $_SESSION["nev"] , time() + (60 * 60 * 24 * 15), "/");
        }
    }

    public static function deleteCookies()
    {
        setcookie("mogyorosSuti", "", time() - 3600);
        setcookie("nev", "", time() - 3600);
    }
}

?>
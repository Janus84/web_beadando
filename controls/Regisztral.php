<?php
include "Validator.php";
include "models/Felhasznalo.php";
include "Muveletek.php";
include_once "exceptions/MokusException.php";
include_once "controls/Munkamenet.php";

class Regisztral
{
    public static function elment(&$hibak, &$sikeres)
    {

        try {
            $validator = new Validator();
        } catch (Exception $exception) {
            $hibak[] = "A felhasználók adatbázisa nem töltődött be, mert: $exception";
        }

        $szint = $_POST['szint'];
        $tipus = $_POST['mokusTipus'];
        $uzenet = $_POST['uzenet'];

        if (isset($_POST['adatok'])) {
            $adatok = $_POST['adatok'];
        } else {
            $adatok = false;
        }
        if (isset($_POST['suti'])) {
            $suti = $_POST['suti'];
        } else {
            $suti = false;
        }

        list($nev, $hibak, $email, $jelszo, $imageURL) = self::validal($validator, $hibak);

        if (count($hibak) === 0) {
            $ujSor = new Felhasznalo($nev, $email, $jelszo, $uzenet, $szint, $tipus, $imageURL, $suti, $adatok);
            Muveletek::felhasznaloFajlba($ujSor);
            $sikeres = true;
        } else {
            $sikeres = false;
        }

        if ($sikeres === true) {
            //ha van süti engedélyezés, akkor bejegyezzük
            if ($suti) {
//                echo("<h1>MOGYORÓSSÜTI BEJEGYZÉSE</h1>");
                Munkamenet::mogyorosSuti();
            } else {
                Munkamenet::sutiTorles();
            }
            if (isset($GLOBALS['getParams']) && $GLOBALS['getParams'] !== "") {
                header("Location: regisztracio.php" . $GLOBALS['getParams']);//itt visszük tovább a paramétereket
            } else {
                header("Location: bejelentkezes.php?param=reg");
            }
        }
        if ($sikeres === false){
            unlink($imageURL);
        }
    }

    /**
     * @param Validator $validator
     * @param array $hibak
     * @return array
     */
    public static function validal(Validator $validator, array $hibak): array
    {

        $nev = "";
        $email = "";
        $jelszo = "";
        $imageURL = "";

        try {
            $nev = $validator->nameIsValid();
        } catch (MokusException $exception) {
            $hibak[] = $exception->getMessage();
        }

        try {
            $email = $validator->emailIsValid();
        } catch (MokusException $exception) {
            $hibak[] = $exception->getMessage();
        }

        try {
            $jelszo = $validator->jelszoIsValid();
        } catch (MokusException $exception) {
            $hibak[] = $exception->getMessage();
        }

        try {
            $imageURL = Muveletek::kepMentes($nev);
        } catch (MokusException $exception) {
            $hibak[] = $exception->getMessage();
        }


        return array($nev, $hibak, $email, $jelszo, $imageURL);
    }
}

<?php
include "Validator.php";
include "models/Felhasznalo.php";
include "Muveletek.php";
include_once "exceptions/MokusException.php";
include_once "controls/Munkamenet.php";
class Regisztral{
    public static function elment(&$hibak, &$sikeres){

        try{
            $validator = new Validator();
        }
        catch (Exception $exception){
            $hibak[] = "A felhasználók adatbázisa nem töltődött be, mert: $exception";
        }

        $uzenet= $_POST['uzenet'];
        $suti=$_POST['suti'];

        list($nev, $hibak, $email, $jelszo, $imageURL) = self::validal($validator, $hibak);

        if (count($hibak) === 0 ) {
            $ujSor = new Felhasznalo($nev, $email, $jelszo, $uzenet, "3", "voros", $imageURL, $suti);
            Muveletek::felhasznaloFajlba( $ujSor);
            $sikeres = true;
        } else {
            $sikeres = false;
        }

        if ($sikeres === true) {
            //ha van süti engedélyezés, akkor bejegyezzük
            if($suti){
                echo("<h1>MOGYORÓSSÜTI BEJEGYZÉSE</h1>");
                Munkamenet::mogyorosSuti();
            }
            else{
                Munkamenet::sutiTorles();
            }
            if (isset($GLOBALS['getParams']) && $GLOBALS['getParams'] !== "") {
                header("Location: regisztracio.php" . $GLOBALS['getParams']);//itt visszük tovább a paramétereket
            } else {
                header("Location: bejelentkezes.php?param=reg");
            }
        }
    }

    /**
     * @param Validator $validator
     * @param array $hibak
     * @return array
     */
    public static function validal(Validator $validator, array $hibak): array
    {
        try {
            $nev = $validator->nameIsValid();
            echo("Nev: $nev");
        } catch (MokusException $exception) {
            $hibak[] = $exception->getMessage();
        }

        try {
            $email = $validator->emailIsValid();
            echo("Email: $email");
        } catch (MokusException $exception) {
            $hibak[] = $exception->getMessage();
        }

        try {
            $jelszo = $validator->jelszoIsValid();
            echo("Jelszo: $jelszo");
        } catch (MokusException $exception) {
            $hibak[] = $exception->getMessage();
        }

        try {
            $imageURL = Muveletek::kepMentes($nev);
            echo("URL: $imageURL");
        } catch (MokusException $exception) {
            $hibak[] = $exception->getMessage();
        }
        return array($nev, $hibak, $email, $jelszo, $imageURL);
    }
}

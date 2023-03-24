<?php
include "Validator.php";
include "models/Felhasznalo.php";
include "Muveletek.php";
include_once "exceptions/MokusException.php";
class Regisztracio{
    public static function regisztral(&$hibak, &$sikeres){


        $validator = new Validator();
        $uzenet= $_POST['uzenet'];
        $suti=$_POST['suti'];

        try {
            $nev = $validator->nameIsValid();
            echo("Nev: $nev");
        } catch (MokusException $exception){
            $hibak[] = $exception->getMessage();
        }

        try {
            $email = $validator->emailIsValid();
            echo("Email: $email");
        } catch (MokusException $exception){
            $hibak[] = $exception->getMessage();
        }

        try{
            $jelszo = $validator->jelszoIsValid();
            echo("Jelszo: $jelszo");
        } catch (MokusException $exception){
            $hibak[] = $exception->getMessage();
        }

        try{
            $imageURL = Muveletek::kepMentes($nev);
            echo("URL: $imageURL");
        } catch (MokusException $exception){
            $hibak[] = $exception->getMessage();
        }


        if (count($hibak) === 0 ) {
            $ujSor = new Felhasznalo($nev, $email, $jelszo, $uzenet, "3", "voros", $imageURL, $suti);
            Muveletek::kiir( $ujSor);
            $sikeres = true;
        } else {
            $sikeres = false;
        }

        if ($sikeres === true) {
            if (isset($GLOBALS['suffix']) && $GLOBALS['suffix'] !== "") {
                header("Location: regisztral.php" . $GLOBALS['suffix'] . "&uzenet=reg"); //TODO ezt még nem értem teljesen
            } else {
                header("Location: bejelentkezes.php?param=reg");
            }
        }
    }
}

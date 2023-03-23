<?php
include "Validator.php";
include "models/Felhasznalo.php";
include "Muveletek.php";
include_once "exceptions/MokusException.php";
class Regisztracio{
    public static function regisztral(&$hibak, &$sikeres){

        $felhasznalok = Muveletek::betolt();
        $validator = new Validator();

        try {
            $nev = $validator->nameIsValid($felhasznalok);
        } catch (MokusException $exception){
            $hibak[] = $exception->getMessage();
        }

        try {
            $email = $validator->emailIsValid($felhasznalok);
        } catch (MokusException $exception){
            $hibak[] = $exception->getMessage();
        }

        try{
            $jelszo = $validator->jelszoIsValid();
        } catch (MokusException $exception){
            $hibak[] = $exception->getMessage();
        }

        try{
            $imageURL = Muveletek::kepMentes($nev);
        } catch (MokusException $exception){
            $hibak[] = $exception->getMessage();
        }

        if (count($hibak) === 0 ) {
            $ujSor = new Felhasznalo($nev, $email, $jelszo, "teszt", "3", "voros", $imageURL, false);
            Muveletek::kiir( $ujSor);
            $sikeres = true;
        } else {
            $sikeres = false;
        }

        if ($sikeres === true) {
            if (isset($GLOBALS['suffix']) && $GLOBALS['suffix'] !== "") {
                header("Location: urlap.php" . $GLOBALS['suffix'] . "&uzenet=reg"); //TODO ezt még nem értem teljesen
            } else {
                header("Location: bejelentkezes.php?param=reg");
            }
        }
    }
}

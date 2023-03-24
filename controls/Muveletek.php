<?php
include_once "exceptions/MokusException.php";
include_once "models/Felhasznalo.php";

class Muveletek
{
    public static function kiir(Felhasznalo $felhasznalo)
    {
        $file = null;
        try {
            $file = fopen("database/felhasznalok.txt", "a");
            fwrite($file, serialize($felhasznalo) . "\n");
        } catch (Error $hibak) {
            header("Location: regisztral.php?hibak=" . $hibak->getMessage());
            //echo("$hibak->getMessage()");
        } finally {
            fclose($file);
        }
        return "Sikeres mentés";
    }
    public static function betolt()
    {
        $felhasznalok = [];
        $file = null;
        try {
            $file = fopen("database/felhasznalok.txt", "r");

            while (($line = fgets($file)) !== false) {
                $felhasznalo = unserialize($line);//['allowed_classes' => ['Felhasznalo']]
                //var_dump(($felhasznalo));
                $felhasznalok[] = $felhasznalo;
            }
        } catch (Error $error) {
            header("Location: ../index.php?uzenet=" . $error->getMessage());
        } finally {
            if ($file != null) {
                fclose($file);
            }
        }
        return $felhasznalok;
    }
    public static function kepMentes($nev): string
    {
        $kep = $_FILES['kep'];
        if (isset($kep) && is_uploaded_file($kep["tmp_name"])) {
            $elfogadhato = ["png", "jpg", "jpeg"];
            $kiterjesztes = strtolower(pathinfo($kep["name"], PATHINFO_EXTENSION));

            if (in_array($kiterjesztes, $elfogadhato)) {
                if ($kep["error"] === 0) {
                    if ($kep["size"] <= 31457280) {
                        $path = "media/galeria/" . $nev . "." . $kiterjesztes;

                        if (!move_uploaded_file($kep["tmp_name"], $path)) {
                            throw new MokusException("Nem sikerült a képet a falra tűzni!");
                        }
                    } else {
                        throw new MokusException("A mókusok nem tudnak ekkora képeket feldolgozni!");
                    }
                } else {
                    throw new MokusException("Gond volt a kép feltöltésével!");
                }
            } else {
                throw new MokusException("Jajj! Ez nem is egy kép!");
            }
            return $path;

        } else {
            return "media/navmokus.jpg";
        }
    }
    public static function bejelentkezes(&$uzenet)
    {
        $nev = $_POST['nev'];
        $jelszo = $_POST['jelszo'];
        $felhasznalok = Muveletek::betolt();

        if (!isset($nev) || trim($nev) === "" || !isset($jelszo) || trim($jelszo) === "") {
            $uzenet = "Információk hiányában nem fognak megismerni a mókusok. A mezőket ki kell tölteni!";
        } else {
            $uzenet = "A belépési adatok nem megfelelőek!"; //Ha nem megy végig a folyamaton, akkor ez lesz az üzenet
            foreach ($felhasznalok as $felhasznalo) {
                if ($felhasznalo instanceof Felhasznalo) {
                    if ($felhasznalo->getNev() === $nev && password_verify($jelszo, $felhasznalo->getJelszo())) {
                        $uzenet = "Sikeres belépés";

                        $felhasznaloAdatok = [];
                        $felhasznaloAdatok['Név'] = $felhasznalo->getNev();
                        $felhasznaloAdatok['Email'] = $felhasznalo->getEmail();
                        $felhasznaloAdatok['Üzenet'] = $felhasznalo->getUzenet();
                        $felhasznaloAdatok['Kedvenc mókus'] = $felhasznalo->getMokusTipus();
                        $felhasznaloAdatok['Mókusok kedvelése'] = $felhasznalo->getSzint();
                        $felhasznaloAdatok['KepURL'] = $felhasznalo->getKep();
                        $felhasznaloAdatok['Süti engedélyezve'] = ($felhasznalo->getSuti() ? "Igen" : "Nem");

                        $_SESSION['user'] = $felhasznaloAdatok;

                        if (isset($_COOKIE['PHPSESSID'])){
                             header("Location: fiok.php?uzenet=login");
                         } else {
                             header("Location: fiok.php?session=" . session_id());
                         }
                    }
                }
            }
        }
    }




/*
    public static function torol($felhasznalok){
            $file = null;

            try {
                $file = fopen("felhasznalok/felhasznalok.txt", "w");

                foreach ($felhasznalok as $felhasznalo){
                    fwrite($file, serialize($felhasznalo) . "\n");
                }
            } catch (Error $error){
                header("Location: ../index?uzenet=" . $error->getMessage() . "torol");
            } finally {
                fclose($file);
            }
        }*/




    }
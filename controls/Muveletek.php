<?php
include_once "exceptions/MokusException.php";

class Muveletek
{
    public static function kiir(Felhasznalo $felhasznalo)
    {
        $file = null;
        try {
            $file = fopen("database/felhasznalok.txt", "a");
            fwrite($file, serialize($felhasznalo) . "\n");
        } catch (Error $error) {
            //header("Location: urlap.php?hibak=" . $hibak->getMessage());
            echo("$hibak->getMessage()");
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
                $felhasznalo = unserialize($line);
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
        echo("BEJELENTKEZES");
        $nev = $_POST['nev'];
        $jelszo = $_POST['jelszo'];
        $felhasznalok = Muveletek::betolt();
        //var_dump($felhasznalok);

        if (!isset($nev) || trim($nev) === "" || !isset($jelszo) || trim($jelszo) === "") {
            $uzenet = "Információk hiányában nem fognak megismerni a mókusok. A mezőket ki kell tölteni!";
            echo("$uzenet");
        } else {
            $uzenet = "!!!!!!!!!!!!!!!!!!Sikertelen belépés";
            foreach ($felhasznalok as $felhasznalo) {
                echo("----------------------------------");
               // var_dump($felhasznalo);
                echo("teszt:".($felhasznalo instanceof Felhasznalo));
                if ($felhasznalo instanceof Felhasznalo) {
                    //echo("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!4");
                    //echo("$felhasznalo->getNev(), $nev". "  ". "$felhasznalo->getJelszo(), password_verify($jelszo, PASSWORD_DEFAULT)");
                    if ($felhasznalo->getNev() === $nev && $felhasznalo->getJelszo() === password_verify($jelszo, PASSWORD_DEFAULT)) {
                        $uzenet = "Sikeres belépés";

                        $felhasznaloAdatok = [];
                        $felhasznaloAdatok['Nev'] = $felhasznalo->getNev();
                        $felhasznaloAdatok['Email'] = $felhasznalo->getEmail();
                        $felhasznaloAdatok['KepURL'] = $felhasznalo->getProfilKep();
                        $felhasznaloAdatok['Suti'] = ($felhasznalo->getSuti() ? "Igen" : "Nem");

                        $_SESSION['user'] = $felhasznaloAdatok;

                        /* if (isset($_COOKIE['testcookie'])){
                             header("Location: profil.php?uzenet=login");
                         } else {
                             header("Location: profil.php?PHPSESSID=" . session_id());
                         }*/
                        // Todo hogyha felhasználónévvel érek a profilhoz, akkor megmutatja az aktuális felhasználót
                        header("Location: fiok.php?param=login");
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
<?php
include_once "exceptions/MokusException.php";
include_once "models/Felhasznalo.php";

class Muveletek
{
    public static function felhasznaloFajlba(Felhasznalo $felhasznalo)
    {
        $file = null;
        try {
            $file = fopen("database/felhasznalok.txt", "a");
            fwrite($file, serialize($felhasznalo) . "\n");
        } catch (Error $error) {
            if (isset($GLOBALS['getParams']) && $GLOBALS['getParams'] !== "") {
                header("Location: index.php?hiba=" . $error->getMessage() . $GLOBALS['getParams']);//itt visszük tovább a paramétereket
            } else {
                header("Location: index.php?hiba=" . $error->getMessage());
            }


        } finally {
            fclose($file);
        }
        return "Sikeres mentés";
    }

    public static function felhasznaloFajlbol()
    {
        $felhasznalok = [];
        $file = null;
        try {
            $file = fopen("database/felhasznalok.txt", "r");

            while (($line = fgets($file)) !== false) {
                $felhasznalo = unserialize($line);//['allowed_classes' => ['Felhasznalo']]
                $felhasznalok[] = $felhasznalo;
            }
        } catch (Error $error) {
            if (isset($GLOBALS['getParams']) && $GLOBALS['getParams'] !== "") {
                header("Location: index.php?hiba=" . $error->getMessage() . $GLOBALS['getParams']);//itt visszük tovább a paramétereket
            }
            header("Location: ../index.php?hiba=" . $error->getMessage());
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
        $felhasznalok = Muveletek::felhasznaloFajlbol();

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
                        $felhasznaloAdatok['Admin'] = ($felhasznalo->getAdmin());
                        // admin beallitasa
                        //$felhasznaloAdatok['Admin'] = "Igen";

                        $_SESSION['user'] = $felhasznaloAdatok;

                        if ($felhasznalo->getSuti() && !isset($_COOKIE[$felhasznalo->getNev()])) {
                            Munkamenet::mogyorosSuti();
                        } else {
                            Munkamenet::sutiTorles();
                        }

                        if (isset($_COOKIE['PHPSESSID'])) {
                            header("Location: fiok.php?param=login");
                        } else {
                            header("Location: fiok.php?param=login&session=" . session_id()); //innen indítjuk a sessiont, ha nincs süti
                        }

                    }
                }
            }
        }
    }


    public static function torol($felhasznalonev)
    {
        $felhasznalok = self::felhasznaloFajlbol();
        $filenullaz = fopen("database/felhasznalok.txt", "w");
        fclose($filenullaz);
        try {
            foreach ($felhasznalok as $key => $felh) {
                if ($felh->getNev() === $felhasznalonev) {
                    unset($felhasznalok[$key]);
                    if ($felh->getKep() !== "media/navmokus.jpg") {
                        unlink($felh->getKep());
                    }
                    if (!($_SESSION['user']['Admin'])) {
                        Munkamenet::sutiTorles();
                        Munkamenet::stopSession();
                        setcookie("nev", "", time() - 3600, "/");
                    }
                    break;
                }
            }
            foreach ($felhasznalok as $felh) {
                self::felhasznaloFajlba($felh);
            }
            if (isset($_COOKIE['PHPSESSID'])) {
                header("Location: kijelentkezes.php");
            } else {
                header("Location: kijelentkezes.php&session=" . session_id()); //innen indítjuk a sessiont, ha nincs süti
            }

        } catch (Error $error) {
            if (isset($GLOBALS['getParams']) && $GLOBALS['getParams'] !== "") {
                header("Location: index.php?hiba=" . $error->getMessage() . $GLOBALS['getParams']);//itt visszük tovább a paramétereket
            } else {
                header("Location: index.php?hiba=" . $error->getMessage());
            }
        } finally {

        }
    }


}
<?php
include_once "exceptions/MokusException.php";

class Validator
{
    private $felhasznalok;

    public function __construct()
    {
        $this->felhasznalok = Muveletek::felhasznaloFajlbol();
    }//Ez statikusan is működne, de szerettünk volna példányosítható osztályt is

public
function nameIsValid(): string
{
    $nev = $_POST['nev'];
    if (!isset($nev) || strlen($nev) < 4) {
        throw new MokusException("A mókusok preferálják, ha a felhasználónév hosszabb mint 4 karakter!");
    }
    foreach ($this->felhasznalok as $felhasznalo) {
        if ($felhasznalo->getNev() === $nev) {
            throw new MokusException("A felhasználó már foglalt!");
        }
    }
    return $nev;
}

function emailIsValid(): string
{
    $email = $_POST['email'];
    if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new MokusException("Ez az email formátum nem megfelelő!");
    }
    foreach ($this->felhasznalok as $felhasznalo) {
        if ($felhasznalo->getEmail() === $email) {
            throw new MokusException("Az email cím már foglalt!");
        }
    }
    return $email;
}


function jelszoIsValid(): string
{
    $jelszo1 = $_POST['jelszo1'];
    $jelszo2 = $_POST['jelszo2'];

    if (!isset($jelszo1) || strlen($jelszo1 <= 6)) {
        throw new MokusException("A mókusok nem elégszenek meg ilyen rövid jelszóval!");
    }
    if ($jelszo1 !== $jelszo2) {
        throw new MokusException("A mókusok szerint ez a két jelszó nem egyezik!");
    } else return password_hash($jelszo1, PASSWORD_DEFAULT);
}

/*
    function savePic($path, Felhasznalo $felhasznalo): bool{
        if (isset($_FILES['kep'])){

            $kiterjesztesek = ["png", "jpg", "jpeg"];
            $kiterjesztes = strtolower(pathinfo($_FILES['kep']['name'], PATHINFO_EXTENSION));
            if(in_array($kiterjesztes, $kiterjesztesek)){
                if (isset($_POST['nev'])){
                    $cel = $path . $_POST['nev'] . "." . strtolower(pathinfo($_FILES['kep']['name'], PATHINFO_EXTENSION));
                } else {
                    $cel = $path. $_FILES['kep']['name'];
                }
                if (move_uploaded_file($_FILES['kep']['tmp_name'], $cel)){
                    $felhasznalo->setProfilKep($cel);
                } else {
                    throw new BeviteliAdatokException("A kép mentése nem sikerült");
                }
            } else {
                return false;
            }
        }
        return true;
    }*/
}
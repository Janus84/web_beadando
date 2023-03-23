<?php
class NavItem
{
    private $nev;
    private $link;
    //private $permission;

    public function __construct($nev, $link, $permission) {
        $this->nev = $nev;
        $this->link = $link;
        //$this->permission = $permission;
    }

    public function getNev() {
        return $this->nev;
    }
    public function getLink() {
        return $this->link;
    }
    /*public function getPermission() {
        return $this->permission;
    }*/
}
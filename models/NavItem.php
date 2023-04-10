<?php

class NavItem
{
    private $nev;
    private $link;

    //private $permission;

    public function __construct($nev, $link)
    {
        $this->nev = $nev;
        $this->link = $link;
        //$this->permission = $permission;
    }

    /**
     * @return mixed
     */
    public function getNev()
    {
        return $this->nev;
    }

    /**
     * @param mixed $nev
     */
    public function setNev($nev): void
    {
        $this->nev = $nev;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
//    public function getPermission()
//    {
//        return $this->permission;
//    }
//
//    /**
//     * @param mixed $permission
//     */
//    public function setPermission($permission): void
//    {
//        $this->permission = $permission;
//    }


}
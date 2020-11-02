<?php

class Bdd
{
    protected $bdd;

    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=localhost;dbname=wander", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }
}
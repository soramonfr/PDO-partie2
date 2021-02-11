<?php

/**
 * Classe permettant de se connecter à la base de données et qui peut renvoyer la connexion
 * TODO : Rajouter des méthodes qui permettrait de fermer la connexion
 */
class Database {
    private $db;

    public function __construct() {
        $this->setDb(new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]));
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }
}
<?php

/**
 * Classe Patients qui correspond à la table patients en bdd
 */
class Patients
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database->getDb();
    }

    public function createPatientFile($arrayParameters)
    {
        $response = $this->db->prepare("INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)");
        $response->bindValue("lastname", $arrayParameters["lastname"], PDO::PARAM_STR);
        $response->bindValue("firstname", $arrayParameters["firstname"], PDO::PARAM_STR);
        $response->bindValue("birthdate", $arrayParameters["birthdate"], PDO::PARAM_STR);
        $response->bindValue("phone", $arrayParameters["phone"], PDO::PARAM_STR);
        $response->bindValue("mail", $arrayParameters["mail"], PDO::PARAM_STR);
        return $response->execute();
    }
}

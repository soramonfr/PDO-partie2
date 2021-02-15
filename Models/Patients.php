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

    public function displayPatientsList() {
        $response = $this->db->query("SELECT * FROM patients");
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function displayPatientsForAppointments() {
        $response = $this->db->query("SELECT id, lastname, firstname FROM patients");
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPatientFileById($id) {
        $statement = $this->db->prepare("SELECT * FROM patients WHERE id = :id");
        $statement->bindValue("id", $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function updatePatient($arrayParameters)
    {
        $response = $this->db->prepare("UPDATE patients 
            SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, phone = :phone, mail = :mail
            WHERE id = :id"
        );
        $response->bindValue("id", $arrayParameters["id"], PDO::PARAM_INT);
        $response->bindValue("lastname", $arrayParameters["lastname"], PDO::PARAM_STR);
        $response->bindValue("firstname", $arrayParameters["firstname"], PDO::PARAM_STR);
        $response->bindValue("birthdate", $arrayParameters["birthdate"], PDO::PARAM_STR);
        $response->bindValue("phone", $arrayParameters["phone"], PDO::PARAM_STR);
        $response->bindValue("mail", $arrayParameters["mail"], PDO::PARAM_STR);
        return $response->execute();
    }
}








<?php

/**
 * Classe qui permet de créer des objets Patient à partir de la base de données
 * (Principe d'hydratation : https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1666289-manipulation-de-donnees-stockees)
 * Cette classe a besoin de la connexion à la base de données pour fonctionner
 */
class PatientManager
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database->getDb();
    }

    public function createPatientFile($lastname, $firstname, $birthdate, $phone, $mail)
    {
        $reponse = $this->db->prepare("INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)");
        $reponse->bindValue("lastname", $lastname, PDO::PARAM_STR);
        $reponse->bindValue("firstname", $firstname, PDO::PARAM_STR);
        $reponse->bindValue("birthdate", $birthdate, PDO::PARAM_STR);
        $reponse->bindValue("phone", $phone, PDO::PARAM_INT);
        $reponse->bindValue("mail", $mail, PDO::PARAM_STR);
        $reponse->execute();
    }
}

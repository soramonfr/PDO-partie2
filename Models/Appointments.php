<?php

/**
 * Classe Appointments qui correspond à la table appointments en bdd
 */
class Appointments
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database->getDb();
    }

    public function createPatientAppointment($arrayParameters)
    {
        $response = $this->db->prepare("INSERT INTO appointments (dateHour, idPatients) VALUES (:dateHour, :idPatients)");
        $response->bindValue("dateHour", $arrayParameters["dateHour"], PDO::PARAM_STR);
        $response->bindValue("idPatients", $arrayParameters["idPatients"], PDO::PARAM_INT);
        return $response->execute();
    }

    public function displayAppointmentsList() {
        $response = $this->db->query("SELECT appointments.* , patients.lastname , patients.firstname
        FROM appointments 
        INNER JOIN patients
            ON appointments.idPatients = patients.id");
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }
}
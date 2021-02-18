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

    public function displayAppointmentsList()
    {
        $response = $this->db->query("SELECT appointments.*, patients.lastname, patients.firstname 
        FROM appointments 
        INNER JOIN patients
            ON appointments.idPatients = patients.id 
            ORDER BY appointments.dateHour");
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function displayAppointmentDetails($id)
    {
        $response = $this->db->prepare("SELECT appointments.*, patients.lastname, patients.firstname, patients.birthdate, patients.mail, patients.phone
        FROM appointments 
        INNER JOIN patients
            ON appointments.idPatients = patients.id
        WHERE appointments.id = :id");
        $response->bindValue("id", $id, PDO::PARAM_INT);
        $response->execute();
        return $response->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePatientAppointment($arrayParameters)
    {
        $response = $this->db->prepare(
            "UPDATE appointments 
        SET dateHour = :dateHour
        WHERE id = :id"
        );
        $response->bindValue("id", $arrayParameters["id"], PDO::PARAM_INT);
        $response->bindValue("dateHour", $arrayParameters["dateHour"], PDO::PARAM_STR);
        return $response->execute();
    }
}

<?php
spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
});

$br = "<br>";
$database = new Database();
$patientManager = new Patients($database);
$appointmentManager = new Appointments($database);

$allPatients = $patientManager->displayPatientsForAppointments();
var_dump($allPatients);

// Filtrage des données potentiellement dangereuses
// htmlspecialchars() va permettre d’échapper certains caractères spéciaux comme les chevrons « < » et « > » en les transformant en entités HTML.
// trim() qui va supprimer les espaces inutiles et stripslashes() qui va supprimer les antislashes.
function cleanData($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

// S'il y a eu soumission de formulaire, génération des fonctions de validation
// Stack tip - Checking if form has been submitted:
// For general check if there was a POST action use:
//     if (!empty($_POST))
//     This method won't work for in some cases (e.g. with check boxes and button without a name). You really should use:
//     if ($_SERVER['REQUEST_METHOD'] == 'POST')

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    // Génération des regex
    // Pour la saisie d'un ID
    $regexId = "/^[0-9]+$/";

    // Pour la saisie d'une date au format YYYY-MM-DD
    $regexDate = "/^[1-2][0-9]{3}[-][0-1][0-9][-]([0-2][0-9]|[3][0-1])$/";;

    // Pour la saisie d'une heure au format HH:MM sur 24 heures
    $regexHour = "/^[0-2]{1}[0-9]{1}\:[0-5]{1}[0-9]{1}$/";

    // Initialisation du tableau d'erreurs
    $arrayErrors = [];


    // Application du premier filtre de sécurité
    $id = isset($_POST["idPatients"]) ? cleanData(intval($_POST["idPatients"])) : "";
    $date = isset($_POST["date"]) ? cleanData($_POST["date"]) : "";
    $hour = isset($_POST["hour"]) ? cleanData($_POST["hour"]) : "";

    // Application du second filtre de sécurité
    if (preg_match($regexId, $id)) {
        $verifiedId = intval($id);
    } else {
        $arrayErrors['idPatients'] = "Identifiant invalide.";
    }

    if (preg_match($regexDate, $date)) {
        $verifiedDate = $date;
    } else {
        $arrayErrors['date'] = "Veuillez saisir une date valide.";
    }

    if (preg_match($regexHour, $hour)) {
        $verifiedHour = $hour;
    } else {
        $arrayErrors['hour'] = "Veuillez saisir une heure valide.";
    }
    
    // Stockage des données saisies
    if (empty($arrayErrors)) {
        $dateHour = $verifiedDate . " " . $verifiedHour;
        $arrayParameters = [
            "idPatients" => $verifiedId,
            "dateHour" => $dateHour
        ];

        if ($appointmentManager->createPatientAppointment($arrayParameters)) {
            $status = "✅ La demande a été traitée avec succès.";
        } else {
            $status = "❌ Des erreurs sont survenues pendant le traitement de la demande, veuillez recommencer.";
        }       
    } else {
        $status = "❌ Veuillez compléter tous les champs avant de poursuivre.";
    }
}
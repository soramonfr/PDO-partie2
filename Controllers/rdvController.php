<?php
spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
});

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

$database = new Database();
$appointmentManager = new Appointments($database);

if (isset($_GET["idAppointment"])) {
    $idAppointment = cleanData($_GET["idAppointment"]);
    if (filter_var($idAppointment, FILTER_VALIDATE_INT)) {
        $profilAppointment = $appointmentManager->displayAppointmentDetails($idAppointment);
        $appointmentDetails = explode(" ", $profilAppointment["dateHour"]);
        $dateFormat = DateTime::createFromFormat('Y-m-d', $appointmentDetails[0]);
        $date = $dateFormat->format('Y-m-d');
        $hourFormat = DateTime::createFromFormat('H:i:s', $appointmentDetails[1]);
        $hour = $hourFormat->format('H:i');
        // var_dump($profilAppointment);
        // var_dump($date);
    } else {
        $arrayErrors["idAppointment"] = "Ce rendez-vous n'existe pas.";
    }
}

// S'il y a eu soumission de formulaire, génération des fonctions de validation
// Stack tip - Checking if form has been submitted:
// For general check if there was a POST action use:
//     if (!empty($_POST))
//     This method won't work for in some cases (e.g. with check boxes and button without a name). You really should use:
//     if ($_SERVER['REQUEST_METHOD'] == 'POST')

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialisation du tableau d'erreurs
    $arrayErrors = [];


    // Application du premier filtre de sécurité
    $id = isset($_POST["idAppointment"]) ? cleanData($_POST["idAppointment"]) : "";
    $date = isset($_POST["date"]) ? cleanData($_POST["date"]) : "";
    $hour = isset($_POST["hour"]) ? cleanData($_POST["hour"]) : "";

    // Application du second filtre de sécurité
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $verifiedId = $id;
    } else {
        $arrayErrors['id'] = "Identifiant invalide.";
    }

    $dateTime = date_create("$date $hour");
    if ($dateTime) {
        $verifiedDateHour = $dateTime;
    } else {
        $arrayErrors['dateHour'] = "Créneau invalide.";
    }

    // Stockage des données saisies
    if (empty($arrayErrors)) {
        $arrayParameters = [
            "id" => $verifiedId,
            "dateHour" => $verifiedDateHour->format("Y-m-d H:i:s")
        ];

        if ($appointmentManager->updatePatientAppointment($arrayParameters)) {
            $status = "✅ La demande a été traitée avec succès.";
            // Redirection vers la page du rendez-vous (cf. notion POST REDIRECT GET)
            // header("Location: " . $_SERVER['REQUEST_URI'] . "?idAppointment=$verifiedId", true, 303);
        } else {
            $status = "❌ Des erreurs sont survenues pendant le traitement de la demande, veuillez recommencer.";
        }
    } else {
        $status = "❌ Veuillez compléter tous les champs avant de poursuivre.";
    }
}

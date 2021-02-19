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
    // Application des filtres pour sécuriser la saisie et spliter la date pour plus de lisibilité
    $idAppointment = cleanData($_GET["idAppointment"]);
    if (filter_var($idAppointment, FILTER_VALIDATE_INT)) {
        $profilAppointment = $appointmentManager->displayAppointmentDetails($idAppointment);
        if ($profilAppointment === false) {
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/Views/error.php");
            exit;
        }
        $appointmentDetails = explode(" ", $profilAppointment["dateHour"]);
        $dateFormat = DateTime::createFromFormat('Y-m-d', $appointmentDetails[0]);
        $date = $dateFormat->format('Y-m-d');
        $hourFormat = DateTime::createFromFormat('H:i:s', $appointmentDetails[1]);
        $hour = $hourFormat->format('H:i');
    } else {
        $status = "Ce rendez-vous n'existe pas.";
        $host  = $_SERVER['HTTP_HOST'];
        header("Location: http://$host/Views/error.php");
        exit;
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
    // Verification de la saisie ID
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $verifiedId = $id;
    } else {
        $arrayErrors['id'] = "Identifiant invalide.";
    }

    // Vérification de la saisie date avec une fonction native mais aussi regroupement des données date& heure 
    // pour pouvoir exploiter l'entrée en BDD (accepte "Y-m-d H:i:s")
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
            // formatage de dateHour car le format retourné par $verifiedDateHour est "Y-m-d H:i:s:micro secondes"
            "dateHour" => $verifiedDateHour->format("Y-m-d H:i:s")
        ];

        if ($appointmentManager->updatePatientAppointment($arrayParameters)) {
            $status = "✅ La demande a été traitée avec succès.";
        } else {
            $status = "❌ Des erreurs sont survenues pendant le traitement de la demande, veuillez recommencer.";
        }
    } else {
        $status = "❌ Veuillez compléter tous les champs avant de poursuivre.";
    }
}

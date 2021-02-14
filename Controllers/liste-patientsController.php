<?php
spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
});

$br = "<br>";
$database = new Database();
$patientManager = new Patients($database);

$allPatients = $patientManager->displayPatientsList();

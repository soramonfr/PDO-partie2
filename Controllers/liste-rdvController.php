<?php
spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
});

$br = "<br>";
$database = new Database();
$appointmentManager = new Appointments($database);

$allAppointments = $appointmentManager->displayAppointmentsList();
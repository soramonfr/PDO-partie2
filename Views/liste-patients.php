<?php
require "../Controllers/liste-patientsController.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Affichage de la liste des patients</title>
</head>

<body>
    <h1 class="text-center">🔻 Liste des patients 🔻</h1>
    <p class="text-center font-weight-bold bg-info text-white">Pour créer une nouvelle entrée, c'est par <a href="../Views/ajout-patient.php">ici</a> !</p>
    <?php
    if (!$allPatients) {
        echo "Il y a eu un problème lors de la récupération des données des patients.";
    } else {
        foreach ($allPatients as $patient) {
            echo "<div>🔆 Nom & Prénom du patient : " . $patient["lastname"] . " " . $patient["firstname"] . $br
                . "<a href='/Views/profil-patient.php?idPatient=" . $patient["id"] . "'>Lien vers le profil du patient</a></div>" . $br;
        }
    }
    ?>
    <a href="../index.php" class="btn btn-primary">Retour à l'acceuil</a>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>
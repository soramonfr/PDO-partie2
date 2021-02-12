<?php
require "../Controllers/ajout-patientController.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Création d'une entrée patient</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">🔻 Création d'une entrée patient 🔻</h1>
        <p class="text-center">Veuillez renseigner tous les champs</p>
        <p class="text-info"><?= isset($status) ? $status : "" ?></p>
        <form action="ajout-patient.php" method="post" novalidate>
            <h2>🕵️‍♂️ Etat civil</h2>
            <fieldset>
                <div class="form-group">
                    <label for="name">Nom : </label> <span class="text-danger"><?= isset($arrayErrors['lastname']) ? $arrayErrors['lastname'] : "" ?></span>
                    <input class="form-control" required placeholder="Wonka" type="text" name="lastname">
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="firstname">Prénom : </label> <span class="text-danger"><?= isset($arrayErrors['firstname']) ? $arrayErrors['firstname'] : "" ?></span>
                    <input class="form-control" required placeholder="Willy" type="text" name="firstname">
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="birthdate">Date de naissance : </label> <span class="text-danger"><?= isset($arrayErrors['birthdate']) ? $arrayErrors['birthdate'] : "" ?></span>
                    <input class="form-control" type="date" name="birthdate" min="1900-01-01" max="2030-12-31">
                </div>
            </fieldset>

            <h2>💌 Coordonnées</h2>
            <fieldset>
                <div class="form-group">
                    <label for="email">E-mail : </label> <span class="text-danger"><?= isset($arrayErrors['email']) ? $arrayErrors['email'] : "" ?></span>
                    <input class="form-control" required placeholder="willy.wonka@chocolate.com" type="email" name="email">
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="phone">Téléphone : </label> <span class="text-danger"><?= isset($arrayErrors['phone']) ? $arrayErrors['phone'] : "" ?></span>
                    <input class="form-control" required placeholder="ex: 0666666666" type="tel" name="phone">
                </div>
            </fieldset>
            <button class="btn btn-success" name="submitAddPatient" type="submit">Ajouter le patient</button>
        </form>
        <a href="../index.php" class="btn btn-primary">Retour à l'acceuil</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>
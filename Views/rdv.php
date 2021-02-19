<?php
require "../Controllers/rdvController.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Profil du patient</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">🔻 Rendez-vous programmé pour le patient 🔻</h1>
        <p class="text-info"><?= isset($status) ? $status : "" ?></p>
        <form action="rdv.php?idAppointment=<?= $profilAppointment["id"] ?>" method="post" novalidate>
        <input name="idAppointment" type="hidden" value="<?= $profilAppointment["id"] ?>">
            <h2>🕵️‍♂️ Etat civil</h2>
            <fieldset>
                <div class="form-group">
                    <label for="name">Nom : </label> 
                    <input class="form-control" required placeholder="Wonka" type="text" name="lastname" value="<?= $profilAppointment["lastname"] ?>" readonly>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="firstname">Prénom : </label> 
                    <input class="form-control" required placeholder="Willy" type="text" name="firstname" value="<?= $profilAppointment["firstname"] ?>" readonly>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="birthdate">Date de naissance : </label> 
                    <input class="form-control" type="date" name="birthdate" min="1900-01-01" max="2030-12-31" value="<?= $profilAppointment["birthdate"] ?>" readonly>
                </div>
            </fieldset>

            <h2>💌 Coordonnées</h2>
            <fieldset>
                <div class="form-group">
                    <label for="mail">E-mail : </label>
                    <input class="form-control" required placeholder="willy.wonka@chocolate.com" type="mail" name="mail" value="<?= $profilAppointment["mail"] ?>" readonly>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="phone">Téléphone : </label>
                    <input class="form-control" required placeholder="ex: 0666666666" type="tel" name="phone" value="<?= $profilAppointment["phone"] ?>" readonly>
                </div>
            </fieldset>

            <h2>📅 Rendez-vous programmé</h2>
            <fieldset>
                <div class="form-group">
                    <label for="date">Date du rendez-vous : </label> <span class="text-danger"><?= isset($arrayErrors['dateHour']) ? $arrayErrors['dateHour'] : "" ?></span>
                    <input class="form-control" required type="date" name="date" value="<?= $date ?>">
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="hour">Heure du rendez-vous : </label> <span class="text-danger"><?= isset($arrayErrors['dateHour']) ? $arrayErrors['dateHour'] : "" ?></span>
                    <input class="form-control" required type="text" name="hour" value="<?= $hour ?>">
                </div>
            </fieldset>

            <button class="btn btn-success" name="submitModifyAppointment" type="submit">Modifier le rendez-vous</button>
        </form>
        <a href="../index.php" class="btn btn-primary">Retour à l'acceuil</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>
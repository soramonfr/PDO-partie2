<?php
require "../Controllers/ajout-rdvController.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un rendez-vous</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>


<body>
    <div class="container">
        <h1 class="text-center">🔻 Prendre un rendez-vous 🔻</h1>
        <p class="text-center">Veuillez renseigner tous les champs</p>
        <p class="text-info"><?= isset($status) ? $status : "" ?></p>

        <form action="ajout-rdv.php" method="post" novalidate>
            <fieldset>
                <div class="form-group">
                    <label for="idPatients">Identité du patient : </label> <span class="text-danger"><?= isset($arrayErrors['idPatients']) ? $arrayErrors['idPatients'] : "" ?></span>
                    <select name="idPatients" id="idPatients" required>
                        <option value="" selected disabled>Choisir un patient</option>
                        <?php
                        foreach ($allPatients as $patient) {
                        ?>
                            <option value="<?= $patient["id"] ?>"><?= strtoupper($patient["lastname"]) . " " . $patient["firstname"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="date">Date : </label> <span class="text-danger"><?= isset($arrayErrors['date']) ? $arrayErrors['date'] : "" ?></span>
                    <input class="form-control" required placeholder="Format YYYY-MM-DD" type="date" min="1900-01-01" max="2030-12-31" name="date">
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="hour">Heure : </label> <span class="text-danger"><?= isset($arrayErrors['hour']) ? $arrayErrors['hour'] : "" ?></span>
                    <input class="form-control" type="time" name="hour">
                </div>
            </fieldset>

            <button class="btn btn-success" name="submitCreateAppointment" type="submit">Prendre un rendez-vous</button>
        </form>
        <a href="../index.php" class="btn btn-primary">Retour à l'acceuil</a>
    </div>
    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>
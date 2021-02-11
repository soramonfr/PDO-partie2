<?php
spl_autoload_register(function ($class) {
    include 'models/' . $class . '.php';
});

$br = "<br>";

$database = new Database();
// $patient = new Patients();

// $pdo = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
// $id = 1;

// // pour la selection
// $reponse = $pdo->query("select * from patients where id = $id");
// $data = $reponse->fetch();
// var_dump($data);

// $requete= $pdo->prepare("select * from patients where id = :id");
// $requete->bindValue("id",$id,PDO::PARAM_INT);
// $requete->execute();
// $data = $requete->fetch();
// var_dump($data);


// // pour l'insertion
// $requete= $pdo->prepare("INSERT INTO patients (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastName, :firstName, :birthdate, :phone, :mail)");
// $requete->bindValue("lastName","Poulin",PDO::PARAM_STR);
// $requete->bindValue("firstName","Amelie",PDO::PARAM_STR);
// $requete->bindValue("birthdate","1970-01-01",PDO::PARAM_STR);
// $requete->bindValue("phone","0666666666",PDO::PARAM_STR);
// $requete->bindValue("mail","amelie.poulin@paris.fr",PDO::PARAM_STR);
// $ret_bool = $requete->execute();
// if ($ret_bool) {
//     echo "ça s'est bien passé";
// } else {
//     echo "ya eu des erreurs";
// }

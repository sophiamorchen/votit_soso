<?php


try {
    $pdo =new PDO('mysql:dbname='.BD_NAME.';host='.DB_HOST.';charset=utf8', DB_USER, DB_PASSWORD);
} catch(Exception $e) {
    die('Erreur ' .$e->getMessage());
}
// ce try & catch nous sert AUSSI dans un premier temps à vérifier qu'on est bien connecté à la BDD , sinon la page ne chargerait même pas.
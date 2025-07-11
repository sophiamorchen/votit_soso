<?php
function getPolls(PDO $pdo)
{
    $query = $pdo->prepare("SELECT * FROM poll");
    // $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    //fecth() nous permet de récécupérer une seule ligne
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
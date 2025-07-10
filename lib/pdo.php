<?php 


try {
    $pdo =new PDO();
} catch(Exception $e) {
    die('Erreur ' .$e->getMessage());
};
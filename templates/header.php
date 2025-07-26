<?php
require_once 'lib/config.php';
require_once 'lib/pdo.php';
// toujours appeler pdo après config, car pdo dépend de confif (cf : constantes)
$mainMenu = [
    'index.php' => 'Accueil',
    'sondages.php' => 'Les sondages',
];




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">
    <!--
    basename($_SERVER['SCRIPT_FILENAME']) nous donne la clé (ex. "index.php"),
    $mainMenu[...] nous renvoie la valeur associée à cette clé (ex. "Accueil").
    -->
    <title><?php
    if(isset($mainMenu[basename($_SERVER['SCRIPT_FILENAME'])])){
        echo $mainMenu[basename($_SERVER['SCRIPT_FILENAME'])].' - VotIt';
        }else {
        echo 'VotIt';
        }?>
    </title>

</head>

<body>


    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
            </div>
            <ul class="nav nav-pills">
                <?php foreach ($mainMenu as $page => $titre) {?>
                <li class="nav-item">
                    <a href="<?=$page; ?>"
                        class="nav-link <?php if( $page === basename($_SERVER['SCRIPT_NAME'])){ echo 'active';}?>"><?= $titre; ?></a>
                </li>
                <?php }?>
            </ul>

            <div class="col-md-3 text-end"> <button type="button" class="btn btn-outline-primary me-2">Login</button>
                <button type="button" class="btn btn-primary">Sign-up</button>
            </div>
        </header>

        <main>
<?php require_once 'templates/header.php';
require_once 'lib/poll.php';

$polls = getPolls($pdo);
var_dump($polls);

?>



<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="<?= PATH_ASSETS_IMG?>logo-votit.png" class="d-block mx-lg-auto img-fluid" alt="Logo votit" width="400"
            height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Votez sur l'actualité IT</h1>
        <p class="lead">Votit : là où la communauté tech s’exprime.
            Participez à des sondages sur le développement, l’IT et les meilleures pratiques DevOps.
            Donnez votre avis sur les frameworks front-end, les outils préférés des devs, et bien plus.
            Créez, partagez, analysez : nous vous offrons une plateforme pour explorer les tendances et enrichir les
            débats techniques. </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Voter</button>
            <button type="button" class="btn btn-outline-secondary btn-lg px-4">Voir tous les sondages</button>
        </div>
    </div>
</div>

<div class="row text-center">

    <h2>Les derniers sondages :</h2>
    <?php foreach($polls as $key=>$poll){
        require 'templates/poll_part.php';
    }?>

</div>




<?php require_once 'templates/footer.php'?>
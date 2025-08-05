<?php require_once 'lib/required_files.php';
require_once 'lib/poll.php';


$error_404 = false;

if (isset($_GET['id'])) {
    // /!\  type STRING à changer car méthode getPollById attend du INT cela s'appelle un "cast"
    $id = (int) $_GET['id'];
    // On veut dabord voir si le sondage existe avant d'appeler les résultats du sondage que nous voulons afficher sur la page.
    $poll = getPollById($pdo, $id);
    if ($poll) {
        $pageTitle = $poll['title'];
        $results = getPollResultsByPollId($pdo, $id);
        $totalUsers = getPollTotalUsersByPollId($pdo, $id);
    } else {
        $error_404 = true;
        // ou bien : header("Location: page.php");exit(); --> ⚠️ exit(); est fortement recommandé juste après pour éviter d’exécuter du code en trop.
    }

} else {
    $error_404 = true;
}


require_once 'templates/header.php';


if (!$error_404) {
    ?>
<div class="row align-items-center g-5 py-5">
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3"><?= $poll['title'] ?></h1>
        <p class="lead"><?= $poll['description'] ?>
        </p>
    </div>
    <div class="col-lg-6">
        <h2>Résultats</h2>
        <div class="results">
            <?php foreach ($results as $index => $result) {
                    if ($totalUsers) {
                        // calcul
                        $resultPercent = $result['votes'] / $totalUsers * 100;
                    } else {
                        $resultPercent = 0;
                    }
                    ?>
            <h3><?= $result['name'] ?> </h3>
            <div class="progress " role="progressbar" aria-label="<?= $result['name']; ?>"
                aria-valuenow="<?= $resultPercent; ?>" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-striped progress-color-<?= $index ?>"
                    style="width: <?= $resultPercent; ?>%">
                    <?= $result['name']; ?>
                    <?= round($resultPercent, 2); ?>%
                </div>
            </div>
            <?php } ?>


        </div>
    </div>
</div>
<?php } else {
    ?>
<h1>Ce sondage n'existe pas</h1>
<?php } ?>









<?php require_once 'templates/footer.php' ?>
<?php require_once 'templates/header.php';
require_once 'lib/poll.php';


$error_404 = false;

if (isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $poll = getPollById($pdo, $id);
    if($poll){
        
    } else {
        $error_404 = true;
        // ou bien : header("Location: page.php");exit(); --> ⚠️ exit(); est fortement recommandé juste après pour éviter d’exécuter du code en trop.
    }
    
} else {
    $error_404 = true;
}

if(!$error_404) {

?>

<div class="row align-items-center g-5 py-5">
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3"><?=$poll['title']?></h1>
        <p class="lead"><?=$poll['description']?>
        </p>
    </div>
    <div class="col-lg-6">
        <h2>Résultats</h2>
        <div class="results">
            <h3>Prop A</h3>
            <div class="progress " role="progressbar" aria-label="Example with label" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-striped progress-color-2" style="width: 25%">PROP 1: 25%</div>
            </div>
        </div>
    </div>

</div>
<?php } else {
    ?>
<h1>Ce sondage n'existe pas</h1>
<?php }?>









<?php require_once 'templates/footer.php'?>
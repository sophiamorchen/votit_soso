<?php 
require_once 'lib/required_files.php';
require_once 'lib/poll.php';
require_once 'lib/category.php';

if(empty($_SESSION['user'])){
    header('Location: login.php');
}

$categories = getCategories($pdo);

if(isset($_POST['savePoll'])){
    $res = savePoll($pdo, $_POST['title'], $_POST['description'] , $_POST['category_id'], $_SESSION['user']['id']);
    if($res){
        // maintenant $res contient l'id du dernier sondage enregistré. cf: return $pdo->return lastInsterId()
        header('Location: ajout_modification_sondage.php?id='.$res);
    } else {
        $pollError = "Le sondage n'a pas été sauvegardé";
    }
}

if(isset($_GET['id'])){
    $poll = getPollById($pdo, $_GET['id']);
}
require_once 'templates/header.php';

?>


<h1>Sondage</h1>
<form method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="<?= $poll['title']?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?= $poll['description']?></textarea>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Catégorie</label>
        <select name="category_id" id="category_id" class="form-select">
            <?php foreach($categories as $category) {?>
            <option <?php if ($category['id'] && $poll['category_id']) { echo 'selected="selected"'; } ?>value="<?= $category['id']?>"><?= $category['name']?></option>
            <?php }?>
        </select>
    </div>
    <div class="mb-3">
        <input type="submit" value="enregistrer" name="savePoll" class="btn btn-primary">
    </div>
</form>

<?php if(!isset($_GET['id'])){?>
    <div class="alert alert-warning" role="alert">
        Après avoir enregistré votre sondage, vous pourrez ajouter les options
    </div>
<?php }?>


<?php require_once 'templates/footer.php';?>
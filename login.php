<?php require_once 'lib/required_files.php';

require_once 'lib/user.php';
require_once 'templates/header.php';


$errors = [];


if (isset($_POST['loginUser'])) {
    $user = verifyUserLoginAndPassword($pdo, $_POST['email'], $_POST['password']);

    if ($user) {
        // on veut connecter l'utilisateur

        // Changemt de session après la co : empêche qu’un pirate utilise un ID de session fixé avant la connexion de l’utilisateur = protège contre l’attaque de fixation de session.
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        header('location: index.php');

    } else {
        // erreur
        $errors[] = 'Les identifiants sont incorrects';
    }
}
?>
<h1>Connexion</h1>

<?php foreach ($errors as $error) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>
<?php } ?>


<form method="POST">
    <div class="mb-3">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <input type="submit" name="loginUser" class="btn btn-primary" value="Enregistrer">
    </div>
</form>


<?php require_once 'templates/footer.php' ?>
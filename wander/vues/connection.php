<?php

require_once "vues.php";
require_once "../modele/userModele.php";
require_once "../controller/connectController.php";


session_start();

if (!empty($_SESSION['name']))
{
    header("Location: profile");
}

function pushFormToController()
{
    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
    {
        $controller = new Connection();
        $controller->setEmail($_POST["email"]);
        $controller->setPassword($_POST["password"]);
        return ($controller);
    }
    else
    {
        return "Certains champs sont vides";
    }
}


function pushControllerModele($controller)
{
    if (!is_string($controller))
    {
        $modele = new RegisterModele();

        if ($modele->connect($controller->getEmail(), $controller->getPassword()) != false)
            return (true);
        else
            return ($modele->getErreur());
    }
    else
        return ($controller);
}

if (!isset($_SESSION['name']))
{
    $connectController = pushFormToController();
    $erreur = pushControllerModele($connectController);
    
    if ($erreur == true && !is_string($erreur))
    {
        $success = 'vous êtes connecté';
        header("Location: profile");
    }
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection - Wander</title>
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <?php
    $vues = new Vues();
    $vues->showNavbar();
    ?>




    <div class="container-formulaire">
        <div class="formulaire connection">
            <p class='formulaire-text'>Connection</p>
            <form method="post" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email.</small>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <?php
                if (isset($erreur) && is_string($erreur))
                    echo "<div class='alert alert-danger' role='alert'>".$erreur."</div>";
                if (isset($success) && is_string($success))
                    echo "<div class='alert alert-success' role='alert'>".$success."</div>";
                ?>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
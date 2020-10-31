<?php

require_once "vues.php";
require_once "../modele/userModele.php";
require_once "../controller/userController.php";



session_start();

$vues = new Vues();

if (empty($_SESSION['id']))
    header("Location: connection");

function pushDataController($data)
{
    $userController = new UserController();

    foreach ($data as $key => $value)
    {
        if ($key != 'id' && $key != 'password' && $key != 'confirm')
        {
            $property = "set".ucfirst($key);
            if ($userController->$property($value))
                $userController->$property($value);
            else
                return ($userController->getErreur());
        }
        if ($key == 'password')
        {
            if ($userController->setPassword($data['password'], $data['confirm']))
                $userController->setPassword($data['password'], $data['confirm']);
            else
                return ($userController->getErreur());
        }
    }
    return ($userController);
}




function updateUser($userController)
{
    if (is_object($userController) && !empty($_SESSION['id']))
    {
        $registerModele = new RegisterModele();
        foreach ($_POST as $key => $value)
        {
            if ($key != 'id' && $key != 'confirm')
            {
                $propertyController = 'get'.ucfirst($key);
                $propertyModele = 'update'.ucfirst($key);
                
                if ($registerModele->$propertyModele($userController->$propertyController(), $_SESSION['id']))
                    continue;
                else
                    return ($registerModele->getErreur());
            }
        }
        return (1);
    }
    else
    {
        return ($userController);
    }
}

$controller = pushDataController($_POST);
$erreur = updateUser($controller);

if ($erreur == 1)
{
    $success = "Votre profil à été actualisé";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Wander</title>
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/discover.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <?php
    $vues->showNavbar();
    ?>


    <div class='container-formulaire'>
            <div>
                <p class='formulaire-text'>Bienvenue sur votre profil</p>
                <form method='post' action=''>
                    <div class='form-row'>
                        <div class='form-group col-md-6'>
                            <label for='name'>Prénom</label>
                            <input type='text' class='form-control' id='name' name='name' value='<?php if (isset($_SESSION['name'])) echo $_SESSION['name']?>'>
                        </div>
                        <div class='form-group col-md-6'>
                            <label for='username'>Nom d'utilisateur</label>
                            <input type='text' class='form-control' id='username' name='username' value='<?php if (isset($_SESSION['username'])) echo $_SESSION['username']?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input type='email' class='form-control' id='email' placeholder='email@example.com' name='email' value='<?php if (isset($_SESSION['email'])) echo $_SESSION['email']?>'>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-md-6'>
                            <label for='age'>Age</label>
                            <input type='text' class='form-control' id='age' placeholder='18' name='age' value='<?php if (isset($_SESSION['age'])) echo $_SESSION['age']?>'>
                        </div>
                        <div class='form-group col-md-6'>
                            <label for='ville'>Ville</label>
                            <input type='text' class='form-control' id='ville' placeholder='Paris' name='ville' value='<?php if (isset($_SESSION['ville'])) echo $_SESSION['ville']?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='password'>Mot de passe</label>
                        <input type='password' class='form-control' id='password' placeholder='bIbI124823!' name='password'>
                    </div>
                    <div class='form-group'>
                        <label for='passwordconfirm'>Confirmer mot de passe</label>
                        <input type='password' class='form-control' id='passwordconfirm' placeholder='bIbI124823!' name='confirm'>
                    </div>
                    <?php
                    if (isset($erreur) && is_string($erreur))
                        echo "<div class='alert alert-danger' role='alert'>".$erreur."</div>";
                    if (isset($success))
                        echo "<div class='alert alert-success' role='alert'>".$success."</div>";
                    ?>
                    <button type='submit' class='btn btn-primary'>Update</button>
                </form>
            </div>
            <div class="container-profile">
                <div class="follow">
                    <div>
                            <?php $vues->showFollower($_SESSION['id']); ?>
                    </div>
                    <div>
                            <?php $vues->showFollowing($_SESSION['id']); ?>
                    </div>
                </div>
            </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
<?php
require_once "vues.php";
require_once "../modele/userModele.php";


session_start();

if (empty($_SESSION['id']))
    header("Location: connection");
if (!empty($_GET['follow']) && !empty($_SESSION['id']))
{
    $followModele = new RegisterModele();
    if ($followModele->insertFollowId($_SESSION['id'], $_GET['follow']))
        $success = "suivi";
    else
        $erreur = $followModele->getErreur();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover - Wander</title>
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/discover.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <script src="./js/discover.js" crossorigin="anonymous"></script>
    <script src="./js/progress-bar.js" crossorigin="anonymous"></script>

    <?php
    $vues = new Vues();
    $vues->showNavbar();
    ?>


    <h1>Discover profiles</h1>
    <div class="discover">
        <?php
        $modele = new RegisterModele();
        $tab = $modele->selectUsers($_SESSION['id']);

        foreach ($tab as $values)
        {
            if ($modele->selectFollowId($_SESSION['id'], $values['id']))
            {
                echo "<div class='profile'>".$values['name'].
                "<br><a href='profileFriend?id=".$values['id']."&name=".$values['name']."&username=".$values['username']."&email=".$values['email']."&age=".$values['age']."&ville=".$values['ville']."&level=".$values['level']."'>".$values['username']."</a>
                <br>".$values['age'].
                "<br>
                <form action='discover' method='get'>
                    <button type='submit' class='btn btn-primary' name='follow' value='".$values['id']."'>Suivre</button>
                </form>
                </div>";
            }
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
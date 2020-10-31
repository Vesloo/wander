<?php
require_once "vues.php";
require_once "../modele/userModele.php";



session_start();

if (empty($_SESSION['id']))
    header("Location: connection");
if (!empty($_GET['delete']) && !empty($_SESSION['id']))
{
    $deleteModele = new RegisterModele();
    $deleteModele->deleteFriend($_SESSION['id'], $_GET['delete']);
}
if (!empty($_GET['deleteFollower']) && !empty($_SESSION['id']))
{
    $deleteModele = new RegisterModele();
    $deleteModele->deleteFriend($_GET['deleteFollower'], $_SESSION['id']);
}
$vues = new Vues();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends - Wander</title>

    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/friends.css">
    <link rel="stylesheet" href="./css/discover.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <?php
    $vues->showNavbar();
    ?>

    <div class="container-formulaire">
        <h1>Followers / Following</h1>
        <div class="follow">
            <div>
                <?php $vues->showFollowing($_SESSION['id']); ?>
            </div>
            <div>
                <?php $vues->showFollower($_SESSION['id']); ?>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
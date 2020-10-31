<?php

require_once "../modele/userModele.php";


class Vues extends RegisterModele
{
    public function showNavbar()
    {
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <a class='navbar-brand' href='./index'>Wander</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        
        <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
            <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>";
                if (!isset($_SESSION['name'])) echo "<li class='nav-item'>
                    <a class='nav-link crush' href='./register'>Register</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link crush' href='./connection'>Connection</a>
                    </li>";
                else
                    echo "<li class='nav-item'>
                    <a class='nav-link profiles' href='./profile'>Profile</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link discover' href='./discover'>Discover</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link crush' href='./crush'>Friends</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link crush' href='./deconnection'>Deconnection</a>
                    </li>
                    <li class='nav-item'>
                    <div id='progress-bar'>
                        <p class='level'>Level ".$_SESSION['level']."</p>
                        <div></div>
                    </div>
                    </li>
                    ";
            echo "</ul>
                    </div>
                </nav>";
    }

    public function showFollowing($profileId)
    {
        if ($this->checkGet() || $profileId == $_SESSION['id'])
        {
            echo "<p>Following</p>
            <div class='follower'>";
            $tab = parent::selectUsers($profileId);
            $i = 0;
            foreach ($tab as $values)
            {
                if (!parent::selectFollowId($profileId, $tab[$i]['id']))
                {
                    echo "<div class='profile'>".$values['name'].
                    "<br><a href='profileFriend?id=".$values['id']."&name=".$values['name']."&username=".$values['username']."&email=".$values['email']."&age=".$values['age']."&ville=".$values['ville']."&level=".$values['level']."'>".$values['username']."</a>
                    <br>".$values['age'].
                    "<br></div>";
                }
                $i++;
            }
            echo "</div>";
        }
        else
            echo "<div class='alert alert-danger' role='alert'>Erreur lors du chargement du profil</div>";
    }

    public function showFollower($profileId)
    {
        if ($this->checkGet() || $profileId == $_SESSION['id'])
        {
            echo "<p>Followers</p>
            <div class='follower'>";
            $tab = parent::selectUsers($profileId);
            $i = 0;
            foreach ($tab as $values)
            {
                if (!parent::selectFollowId($tab[$i]['id'], $profileId))
                {
                    echo "<div class='profile'>".$values['name'].
                    "<br><a href='profileFriend?id=".$values['id']."&name=".$values['name']."&username=".$values['username']."&email=".$values['email']."&age=".$values['age']."&ville=".$values['ville']."&level=".$values['level']."'>".$values['username']."</a>
                    <br>".$values['age'].
                    "<br></div>";
                }
                $i++;
            }
            echo "</div>";
        }
        else
            echo "<div class='alert alert-danger' role='alert'>Erreur lors du chargement du profil</div>";
    }

    public function showFriendProfile()
    {
        if ($this->checkGet())
        {
            echo "<div class='friend-profile'>
            <div class='unique-profil'>
                <p class='formulaire-text'>Profil publique de ".$_GET['name']."</p>
                <div>
                    <p class='profileName'>Nom: ".$_GET['name']."</p>
                    <p class='profileName'>Pseudo: ".$_GET['username']."</p>
                </div>
                <div>
                    <p class='profileName'>Email: ".$_GET['email']."</p>
                    <p class='profileName'>Age: ".$_GET['age']."</p>
                </div>
                <div>
                    <p class='profileName'>Ville: ".$_GET['ville']."</p>
                    <p class='profileName'>Level: ".$_GET['level']."</p>
                </div>
            </div>
        </div>";
        }
        else
            echo "<div class='alert alert-danger' role='alert'>Erreur lors du chargement du profil</div>";
        
    }

    public function checkGet()
    {
        if (empty($_GET['id']) || empty($_GET['name']) || empty($_GET['username']) || empty($_GET['email']) || empty($_GET['age']) || empty($_GET['ville']))
            return (false);
        return (true);
    }
}
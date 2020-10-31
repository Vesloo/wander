<?php
include "bdd.php";

class RegisterModele extends Bdd
{
    private $erreur;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertFollowId($profileId, $friendId)
    {
        if ($this->selectFollowId($profileId, $friendId))
        {
            $result = $this->bdd->prepare("INSERT INTO follow (id_friend, id_profile) VALUES (?, ?)");
            $result->execute([$friendId, $profileId]);
            return (true);
        }
    }

    public function selectFollowId($profileId, $friendId)
    {
        $select = $this->bdd->prepare("SELECT * FROM follow WHERE id_friend!=?");
        $select->execute([$profileId]);
        $tab = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tab as $values)
        {
            if ($values['id_friend'] == $friendId && $values['id_profile'] == $profileId)
            {
                $this->erreur = "Vous avez déjà suivi cette personne";
                return (false);
            }
        }
        return (true);
    }

    public function deleteFriend($profileId, $friendId)
    {
        if ($this->selectFollowId($profileId, $friendId) == false)
        {
            $result = $this->bdd->prepare("DELETE FROM follow WHERE id_friend=? AND id_profile=?");
            $result->execute([$friendId, $profileId]);
        }
    }

    public function register($name, $username, $email, $password, $age, $ville)
    {
        $select = $this->bdd->prepare("SELECT * FROM user");
        $select->execute();
        $tab = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tab as $value)
        {
            foreach ($value as $key => $value)
            {
                if ($key == 'email' && $value == $email)
                {
                    $this->erreur = "L'email est déjà présent en base de donnée";
                    return (false);
                }
                if ($key == 'username' && $value == $username)
                {
                    $this->erreur = "Le nom d'utilisateur est déjà utilisé";
                    return (false);
                }
            }
        }

        $result = $this->bdd->prepare("INSERT INTO user (name, username, email, password, age, ville) VALUES (?, ?, ?, ?, ?, ?)");
        $result->execute([$name, $username, $email, $password, $age, $ville]);
        return (true);
    }

    public function connect($email, $password)
    {
        $select = $this->bdd->prepare("SELECT * FROM user");
        $select->execute();
        $tab = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tab as $values)
        {
            if ($values["email"] == $email)
            {
                if (password_verify($password, $values["password"]) == true)
                {
                    session_start();
                    $_SESSION['id'] = $values['id'];
                    $_SESSION["name"] = $values["name"];
                    $_SESSION["username"] = $values["username"];
                    $_SESSION["email"] = $values["email"];
                    $_SESSION["age"] = $values['age'];
                    $_SESSION['ville'] = $values['ville'];
                    $_SESSION['level'] = $values['level'];
                    return (true);
                }    
            }
        }
        $this->erreur = "L'email ou le mot de passe est invalide";
        return (false);
    }

    public function updateName($name, $id)
    {
        $query = $this->bdd->prepare("UPDATE user SET name=? WHERE id=?");
        $query->execute([$name, $id]);

        $_SESSION['name'] = $name;
        return (true);
    }

    public function updateUsername($username, $id)
    {
        $select = $this->bdd->prepare("SELECT id, username FROM user");
        $select->execute();
        $tab = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tab as $values)
        {
            if ($values['username'] == $username && $values['id'] != $id)
            {
                $this->erreur = "Ce nom d'utilisateur est déjà présent en base de donnée";
                return (false);
            }
        }

        $query = $this->bdd->prepare("UPDATE user SET username=? WHERE id=?");
        $query->execute([$username, $id]);

        $_SESSION['username'] = $username;
        return (true);
    }

    public function updateEmail($email, $id)
    {
        $select = $this->bdd->prepare("SELECT id, email FROM user");
        $select->execute();
        $tab = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tab as $values)
        {
            if ($values['email'] == $email && $values['id'] != $id)
            {
                $this->erreur = "Cet email est déjà présent en base de donnée";
                return (false);
            }
        }

        $query = $this->bdd->prepare("UPDATE user SET email=? WHERE id=?");
        $query->execute([$email, $id]);

        $_SESSION['email'] = $email;
        return (true);
    }

    public function updatePassword($password, $id)
    {
        $query = $this->bdd->prepare("UPDATE user SET password=? WHERE id=?");
        $query->execute([$password, $id]);

        return (true);
    }

    public function updateAge($age, $id)
    {
        $query = $this->bdd->prepare("UPDATE user SET age=? WHERE id=?");
        $query->execute([$age, $id]);

        $_SESSION['age'] = $age;
        return (true);
    }

    public function updateVille($ville, $id)
    {
        $query = $this->bdd->prepare("UPDATE user SET ville=? WHERE id=?");
        $query->execute([$ville, $id]);

        $_SESSION['ville'] = $ville;
        return (true);
    }

    public function selectUsers($id)
    {
        $result = $this->bdd->prepare("SELECT * FROM user WHERE id!=?");
        $result->execute([$id]);
        $tab = $result->fetchAll(PDO::FETCH_ASSOC);
        return ($tab);
    }

    public function getErreur()
    {
        return ($this->erreur);
    }
}
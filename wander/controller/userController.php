<?php

class UserController
{
    private $name;

    private $username;

    private $email;

    private $password;

    private $age;

    private $ville;

    private $level;

    private $erreur;

    public function getName()
    {
        return ($this->name);
    }

    public function setName($name)
    {
        if (!empty($name) && strlen($name) >= 2 && strlen($name) <= 15 && preg_match("/[a-zA-Z0-9]+/", $name))
        {
            $this->name = htmlspecialchars($name);
            return (true);
        }
        else
        {
            $this->erreur = "Le nom doit comporter 4 caractères minimum de a à z et de 0 à 9";
            return (false);
        }
    }

    public function getUsername()
    {
        return ($this->username);
    }

    public function setUsername($username)
    {
        if (!empty($username) && strlen($username) >= 4 && strlen($username) <= 15 && preg_match("/[a-zA-Z0-9]+/", $username))
        {
            $this->username = htmlspecialchars($username);
            return (true);
        }
        else
        {
            $this->erreur = "Le surnom doit comporter 4 caractères minimum de a à z et de 0 à 9";
            return (false);
        }
    }

    public function getEmail()
    {
        return ($this->email);
    }

    public function setEmail($email)
    {
        if (preg_match("/[a-z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?(?:\.[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?)/", strtolower($email)))
        {
            $this->email = htmlspecialchars($email);
            return (true);
        }
        else
        {
            $this->erreur = "Votre email n'est pas valide.";
            return (false);
        }
    }

    public function getAge()
    {
        return ($this->age);
    }

    public function setAge($age)
    {
        if ($age > 13 && preg_match("/[0-9]+/", $age) && !empty($age))
        {
            $this->age = htmlspecialchars($age);
            return (true);
        }
        else
        {
            $this->erreur = "l'age ne correspond pas aux critères demandés";
            return (false);
        }
            
    }

    public function getVille()
    {
        return ($this->ville);
    }

    public function setVille($ville)
    {
        if (!empty($ville) && preg_match("/[a-zA-Z-]+/", $ville))
        {
            $this->ville = htmlspecialchars($ville);
            return (true);
        }
        else
        {
            $this->erreur = "La ville ne doit comprendre que des lettres.";
            return (false);
        }
            
    }

    public function getLevel()
    {
        return ($this->level);
    }

    public function setLevel($level)
    {
        if($level >= 1)
        {
            $this->level = htmlspecialchars($level);
            return (true);
        }
        else
        {
            $this->erreur = "Votre level n'est pas convenable.";
            return (false);
        }
            
    }

    public function getErreur()
    {
        return ($this->erreur);
    }

    public function getPassword()
    {
        return ($this->password);
    }

    public function setPassword($password, $confirm)
    {
        if ($password == $confirm)
        {
            if (strlen($password) >= 8 && strlen($password) <= 25 && preg_match("/^\S*(?=\S{8,25})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password))
            {
                $this->password = htmlspecialchars(password_hash($password, PASSWORD_DEFAULT));
                return (true);
            }
            else
            {
                $this->erreur = "Votre mot de passe doit contenir au moins 1 lettre majuscule, 1 chiffre et 1 lettre minuscule";
                return (false);
            }
        }
        else
        {
            $this->erreur = "Les 2 mots de passes doivent être identiques";
            return (false);
        }
    }
}
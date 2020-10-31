<?php

class Connection
{
    private $email;

    private $password;

    public function getEmail()
    {
        return ($this->email);
    }

    public function setEmail($email)
    {
        $this->email = htmlspecialchars($email);
    }

    public function getPassword()
    {
        return ($this->password);
    }

    public function setPassword($password)
    {
        $this->password = htmlspecialchars($password);
    }
}
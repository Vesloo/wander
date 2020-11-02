<?php
require_once "bdd.php";

class PostModele extends Bdd
{
    private $id_user;

    private $content;

    private $date;

    public function __construct()
    {
        parent::__construct();
    }

    public function post($user_id, $content, $date)
    {
        $query = $this->bdd->prepare("INSERT INTO post (id_user, content, date) VALUES (?, ?, ?)");
        $query->execute([$user_id, $content, $date]);
    }
    
    public function selectPostByUser()
    {
        $select = $this->bdd->prepare("SELECT * FROM post WHERE id_profile=?");
        $select->execute([$this->profileId]);
        $tab = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tab as $values)
        {
            echo "<div class='post'><p>".$values['content']."</p>".$values['date']."</div>";
        }
    }
}
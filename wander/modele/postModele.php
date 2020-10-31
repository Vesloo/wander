<?php
require_once "bdd.php";

class PostModele extends Bdd
{
    private $content;

    private $date;

    public function __construct()
    {
        parent::__construct();
    }

    public function post($content, $date)
    {
        $query = $this->bdd->prepare("INSERT INTO post (content, date) VALUES (?, ?)");
        $query->execute();
    }
    
    public function selectPost($profileId)
    {
        $select = $this->bdd->prepare("SELECT * FROM post WHERE id_profile=?");
        $select->execute([$profileId]);
        $tab = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tab as $values)
        {
            echo "<div class='post'><p>".$values['content']."</p>".$values['date']."</div>";
        }
    }
}
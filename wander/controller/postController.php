<?php

class PostController
{
    private $content;

    private $date;

    public function getContent()
    {
        return ($this->content);
    }

    public function setContent($content)
    {
        if (strlen($content) <= 500)
            $this->content = htmlspecialchars($content);
    }

    public function getDate()
    {
        return ($this->date);
    }

    public function setDate($date)
    {
        $this->date = htmlspecialchars($date);
    }
}
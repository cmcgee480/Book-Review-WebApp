<?php

class Book
{

    public $title;
    public $authorID;
    public $genreID;
    public $summary;
    public $url;




    public function __construct(string $title, int $authorID, int $genreID, string $summary,string $url)
    {

        $this->title = $title;
        $this->authorID = $authorID;
        $this->genreID = $genreID;
        $this->summary = $summary;
        $this->url = $url;
    }


}

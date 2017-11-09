<?php
namespace src\entities;

class Seo
{
    public $seo_title;
    public $seo_desc;
    public $seo_keys;

    public function __construct($title, $description, $keywords)
    {
        $this->seo_title = $title;
        $this->seo_desc = $description;
        $this->seo_keys = $keywords;
    }
}
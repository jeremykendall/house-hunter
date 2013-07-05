<?php

namespace HH\Document;

class Listing
{
    /**
     * @var string Url of listing
     */
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }
}

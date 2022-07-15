<?php
require_once('Cities/CityCreation.php');

class RestApiActions
{

    /**
     * RestApiActions constructor.
     */
    public function __construct()
    {
        new CityCreation();
    }
}
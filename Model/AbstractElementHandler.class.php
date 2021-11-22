<?php

abstract class AbstractElementHandler
{

    protected $baseLocationFolder;

    public function __construct()
    {
        $this->baseLocationFolder = BASE_FOLDER_LOCATION . "/" . BASE_FOLDER_NAME;
    }
}

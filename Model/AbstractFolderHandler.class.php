<?php

abstract class AbstractFolderHandler extends AbstractElementHandler
{

    protected $baseLocationFolder;

    public function __construct()
    {
        parent::__construct();
    }

    abstract public function create();

    abstract public function getData($folder);

    
}

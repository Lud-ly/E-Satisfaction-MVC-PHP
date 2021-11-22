<?php

abstract class AbstractFileHandler extends AbstractElementHandler
{

    abstract public function create($fileName);

    abstract public function save($data);
}

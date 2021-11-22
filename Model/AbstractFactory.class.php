<?php

abstract class AbstractFactory
{
    abstract public function createInstance($className, $arguments = array());
}
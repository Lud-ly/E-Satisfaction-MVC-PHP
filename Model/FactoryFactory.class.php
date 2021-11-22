<?php

class FactoryFactory extends AbstractFactory
{
    public function createInstance($className, $arguments = array())
    {
        $newInstance = null;
        $className = "Factory" . ucfirst($className);
        switch ($className) {
            case "FactoryController":
                break;
            default:
                throw new Exception("Unknown class : $className");
                break;
        }
        $newInstance = new $className(...$arguments);
        return $newInstance;
    }
}

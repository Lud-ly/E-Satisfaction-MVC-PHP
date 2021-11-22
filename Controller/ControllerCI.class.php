<?php

/**
 * Classe ControllerCI
 */
class ControllerCI extends BaseController
{
    /**
     * Permet le déployemment
     * sur serveur 
     * 
     * @return void
     */
    public function deploy(): void
    {
        exec('git add .');
        exec('git stash');
        exec('git pull');
    }
}

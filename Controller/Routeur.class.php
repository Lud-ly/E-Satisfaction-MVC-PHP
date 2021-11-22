<?php
class Routeur
{
    function __construct($factoryControleur){
        $this->factoryControleur = $factoryControleur;
    }
    /**
     * Effectue les redirections
     *
     * @return void
     */
    public function routeurRequete(): void
    {
        new MiddleWareRoles();
        $nomControleur = $_GET['route'] ?? null;
        $nomMethode = $_GET['action'] ?? null;
        if (!isset($nomControleur) || !isset($nomMethode)) {
            $nomControleur = 'Survey';
            $nomMethode = 'index';
        }
        $controleur = $this->factoryControleur->createInstance($nomControleur);
        $controleur->$nomMethode();
       
    }
}

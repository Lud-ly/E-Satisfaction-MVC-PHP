<?php
/**
 * Classe MiddleWareRoles
 */
class MiddleWareRoles
{
    /**
     * Constructeur de la classe
     */
    function __construct(){
        $this->nomPermission = $_GET['route']."/".$_GET['action'];
        $this->authorizationToTheRessource();
    }
    
    /**
     * Vérifie si la route à l'autorisation
     * d'accéder à la ressource 
     * 
     * @return void
     */
    private function authorizationToTheRessource(): void{
        $gestionPermission = new PermissionsAndRoleHandler;
        $ifPermissionExist = $gestionPermission->checkIfPermissionIsAllowed($this->nomPermission);
        if ($this->nomPermission != '/') {
            if (!$ifPermissionExist) {
                throw new Exception("Ressource Interdite : ".$this->nomPermission);
            }
        }
    }
}
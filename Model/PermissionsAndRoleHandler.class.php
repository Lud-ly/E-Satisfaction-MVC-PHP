<?php

/**
 * Classe PermissionsAndRoleHandler
 */
class PermissionsAndRoleHandler
{
    /**
     * Constructeur de la classe
     */
    function __construct()
    {
        $this->permissions = $_SESSION['dataUserAffluence']['idRole']['idPermissions'] ?? [];
        $this->permissions = array_merge($this->permissions, PERMISSIONS_PUBLIC);
    }
    /**
     * Permet la vérification d'une permission
     * 
     * @param string $nomPermission
     * @return bool
     */
    public function checkIfPermissionIsAllowed(string $nomPermission): bool
    {
        return UtilsArray::searchIfASpecificValueExistInAnArray($nomPermission, $this->permissions, 'name');
    }
}

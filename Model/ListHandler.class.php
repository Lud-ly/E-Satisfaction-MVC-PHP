<?php
//Classe ListHandler      
class ListHandler
{
    /**
     * Constructeur de la classe
     */
    function __construct(){
        $this->modelRequest = new ModelRequest;
    }
    /**
     * Recupère les idComptes et les saves dans la session
     */
    public function getAccountList($dataUser){
        $mainAccountUuid[] = $dataUser['dataUserLoginApps']['uuid'];
        $underAccountsUuid = UtilsArray::getDataInMultidimensionalArrayBySpecificKey($dataUser['dataUserLoginApps']['users'], 'uuid');
        $uuids = array_merge($mainAccountUuid, $underAccountsUuid);
        $comptes = $this->modelRequest->getAccountsByUuid($uuids);    
        return UtilsArray::getDataInMultidimensionalArrayBySpecificKey($comptes, 'idUsers');      
    }
}
?>
<?php
/**
 * Classe CheckingAccountHandler
 */
class CheckingAccountHandler implements InterfaceCheckingAccountHandler
{
    /**
     * Constrcuteur de la classe
     */
    function __construct(){
        $this->modelRequest = new ModelRequest();
    }
    /**
     * Verifie si le compte loginApps existe
     * dans la bdd. Si oui on récupère l'id Compte.
     * Sinon on le creer.
     * 
     * @return
     */
    public function addAccountIfNotExist($dataUser) {
        $uuid = $dataUser['dataUserLoginApps']['uuid'];
        $compte = $this->checkUuidOnDataBase($uuid);
        if (!$compte) {
            $data = [
                'idAuthentication' => $uuid,
                'idRole' => $dataUser['dataUserLoginApps']['role']['id']
            ];
            $this->modelRequest->addAccount($data);
        }
        return $uuid;
    }
    /**
     * Récupère l'uuid dans la bdd
     * 
     * @param string $uuid
     * @return array
     */
    private function checkUuidOnDataBase(string $uuid): array {
        return $this->modelRequest->getAccountsByUuid($uuid);
    }
}
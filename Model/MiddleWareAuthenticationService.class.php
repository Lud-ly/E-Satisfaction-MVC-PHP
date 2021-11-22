<?php

/**
 * Classe MiddleWareAuthenticationService
 */
class MiddleWareAuthenticationService
{
    public $classRequest;
    public $checkingAccountHandler;
    /** 
     * Constructeur de la classe
     */
    function __construct($classRequest)
    {
        $this->checkingAccountHandler = new CheckingAccountHandler();
        $this->listHandler = new ListHandler();
        $this->modelRequest = new ModelRequest();
        $this->requeteApi = $classRequest;
        
    }
    /**
     * Fonction main.
     * Execute les instructions
     * à la suite. 
     * 
     * @return void
     */
    public function main(): void
    {
        $ifPublicRouteExist = $this->checkIfPublicRoutes();
        if (!$ifPublicRouteExist) {
            try {
                $this->checkUrlToProcessLoginApps();
                $this->getDataToProcessLoginApps();
            } catch (\Exception $e) {
                log::addLog($e);
                $this->errorProcessLoginApps();
            }
        }
    }
    /**
     * Vérifie l'url
     */
    private function checkUrlToProcessLoginApps()
    {
        if (isset($_GET['t']) && !isset($_SESSION['tokenSession']) || $_SESSION['tokenSession'] === null) {

            $_SESSION['tokenSession'] = $_GET['t'] ?? null;
            if ($_GET['t'] ==  null) {
                throw new Exception("Aucun paramètre session");
            }
            $this->requeteAPILogin();
        }
    }
    /**
     * Récupère les datas
     */
    private function getDataToProcessLoginApps()
    {
        $this->requeteAPIMe();
        $uuid = $this->checkingAccountHandler->addAccountIfNotExist($_SESSION);
        $this->getDataInSessionFromUuid($uuid);
        $comptes = $this->listHandler->getAccountList($_SESSION);
        $_SESSION['listeComptes'] = $comptes;
    }
    /**
     * If Error in maine
     */
    private function errorProcessLoginApps()
    {
        $_SESSION = [];
        $urlAcceuil = PAGE_D_ACCEUIL;
        $loginAppsUrl = URL_LOGIN_APPS_API . '/login';
        $urlAcceuilEncoded = urlencode($urlAcceuil);
        header('Location:' . $loginAppsUrl . '?to=' . $urlAcceuilEncoded);
    }
    /**
     * Vérifie si l'url demandé
     * correspond à une route public
     * 
     * @return
     */
    public function checkIfPublicRoutes()
    {
        $route = $_GET['route'];
        $action = $_GET['action'];
        $permissionUrl = $route . '/' . $action;
        $publicRoutes = PERMISSIONS_PUBLIC;
        return UtilsArray::searchIfASpecificValueExistInAnArray($permissionUrl, $publicRoutes, 'name');
    }
    /**
     * Récupère le bearer token
     * 
     * @return void
     */
    private function requeteAPILogin(): void
    {
        $header = [
            "Idsession: " . $_SESSION['tokenSession']
        ];
        $data = [
            "module" => MODULE_NAME,
            "device_name" => $_SERVER['REMOTE_ADDR']
        ];
        $this->requeteApi->setHeader($header);
        $this->requeteApi->setDataJson($data);
        $this->requeteApi->setMethod('login');
        $_SESSION['bearerToken'] = $this->requeteApi->httpPOST()['token'];
    }

    /**
     * Récupère les datas du client avec login Apps
     * 
     * @return void
     */
    private function requeteAPIMe(): void
    {
        $header = [
            'Content-Type: application/json',
            "Idsession:" . $_SESSION['tokenSession'],
            'Authorization: Bearer ' . $_SESSION['bearerToken']
        ];
        $this->requeteApi->setHeader($header);
        $this->requeteApi->setMethod('me');
        $_SESSION['dataUserLoginApps'] = $this->requeteApi->httpGET()['data'];
    }

    /**
     * Insère dans la session les data clients
     * 
     * @param string $uuid
     * @return void
     */
    private function getDataInSessionFromUuid(string $uuid): void
    {
        $dataClient = $this->modelRequest->getAccountsByUuid($uuid)[0];
        $_SESSION['dataUserAffluence'] = $dataClient;
        $_SESSION['idCompte'] = $dataClient['idUsers'];
    }
}

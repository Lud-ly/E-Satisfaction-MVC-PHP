<?php
/**
 * classe ControleurLogout
 */
class ControllerLogout extends BaseController
{
    private $requestApiLoginApps;
    /**
     * Constructeur de la classe Controleur Logout
     */
    function __construct(){
        $this->requestApiLoginApps = new RequestApiLoginApps;
    }

    /**
     * Fonction main qui permet de logout
     * 
     * @return void
     */
    public function logout(): void{
        $this->makeLogoutRequest();
        $this->cleanSession();
        $this->redirectionVersLApplication();
    }
    
    /**
     * Fait le requête POST qui permet la déconnexion côté API
     * 
     * @return void
     */
    private function makeLogoutRequest(): void{
        $header = [
            'Authorization: Bearer ' . $_SESSION['bearerToken'],
            'Idsession: ' . $_SESSION['tokenSession']
        ];
        $data = [
            "module" => MODULE_NAME,
            "device_name" => $_SERVER['REMOTE_ADDR']
        ];
        $this->requestApiLoginApps->setHeader($header);
        $this->requestApiLoginApps->setDataJson($data);
        $this->requestApiLoginApps->setMethod('logout');
        $this->requestApiLoginApps->httpPOST();
    }

    /**
     * Détruit la session
     */
    private function cleanSession(){
        session_destroy();
    }

    /**
     * Fait la redirection une fois la deconnexion faite
     * 
     * @return void
     */
    private function redirectionVersLApplication(): void{
        header('Location:?route=Question&action=index');
    }
}
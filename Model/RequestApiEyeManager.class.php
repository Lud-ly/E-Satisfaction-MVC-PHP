<?php
/**
 * Class RequestApiEyeManager
 */
class RequestApiEyeManager
{
    private $method;
    private $url;
    private $typeEntity;
    private $idEntity;
    private $dataJson;
    private static $https = URL_API_EYEMANAGER;
    private static $keys = KEY_API_EYEMANAGER;

    /**
     * Constructeur de la class, permet d'instancier la class HttpRequest
     */
    function __construct(){
        $this->httpRequest = new HttpRequest();
    }

    /**
     * Cette fonction permet de modifier la variable $dataJson
     */
    public function setDataJson($data)
    {
        $this->dataJson = json_encode($data);
    }

    /**
     * Cette fontion permet de modifier la variable $method.
     */
    public function setMethod($method)
    {
        $this->method = "/" . $method;
    }

    /**
     * Cette fonction permet de modifier la variable $typeEntity
     */
    public function setTypeEntity($typeEntity)
    {
        $this->typeEntity = "/" . $typeEntity;
    }
    
    /**
     * Cette fonction permet de modifier la variable $idEntity
     */
    public function setIdEntity($idEntity)
    {
        $this->idEntity = "/" . $idEntity;
    }

    /**
     * Cette fonction permet de set la variable $url
     */
    private function definirUrl()
    {
        $this->url = self::$https . self::$keys . $this->typeEntity . $this->idEntity . $this->method;
        Log::addLog($this->url = self::$https . self::$keys . $this->typeEntity . $this->idEntity . $this->method);
    }

    /**
     * Permet de faire la méthode GET
     */
    public function httpGET()
    {
        $this->definirUrl();
        $this->httpRequest->setUrl($this->url);
        return json_decode($this->httpRequest->httpGET(), true);
    }

    /**
     * Permet de faire la méthode POST
     */
    public function httpPOST()
    {
        $this->definirUrl();
        $header = array(                                                                    
            'Content-Type: application/json',                                                                                
        );
        $this->httpRequest->setHeader($header);
        $this->httpRequest->setBody($this->dataJson);
        $this->httpRequest->setUrl($this->url);
        return json_decode($this->httpRequest->httpPOST(), true);
    }

    /**
     * Permet de faire la méthode PUT
     */
    public function httpPUT()
    {
        $this->definirUrl();
        $header = array(                                                                    
            'Content-Type: application/json',                                                                                
        );
        $this->httpRequest->setHeader($header);
        $this->httpRequest->setBody($this->dataJson);
        $this->httpRequest->setUrl($this->url);
        return json_decode($this->httpRequest->httpPUT(), true);
    }

    /**
     * Permet de faire la méthode DELETE
     */
    public function httpDELETE()
    {
        $this->definirUrl();
        $this->httpRequest->setUrl($this->url);
        return json_decode($this->httpRequest->httpDELETE(), true);
    }

}

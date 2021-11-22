<?php
/**
 * Class RequestApiLoginApps
 */
class RequestApiLoginApps
{
    private $dataJson;
    private $method;
    private $header;
    private static $https = URL_LOGIN_APPS_API;

    /**
     * Constructeur de la class, permet d'instancier la class HttpRequest
     */
    function __construct(){
        $this->httpRequest = new HttpRequest();
        $this->header = [];
        // $this->header = array(                                                                    
        //     ,                                                                                                                                                             
        // );
    }

    /**
     * Cette fonction permet de modifier la variable $dataJson
     */
    public function setDataJson($data)
    {
        $this->dataJson = json_encode($data);
    }

    /**
     * Permet de set le header
     * @param array $header
     * @return void
     */
    public function setHeader(array $header) :void{
        
        $this->header = $header;
        $this->header[] = 'Content-Type: application/json';
 
    }

    /**
     * Cette fontion permet de modifier la variable $method.
     */
    public function setMethod($method)
    {
        $this->method = "/api/" . $method;
    }

    /**
     * Cette fonction permet de set la variable $url
     */
    private function definirUrl()
    {
        $this->url = self::$https . $this->method;
    }

    /**
     * Permet de faire la méthode POST
     */
    public function httpPOST()
    {
        $this->definirUrl();
        $this->httpRequest->setHeader($this->header);
        $this->httpRequest->setBody($this->dataJson);
        $this->httpRequest->setUrl($this->url);
        return json_decode($this->httpRequest->httpPOST(), true);
    }
    
    /**
     * Permet de faire la méthode GET
     */
    public function httpGET()
    {
        $this->definirUrl();
        $this->httpRequest->setHeader($this->header);
        $this->httpRequest->setUrl($this->url);
        return json_decode($this->httpRequest->httpGET(), true);
    }
}
<?php

/**
 * Class permettant de faire un GET, POST, PUT et DELETE en curl
 */
class HttpRequest{

    private $settingsHttp;
    
    /**
     * Permet de set le header
     * @param array $header
     * @return void
     */
    public function setHeader(array $header) :void{
        $this->settingsHttp[CURLOPT_HTTPHEADER] = $header;
    }
    
    /**
     * Permet de set le body
     * @param string $body
     * @return void
     */
    public function setBody($body): void{
        $this->settingsHttp[CURLOPT_POSTFIELDS] = $body;
    }
    
    /**
     * Permet de set l'url
     * @param string $url
     * @return void
     */
    public function setUrl(string $url) :void{
        $this->settingsHttp[CURLOPT_URL] = $url;
    }
    
    /**
     * Construit la requête Curl
     */
    private function curlQuery()
    {
        $this->settingsHttp[CURLOPT_RETURNTRANSFER] = true;
        $ch = curl_init();
        curl_setopt_array($ch, $this->settingsHttp);
        $response = curl_exec($ch);
        $curlInfo = curl_getinfo($ch);
        curl_close($ch);
        $this->settingsHttp = [];
        if($curlInfo['http_code'] != 200)
        {
            throw new Exception($response);
        }
        return $response;
    }

    /**
     * Pour GET
     * Appelle la méthode CurlQuery
     */
    public function httpGET()
    {
        $this->settingsHttp[CURLOPT_CUSTOMREQUEST] = "GET";
        return $this->curlQuery();
    }
    
    /**
     * Pour POST
     * Appelle la méthode CurlQuery
     */
    public function httpPOST()
    {
        $this->settingsHttp[CURLOPT_CUSTOMREQUEST] = "POST";
        return $this->curlQuery();  
        
    }
    
    /**
     * Pour PUT
     * Appelle la méthode CurlQuery
     */
    public function httpPUT()
    {
        $this->settingsHttp[CURLOPT_CUSTOMREQUEST] = "PUT";    
        return $this->curlQuery();
    }
    
    /**
     * Pour DELETE
     * Appelle la méthode CurlQuery
     */
    public function httpDELETE()
    {
        $this->settingsHttp[CURLOPT_CUSTOMREQUEST] = "DELETE";    
        return $this->curlQuery();
    }
}
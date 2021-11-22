<?php

class RouteurAjax
{
  function __construct($factoryControleur)
  {
    $this->factoryControleur = $factoryControleur;
  }

  public function routeurRequete()
  {
    Log::addLog("Début chargement controleur ajax");
    $uneGestionException = new AjaxExeptionHandler();
    AjaxHandler::$ajaxReturn = array("messageErreur" => "");
    AjaxHandler::$returnAjaxCode = 200;
    AjaxHandler::$optionJSONEncode = JSON_THROW_ON_ERROR;
    $routeur = new Routeur($this->factoryControleur);
    $routeur->routeurRequete();
    require_once("Model/sendResponse.php");
    Log::addLog("Ok fin controleur ajax");
  }
}

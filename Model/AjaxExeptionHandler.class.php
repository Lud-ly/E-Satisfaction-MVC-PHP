<?php

class AjaxExeptionHandler extends ExeptionHandler
{
  public function __construct()
  {
    parent::__construct();
  }
  /**
   * Fonction qui est appellée quand un execption est levée
   * @param [Exception] $exception
   * @return void
   */
  public function catchExeption($exception)
  {
    parent::catchExeption($exception);
    if (is_object($exception) && AjaxHandler::$returnAjaxCode == 200) {
      AjaxHandler::$returnAjaxCode = 520;
      
    }
    $ajaxReturn = AjaxHandler::$ajaxReturn;
    if ($ajaxReturn["messageErreur"] == "") {
      $ajaxReturn["messageErreur"] = STRINGS["erreurSurvenueVeuillezReessayer"];
    }
    $ajaxReturn["exception"] = $this->dataException;
    AjaxHandler::$ajaxReturn = $ajaxReturn;
    AjaxHandler::sendResponseAjax();
  }
}

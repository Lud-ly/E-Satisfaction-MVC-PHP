<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require 'Model/constants.php';
require_once 'Model/traduction.php';
require 'Model/Autoloader.class.php';
session_start(); //Start session
Autoloader::register(); //Autoloader
new ExeptionHandler; //Exception
Log::initialize(); //Log
Security::FiltrerGetPost(); //Security
$middleWareLoginApps = new MiddleWareAuthenticationService(new RequestApiLoginApps); //MiddleWareLopinApps
$middleWareLoginApps->main(); //Methode MiddleWare
$checkUrl = new CheckUrlHandler; //Check url
$checkUrl->checkUrl(); //Methode check url
//Redirection vers le routeur AJAX ou PHP
//*-----------------------------------------------------*//
$factory = new FactoryFactory();

$routeur = new Routeur($factory->createInstance("Controller"));
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  $routeur = new RouteurAjax($factory->createInstance("Controller"));
}
$routeur->routeurRequete();
//*-----------------------------------------------------*//
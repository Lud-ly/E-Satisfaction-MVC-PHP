<?php
const RECUL_DOSSIER_LOG = '../';
const NOM_DOSSIER_LOGS = 'LogsAdminTest';

define('BASE_FOLDER_NAME', $_ENV['BASE_FOLDER_NAME']);
define('BASE_FOLDER_LOCATION', $_ENV['BASE_FOLDER_LOCATION']);
define('URL_API_EYEMANAGER', $_ENV['URL_API_EYEMANAGER_ENV']);
define('KEY_API_EYEMANAGER', $_ENV['KEY_API_EYEMANAGER_ENV']);
define('URL_LOGIN_APPS_API', $_ENV['URL_LOGIN_APPS_API_ENV']);
define('PAGE_D_ACCEUIL', $_ENV['URL_ACCUEIL_ENV']);
define('MODULE_NAME', $_ENV['MODULE_NAME_ENV']);
define('BASE_URL', $_ENV['BASE_URL_ENV']);

//Remplir (C'est un tableau)
const PERMISSIONS_PUBLIC = [
    ["name" => 'Feedback/index'],
    ["name" => 'Feedback/getSurvey'],
    ["name" =>  'CI/deploy']
    
];
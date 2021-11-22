<?php

/** ------------------------------------------------------------------------
 * \date : 10/01/2020
 * \author : Maxime CHAMBAUD
 * \brief:   Classe Autoloader qui permet d'autoloader les classes
 * \version 1.00
 * \note V1.00 creation 10/01/2020
 *-------------------------------------------------------------------------
 *-------------------------------------------------------------------------
 *-------------------------------------------------------------------------*/
class Autoloader
{
  /** ------------------------------------------------------------------------
   * \date : 10/01/2020
   * \author : Maxime CHAMBAUD
   * \brief:   Fonction qui permet d'enregistrer la fonction qui servira à autoloader les classes
   * \version 1.00
   * \note V1.00 creation 10/01/2020
   *-------------------------------------------------------------------------
   *-------------------------------------------------------------------------
   *-------------------------------------------------------------------------*/
  public static function register()
  {
    spl_autoload_register([__CLASS__, 'autoload']);
  }
  /** ------------------------------------------------------------------------
   * \date : 10/01/2020
   * \author : Maxime CHAMBAUD
   * \brief:   Fonction qui permet d'autoloader les classes
   * \version 1.00
   * \note V1.00 creation 10/01/2020
   *-------------------------------------------------------------------------
   *-------------------------------------------------------------------------
   *-------------------------------------------------------------------------*/
  public static function autoload($class)
  {
    $lien = 'Model/' . $class . '.class.php';
    if (!is_file($lien)) {
      $lien = 'Controller/' . $class . '.class.php';
    }
    if (is_file($lien)) {
      require_once $lien;
    }
  }
}

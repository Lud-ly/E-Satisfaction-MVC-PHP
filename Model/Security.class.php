<?php

/** ------------------------------------------------------------------------
 * \date : 10/01/2020
 * \author : Maxime CHAMBAUD
 * \brief:   Classe Security qui permet d'assurer la sécurité de l'application
 * \version 1.00
 * \note V1.00 creation 10/01/2020
 *-------------------------------------------------------------------------
 *-------------------------------------------------------------------------
 *-------------------------------------------------------------------------*/
class Security
{
	/** ------------------------------------------------------------------------
	 * \date : 10/01/2020
	 * \author : Maxime CHAMBAUD
	 * \brief:   Function qui permet de filtrer et de sécuriser toutes les données passées en GET et POST 
	 * \version 1.00
	 * \note V1.00 creation 10/01/2020
	 *-------------------------------------------------------------------------
	 *-------------------------------------------------------------------------
	 *-------------------------------------------------------------------------*/
	static function FiltrerGetPost()
	{
		foreach ($_GET as $key => $val) {
			$val[$key] = htmlentities($val, ENT_QUOTES);
			$val[$key] = html_entity_decode($val[$key]);
			$_GET[$key] = $val;
		}
		$post = $_POST;
		array_walk_recursive($post, function (&$value) {
            $value = htmlentities($value, ENT_QUOTES);
            $value = stripslashes($value);
        });
		$_POST = $post;
	}
	/** ------------------------------------------------------------------------
	 * \date : 10/01/2020
	 * \author : Maxime CHAMBAUD
	 * \brief:   Function qui permet de filtrer et de sécuriser la string en parametre
	 * \details:
	 * \params: string $string la string a filtrer
	 * \params: array $aEnlever les caracteres a enlever
	 * \return: string $string filtré
	 * \version 1.00
	 * \note V1.00 creation 10/01/2020
	 *-------------------------------------------------------------------------
	 *-------------------------------------------------------------------------
	 *-------------------------------------------------------------------------*/
	static function FiltrerString($string, $aEnlever)
	{
		foreach ($aEnlever as $caractere) {
			$string = str_replace($caractere, "", $string);
		}
		return $string;
	}
	/** ------------------------------------------------------------------------
	 * \date : 10/01/2020
	 * \author : Maxime CHAMBAUD
	 * \brief:   Function qui permet de filtrer et de sécuriser la string en parametre pour l'encodaeg dans les fichiers  
	 * \details:
	 * \params: string $string la string a filtrer
	 * \return: string $string filtré
	 * \version 1.00
	 * \note V1.00 creation 10/01/2020
	 *-------------------------------------------------------------------------
	 *-------------------------------------------------------------------------
	 *-------------------------------------------------------------------------*/
	static function FiltrerStringPourEncodageFichier($string)
	{
		return self::FiltrerString($string, array(";", "|"));
	}
	/** ------------------------------------------------------------------------
	 * \date : 10/01/2020
	 * \author : Maxime CHAMBAUD
	 * \brief:   Function qui permet de sécuriser la string en parametre si trop longue
	 * \details:
	 * \params: string $string la string a filtrer
	 * \return: int $maxLengh taille max de la string
	 * \version 1.00
	 * \note V1.00 creation 10/01/2020
	 *-------------------------------------------------------------------------
	 *-------------------------------------------------------------------------
	 *-------------------------------------------------------------------------*/
	static function ReduireTailleMaxSaisie($string, $maxLengh)
	{
		return substr($string, 0, $maxLengh);
	}
}

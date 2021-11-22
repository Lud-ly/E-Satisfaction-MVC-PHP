<?php
/**
 * Class permettant de gérer l'ajax
 */
class AjaxHandler
{

    public static $ajaxReturn;
    public static $returnAjaxCode;
    public static $optionJSONEncode;

    /**
     * Fonction qui est appellé pour envoyer la réposne ajax
     *
     * @return void
     */
    public static function sendResponseAjax()
    {
        Log::addLog("HTTP Code retour : ".self::$returnAjaxCode);
        header('Content-Type: application/json');
        http_response_code(self::$returnAjaxCode); 
        echo htmlspecialchars_decode(html_entity_decode(json_encode(self::$ajaxReturn, self::$optionJSONEncode)));
    }
}
?>

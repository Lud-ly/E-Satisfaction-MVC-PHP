<?php

abstract class Vue
{
    protected $addOnParametres;

    public function getPartieHtml($nomVue, $methode, $addOnParametres = array())
    {
        $this->addOnParametres = $addOnParametres;

        $nomPermission = $nomVue . "/" . $methode;
        $contenu = '';
        $gestionPermission = new PermissionsAndRoleHandler;
        $ifPermissionExist = $gestionPermission->checkIfPermissionIsAllowed($nomPermission);
        if ($ifPermissionExist) {
            $contenu = $this->$methode();
        }
        echo htmlspecialchars_decode(html_entity_decode($contenu, ENT_QUOTES | ENT_HTML5));
    }

    public function transformToJson($arrayToEncode){
        echo json_encode($arrayToEncode);
    }


}

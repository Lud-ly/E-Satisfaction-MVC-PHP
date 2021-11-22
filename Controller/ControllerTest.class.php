<?php

class ControllerTest extends BaseControllerPagesWithData{
    function __construct(ModelRequest $modelRequest, array $session){
        parent::__construct($modelRequest, $session);
    }

    public function methodeTest(){
        $vue = new GenerateVue("Test", array());
        $vue->generate();
    }

    public function ajoutTest(){
        log::addLog($_POST);
    }

    public function testPublic(){
        echo 'Cette page est public';
    }
    
    public function testPublic2(){
        echo 'Cette page est public2';
    }

}
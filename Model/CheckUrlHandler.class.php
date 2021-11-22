<?php

class CheckUrlHandler
{
    function __construct(){
        $this->route = $_GET['route'];
        $this->action = $_GET['action'];
    }

    public function checkUrl(){
        if (!isset($this->route) || !isset($this->action)) {
            header("Location:".PAGE_D_ACCEUIL);
        }
    }
}

?>
<?php

abstract class BaseControllerPagesWithData extends BaseController
{
    protected $modelRequest;
    protected $session;

    function __construct(ModelRequest $modelRequest, array $session){
        $this->modelRequest = $modelRequest;
        $this->session = $session;
    }
}

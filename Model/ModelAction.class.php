<?php

/**
 * Classe permettant d'exécuter une requête GET, POST and PUT.
 */
class ModelAction{

    private $typeEntity;
    private $idEntity;
    private $RequestApiManager;

    /**
     * Constructeur de la classe ModeleAction
     */
    function __construct($typeEntity)
    {
        $this->typeEntity = $typeEntity;
        $this->RequestApiManager = new RequestApiEyeManager();
        $this->RequestApiManager->setTypeEntity($this->typeEntity);
    }

    /**
     * Cette fonction permet de sélectionner les données selon l'entité.
     */
    function getAll(){

       return $this->RequestApiManager-> httpGET();
    }

    /**
     * Cette fonction permet de selectionner les données d'une entité par son id
     */
    function getById($idEntity){
        $this->idEntity = $idEntity;
        $this->RequestApiManager->setIdEntity($this->idEntity);
        return $this->RequestApiManager->httpGET();
        
    }
   
    /**
     * Cette fonction premet d'ajouter une donnée.
     */
    function add($data){
        $this->RequestApiManager->setDataJson($data);
        return $this->RequestApiManager->httpPOST();
    }

    /**
     * Cette fonction permet de trouver un élément, autre que par son id.
     */
    function findBy($typeEntity, $method, $data){
        $this->typeEntity = $typeEntity;
        $this->method = $method;
        $this->RequestApiManager->setDataJson($data);
        $this->RequestApiManager->setMethod($this->method);
        $this->RequestApiManager->setTypeEntity($this->typeEntity);
        return $this->RequestApiManager->httpPOST();
    }

    /**
     * Cette fonction permet d'effectuer un batch
     */
    function batch($typeEntity, $method, $data){
        $this->typeEntity = $typeEntity;
        $this->method = $method;
        $this->RequestApiManager->setDataJson($data);
        $this->RequestApiManager->setMethod($this->method);
        $this->RequestApiManager->setTypeEntity($this->typeEntity);
        return $this->RequestApiManager->httpPOST();
    }
    
    /**
     * Cette fonction permet de modifier une donnée
     */
    function update($data, $idEntity){
        $this->idEntity = $idEntity;
        $this->RequestApiManager->setIdEntity($this->idEntity);
        $this->RequestApiManager->setDataJson($data);
        return $this->RequestApiManager->httpPUT();
    }
    
    /**
     * Cette fonction permet de supprimer une donnée
     */
    function delete($idEntity){
        $this->idEntity = $idEntity;
        $this->RequestApiManager->setIdEntity($this->idEntity);
        return $this->RequestApiManager->httpDELETE();
    }
}
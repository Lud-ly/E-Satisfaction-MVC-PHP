<?php

class GetEntitiesHandler
{
    /**
     * Constructeur de la classe
     */
    function __construct()
    {
        $this->modelRequest = new ModelRequest();
    }
    /**
     * Get Enquetes by idComptes
     */
    public function getSurveysByIdAccount($ids)
    {
        return  $this->modelRequest->getSurveysByIdAccount($ids);
    }
    /**
     * 
     */
    public function getQuestionsByIdAccount($ids)
    {
        $enquetes =  $this->getSurveysByIdAccount($ids);
        $questions = UtilsArray::getDataInMultidimensionalArrayBySpecificKey($enquetes, "idQuestion");

        return UtilsArray::removeDuplicateElementsFromArray($questions, "idQuestion");
    }
    /**
     * 
     */
    public function getAnswersByIdQuestion($ids)
    {
        $question = $this->modelRequest->getQuestionsByIdAccount($ids);
        $idQuestion = UtilsArray::getDataInMultidimensionalArrayBySpecificKey($question, "idQuestion");

        return  $this->modelRequest->getAnswersByIdQuestion($idQuestion);
    }
}

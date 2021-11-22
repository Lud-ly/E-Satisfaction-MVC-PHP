<?php

class GestionGetEntities
{
    /**
     * Constructeur de la classe
     */
    function __construct()
    {
        $this->modeleRequetes = new ModeleRequetes();
    }
    /**
     * Get Enquetes by idComptes
     */
    public function getEnquetesByIdComptes($ids)
    {

        return  $this->modeleRequetes->getEnquetesByIdComptes($ids);
    }
    /**
     * 
     */
    public function getQuestionsByIdComptes($ids)
    {
       
        $enquetes =  $this->getEnquetesByIdComptes($ids);
      
        $questions = UtilsArray::getDataInMultidimensionalArrayBySpecificKey($enquetes, "idQuestion");
        
        return UtilsArray::removeDuplicateElementsFromArray($questions,"idQuestion");
        
    }
    /**
     * 
     */
    public function getAnswersByIdQuestion($ids)
    {
        $question = $this->modeleRequetes->getQuestionsByIdComptes($ids);
        $idQuestion = UtilsArray::getDataInMultidimensionalArrayBySpecificKey($question, "idQuestion");
        return  $this->modeleRequetes->getAnswersByIdQuestion($idQuestion);
    }
}

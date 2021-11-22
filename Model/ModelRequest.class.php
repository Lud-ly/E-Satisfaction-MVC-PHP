<?php

/**
 * Classe permettant d'envoyer des requêtes à la BDD par l'API.
 */
class ModelRequest
{

    /**
     * Récupère un compte en
     * fonction de son Uuid
     * 
     * @param array
     */
    public function getAccountsByUuid($uuids)
    {
        $typeEntity = "users";
        $method = "findby";
        $data = array("idAuthentication" => $uuids);
        $requete = new ModelAction($method);
        return $requete->findBy($typeEntity, $method, $data);
    }

    /**
     * Ajoute un compte
     */
    public function addAccount($data)
    {
        $typeEntity = "users";
        $requete = new ModelAction($typeEntity);
        return $requete->add($data);
    }


    public function addJustQuestion($data)
    {
        Log::addLog($data);
        $typeEntity = "question";
        $requete = new ModelAction($typeEntity);
        return $requete->add($data);
    }

    public function updateJustQuestion($data, $id)
    {
        Log::addLog($data);
        $typeEntity = "question";
        $requete = new ModelAction($typeEntity);
        return $requete->update($data, intval($id));
    }

    public function addAnswerByIdQuestion($answers)
    {

        $typeEntity = "answerType";
        $method = "batch";
        $requete = new ModelAction($typeEntity);
        return $requete->batch($typeEntity, $method, $answers);
    }

    public function updateAnswerByIdQuestion($answers)
    {
        $typeEntity = "answerType";
        $method = "batch";
        $requete = new ModelAction($typeEntity);
        return $requete->batch($typeEntity, $method, $answers);
    }

    public function deleteAnswersWithIdQuestionNull($answers)
    {
        $typeEntity = "answerType";
        $method = "batch";
        $requete = new ModelAction($typeEntity);
        return $requete->batch($typeEntity, $method, $answers);
    }
    public function updateSurveyByIdQuestion($surveys)
    {
        $typeEntity = "survey";
        $method = "batch";
        $requete = new ModelAction($typeEntity);
        return $requete->batch($typeEntity, $method, $surveys);
    }
    /** ************************************************ */

    function getSurveysByIdAccount($ids)
    {
        $typeEntity = "survey";
        $method = "findby";
        $requete = new ModelAction($typeEntity);
        $data = array("idUsers" => $ids);
        return $requete->findBy($typeEntity, $method, $data);
    }

    function getSurveysByIdAccountAndIdQuestion($ids, $idQuestion)
    {
        $typeEntity = "survey";
        $method = "findby";
        $requete = new ModelAction($typeEntity);
        $data = array("idUsers" => $ids, "idQuestion" => $idQuestion);
        return $requete->findBy($typeEntity, $method, $data);
    }

    function getAnswersByIdAccountAndIdQuestionNull($ids)
    {
        $typeEntity = "answerType";
        $method = "findby";
        $requete = new ModelAction($typeEntity);
        $data = array("idUsers" => $ids, "idQuestion" => null);
        return $requete->findBy($typeEntity, $method, $data);
    }

    function getAnswersByIdAccountAndIdQuestion($ids, $idQuestion)
    {
        $typeEntity = "answerType";
        $method = "findby";
        $requete = new ModelAction($typeEntity);
        $data = array("idUsers" => $ids, "idQuestion" => $idQuestion);
        return $requete->findBy($typeEntity, $method, $data);
    }

    function getQuestionsByIdAccount($ids)
    {
        $typeEntity = "question";
        $method = "findby";
        $requete = new ModelAction($typeEntity);
        $data = array(
            "idUsers" => $ids,

        );
        return $requete->findBy($typeEntity, $method, $data);
    }

    function getAnswersByIdQuestion($idQuestion)
    {
        $typeEntity = "answerType";
        $method = "findby";
        $requete = new ModelAction($typeEntity);
        $data = array("idQuestion" => $idQuestion);
        return $requete->findBy($typeEntity, $method, $data);
    }


    /**
     * Récupère les questions de la base
     */
    public function getQuestions()
    {
        $typeEntity = "question";
        $requete = new ModelAction($typeEntity);
        return $requete->getAll();
    }
    /**
     * Récupère les questions et les reponses de 
     * la base au onclick edit er sur le datatable
     */
    public function getQuestionAndAnswers($idQuestion)
    {
        $typeEntity = "answerType";
        $method = "findby";
        $requete = new ModelAction($typeEntity);
        $data = array("idQuestion" => $idQuestion);
        Log::addLog($requete->findBy($typeEntity, $method, $data));
        return $requete->findBy($typeEntity, $method, $data);
    }

    public function removeQuestion($idQuestion)
    {
        $typeEntity = "question";
        $requete = new ModelAction($typeEntity);
        return $requete->delete($idQuestion);
    }

    public function removeAnswerByIdQuestion($idQuestion)
    {
        $typeEntity = "answerType";
        $requete = new ModelAction($typeEntity);
        return $requete->delete($idQuestion);
    }

    /**
     * Récupère les surveys et les reponses de 
     * la base au onclick edit er sur le datatable
     */
    public function getSurvey($idSurvey)
    {
        $typeEntity = "survey";
        $method = "findby";
        $requete = new ModelAction($typeEntity);
        $data = array("idSurvey" => $idSurvey);
        return $requete->findBy($typeEntity, $method, $data);
    }

    public function updateSurvey(array $data, int $idQuestion)
    {
        $typeEntity = "survey";
        $requete = new ModelAction($typeEntity);
        return $requete->update($data, $idQuestion);
    }

    public function addSurvey($data)
    {
        $typeEntity = "survey";
        $requete = new ModelAction($typeEntity);
        return $requete->add($data);
    }

    public function removeSurvey($data)
    {
        $typeEntity = "survey";
        $requete = new ModelAction($typeEntity);
        return $requete->delete($data);
    }

    public function getTypeSurvey()
    {
        $typeEntity = "typeSurvey";
        $requete = new ModelAction($typeEntity);
        return $requete->getAll();
    }

    public function getPictures()
    {
        $typeEntity = "pictures";
        $requete = new ModelAction($typeEntity);
        return $requete->getAll();
    }
}

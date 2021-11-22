<?php

class ControllerSurvey extends BaseControllerPagesWithData
{

    function __construct(ModelRequest $modelRequest, array $session)
    {
        parent::__construct($modelRequest, $session);
    }
    public function index()
    {
        $vue = new GenerateVue("Survey", array());
        $vue->generate();
    }
    public function getSurveys()
    {
        Log::addLog($_SESSION['listeComptes']);
        $surveys = $this->modelRequest->getSurveysByIdAccount($_SESSION['listeComptes']);
        $surveys = $this->simplifySurveys($surveys);
        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $surveys;
    }
    /**
     * Get all questions
     */
    public function getQuestions()
    {
        $questions = $this->modelRequest->getQuestions();
        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $questions;
    }
    /**
     * Let you retrieve all type survey available for survey CRUD
     */
    public function getTypeSurvey()
    {
        $typeSurvey = $this->modelRequest->getTypeSurvey();
        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $typeSurvey;
    }
    /**
     * Main method to retrieve information of selected survey of edition, and all question/type survey available in one request
     */
    public function editSurvey()
    {
        $idSurvey = $_GET["idSurvey"];
        if (!is_null($idSurvey)) {
            $survey = $this->modelRequest->getSurvey($idSurvey);
        }

        $questions = $this->modelRequest->getQuestions();
        $typeSurvey = $this->modelRequest->getTypeSurvey();

        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $survey;
        AjaxHandler::$ajaxReturn['questions'] = $questions;
        AjaxHandler::$ajaxReturn['typeSurvey'] = $typeSurvey;
    }

    /**
     * Let you create or update a survey depending if idSurvey is_null or not
     */
    public function saveUpdateSurvey()
    {
        $data = [
            'name' => $_POST['surveyContent'],
            'idQuestion' => [
                'idQuestion' => $_POST['idQuestion']
            ],
            'idTypeSurvey' => [
                'idTypeSurvey' => $_POST['idTypeSurvey']
            ],
            'idUsers' => [
                'idUsers' => $_SESSION['idCompte']
            ]
        ];
        $this->verifyFormSurvey();
        if (is_null($_POST['idSurvey'])) {
            $survey = $this->modelRequest->addSurvey($data);
        } else {
            $survey = $this->modelRequest->updateSurvey($data, $_POST['idSurvey']);
        }

        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $survey;
    }

    private function verifyFormSurvey()
    {
        $surveyContentInput = $_POST['surveyContent'];

        if (!isset($surveyContentInput) || $surveyContentInput == "") {

            AjaxHandler::$ajaxReturn['messageErreur'] = "Le champ enquete ne peut etre vide";
            throw new Exception( "Le champ enquete ne peut etre vide");
        }
      
    }

    public function removeSurvey()
    {
        $idSurvey = $_POST['idSurvey'];
        $survey = $this->modelRequest->removeSurvey($idSurvey);
        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $survey;
    }

    private function simplifySurveys($surveys)
    {
        $surveys = array_map(function ($survey) {
            $survey['typeSurvey'] = $survey['idTypeSurvey']['name'];
            unset($survey['idQuestion']);
            unset($survey['idTypeSurvey']);
            unset($survey['idUsers']);
            return $survey;
        }, $surveys);
        return $surveys;
    }
}

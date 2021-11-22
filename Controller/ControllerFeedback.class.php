<?php

class ControllerFeedback extends BaseControllerPagesWithData
{
    private $surveyVoteHandler;
    private $idSurvey;

    function __construct(ModelRequest $modelRequest, array $session, $surveyVoteHandler, $idSurvey)
    {
        parent::__construct($modelRequest, $session);
        $this->surveyVoteHandler = $surveyVoteHandler;
        $this->idSurvey = $idSurvey;
    }

    public function index()
    {
        $vue = new GenerateVue("Feedback", array());
        $vue->generatePublicView();
    }

    public function getSurveyAndAnswer()
    {
        $idSurvey = intval($_POST['idSurvey']);
        $_POST['showResult'] == true ? $this->showResult() : Log::addLog("** showResult is null **");

        $surveys = $this->modelRequest->getSurvey($idSurvey);
        $surveys = UtilsArray::unsetFieldInArray($surveys, "idUsers");
        $survey = $surveys[0];

        $idQuestion = $survey['idQuestion']['idQuestion'];

        $answers = isset($idQuestion) ? $this->modelRequest->getAnswersByIdQuestion($idQuestion) : [];
        
        AjaxHandler::$ajaxReturn['data'] = $survey;
        AjaxHandler::$ajaxReturn['answers'] = $answers;
    }

    public function voteNotification()
    {
        $answer = $_POST['answer'];
        $data[] = $answer;

        $this->surveyVoteHandler->save($data);

        AjaxHandler::$ajaxReturn['messageReussite'] = STRINGS['successfullFeedback'];
    }

    public function showResult()
    {
        $stats = $this->surveyVoteHandler->renderStats($this->idSurvey);
        AjaxHandler::$ajaxReturn['stats'] = $stats;
    }
}

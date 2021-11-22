<?php

class ControllerQuestion extends BaseControllerPagesWithData
{

    function __construct(ModelRequest $modelRequest, array $session)
    {
        parent::__construct($modelRequest, $session);
        $this->getEntitiesHandler = new GetEntitiesHandler();
    }

    public function index()
    {
        $vue = new GenerateVue("Question", array());
        $vue->generate();
    }

    public function getSurveys()
    {
        $enquetes = $this->getEntitiesHandler->getSurveysByIdAccount($_SESSION['listeComptes']);
        AjaxHandler::$ajaxReturn['data'] = $enquetes;
    }

    public function getQuestions()
    {
        $questions = UtilsArray::cleanArray($this->getEntitiesHandler->getQuestionsByIdAccount($_SESSION['listeComptes']));
        
        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $questions;
    }

    public function getPictures() {
        $pictures = $this->modelRequest->getPictures();
        AjaxHandler::$ajaxReturn['pictures'] = $pictures;
    }

    public function addOrUpdateQuestion()
    {
        $idQuestion = intval($_POST['idQuestion']);
        $arrayOfSurveys = $_POST['arrayOfSurveys'];
        $folderHandler = new FolderHandler($arrayOfSurveys[0]);
        
        $question = [
            'idQuestion' => $idQuestion,
            'content' => $_POST['questionContent'],
            'active' => true,
            'orderQuestion' => 1
        ];
        $this->verifyFromQuestionAndAnswersForm();

        if ($question['idQuestion'] != "") {
            $question = $this->modelRequest->updateJustQuestion($question, $idQuestion);
            $folderHandler->removeFilesFromFolder($arrayOfSurveys);
        } else {
            $question = $this->modelRequest->addJustQuestion($question);
        }

        $idQuestion = $question['idQuestion'];

        $this->addOrUpdateAnswers($idQuestion);
        $this->updateSurvey($idQuestion);

        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $question;
    }


    private function verifyFromQuestionAndAnswersForm()
    {
        $questionContent = $_POST['questionContent'];
        $arrayOfAnswers = $_POST['arrayOfAnswers'];
        $arrayOfSurveys = $_POST['arrayOfSurveys'];

        if (!isset($questionContent) || $questionContent == "") {

            AjaxHandler::$ajaxReturn['messageErreur'] = STRINGS['LaQuestionNePeutEtreVide'];
            throw new Exception(STRINGS['LaQuestionNePeutEtreVide']);
        }
        if ($arrayOfAnswers == "" || count($arrayOfAnswers) < 2) {

            AjaxHandler::$ajaxReturn['messageErreur'] = STRINGS['VeuillezAjouterAuMoinsDeuxReponses'];
            throw new Exception(STRINGS['VeuillezAjouterAuMoinsDeuxReponses']);
        }
        if (!isset($arrayOfSurveys) || $arrayOfSurveys == "") {

            AjaxHandler::$ajaxReturn['messageErreur'] = STRINGS['VeuillezSelectionnerAuMoinsUneEnquetes'];
            throw new Exception(STRINGS['VeuillezSelectionnerAuMoinsUneEnquetes']);
        }
    }



    public function addOrUpdateAnswers($idQuestion)
    {

        $arrayOfAnswers = $_POST['arrayOfAnswers'];
             
        if (!isset($arrayOfAnswers)) {
            AjaxHandler::$ajaxReturn['error'] = STRINGS["VousNAvezAucuneReponseAttribueesACetteQuestion"];
        }
        $arrayOfAnswers = $this->addingPropertiesInArrayOfAnswers($arrayOfAnswers, $idQuestion);
        
        $arrayOfAnswersWithIdQuestionNulled = $this->nullifyIdQuestionFromGetAnswersByIdQuestion($idQuestion);
        $arrayOfAnswersWithIdQuestionNulled = UtilsArray::nullifyFieldInArray($arrayOfAnswersWithIdQuestionNulled, 'idPicture');
        $batchOfAnswersWithIdQuestionNulled['update'] = $arrayOfAnswersWithIdQuestionNulled;
        $this->modelRequest->updateAnswerByIdQuestion($batchOfAnswersWithIdQuestionNulled);
        
        $bothArrays = $this->prepareArrayOfAnswersBeforeAddOrUpdate($arrayOfAnswers);
        
        $batchOfArrayOfAnswersToAdd['create'] = $bothArrays['add'];
        $batchOfArrayOfAnswersToUpdate['update']  = $bothArrays['update'];
       
        $answersAdded = $this->modelRequest->addAnswerByIdQuestion($batchOfArrayOfAnswersToAdd);
        $answersUpdated = $this->modelRequest->updateAnswerByIdQuestion($batchOfArrayOfAnswersToUpdate);
        
        $answersWithIdQuestionNull = $this->modelRequest->getAnswersByIdAccountAndIdQuestionNull($_SESSION['listeComptes']);
        
            $answersToDelete = array_map(function($answer) {
            return $answer['idAnswerType'];
        },$answersWithIdQuestionNull);
        $batchOfAnswersToDelete['delete'] = $answersToDelete;
       
        $answersDeleted = $this->modelRequest->deleteAnswersWithIdQuestionNull($batchOfAnswersToDelete);
        
     
        AjaxHandler::$ajaxReturn['answersAdded'] = $answersAdded;
        AjaxHandler::$ajaxReturn['answersUpdated'] = $answersUpdated;
    }
    private function nullifyIdQuestionFromGetAnswersByIdQuestion($idQuestion)
    {
        $answersWithIdQuestion = $this->modelRequest->getAnswersByIdAccountAndIdQuestion($_SESSION['listeComptes'], $idQuestion);
        $answersWithIdQuestionNulled = UtilsArray::nullifyFieldInArray($answersWithIdQuestion, 'idQuestion');
        return $answersWithIdQuestionNulled;
    }

    public function addingPropertiesInArrayOfAnswers($arrayOfAnswers, $idQuestion)
    {
        foreach ($arrayOfAnswers as $key => $answer) {
            $answer['idQuestion'] = $idQuestion;
            $answer['answerValue'] = $key+1;
            $answer['type'] = 1;
            $answer['answerActive'] = true;
            $answer['acceptComment'] = true;
            $arrayOfAnswers[$key] = $answer;
        }
        return $arrayOfAnswers;
    }
    /**
     * Because we need 2 requests to add or update answer
     * this method checks if idQuestion field exist foreach element of array
     * @return array
     */
    private function prepareArrayOfAnswersBeforeAddOrUpdate(array $arrayToCheck)
    {

        $arrayOfAnswersToAdd = [];
        $arrayOfAnswersToUpdate = [];

        foreach ($arrayToCheck as $element) {
            $element['idAnswerType'] = intval($element['idAnswerType']);
            $element['idPicture'] = intval($element['idPicture']);

            if ($element['idAnswerType'] != "") {
                $arrayOfAnswersToUpdate[] = $element;
            } else {
                $arrayOfAnswersToAdd[] = $element;
            }
        }

        return array('add' => $arrayOfAnswersToAdd, 'update' => $arrayOfAnswersToUpdate);
    }

    public function editQuestions()
    {
        $idQuestion = $_POST["idQuestion"];
        $questions = $this->modelRequest->getQuestionAndAnswers($idQuestion);
        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $questions;
    }

    public function updateSurvey($idQuestion)
    {
        $arrayOfSurveys = $_POST['arrayOfSurveys'];

        $arrayOfSurveys = UtilsArray::intifyFieldInArray($arrayOfSurveys, 'idSurvey');
        $arrayOfSurveys = UtilsArray::addFieldInArray($arrayOfSurveys, 'idQuestion', $idQuestion);

        $surveysWithIdQuestionNulled = $this->nullifyIdQuestionFromGetSurveysByIdQuestion($idQuestion);

        $batchOfSurveysWithIdQuestionNulled['update'] = $surveysWithIdQuestionNulled;
        $batchOfSurveys['update'] = $arrayOfSurveys;

        $this->modelRequest->updateSurveyByIdQuestion($batchOfSurveysWithIdQuestionNulled);
        $surveys = $this->modelRequest->updateSurveyByIdQuestion($batchOfSurveys);

        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $surveys;
    }

    public function removeQuestion()
    {
        $idQuestion = $_POST['idQuestion'];

        $questionsWithIdQuestionNullified = $this->nullifyIdQuestionFromGetSurveysByIdQuestion($idQuestion);

        $batchOfQuestionsWithIdQuestionNullified['update'] = $questionsWithIdQuestionNullified;

        $this->modelRequest->updateSurveyByIdQuestion($batchOfQuestionsWithIdQuestionNullified);
        $question = $this->modelRequest->removeQuestion($idQuestion);
        AjaxHandler::$ajaxReturn['messageReussite'] = "success";
        AjaxHandler::$ajaxReturn['data'] = $question;
    }


    private function nullifyIdQuestionFromGetSurveysByIdQuestion($idQuestion)
    {
        $surveysWithIdQuestion = $this->modelRequest->getSurveysByIdAccountAndIdQuestion($_SESSION['listeComptes'], $idQuestion);

        $surveysWithIdQuestionNulled = UtilsArray::nullifyFieldInArray($surveysWithIdQuestion, 'idQuestion');
        $surveysWithIdQuestionNulled = UtilsArray::unsetFieldInArray($surveysWithIdQuestionNulled, 'idTypeSurvey');
        $surveysWithIdQuestionNulled = UtilsArray::unsetFieldInArray($surveysWithIdQuestionNulled, 'idUsers');
        return $surveysWithIdQuestionNulled;
    }

    

   
}

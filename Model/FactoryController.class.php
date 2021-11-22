<?php

class FactoryController extends AbstractFactory
{

    public function createInstance($className, $arguments = array())
    {
        $newInstance = null;
        $className = "Controller" . ucfirst($className);
        switch ($className) {
            case "ControllerTest":
                $arguments = array_merge([
                    new ModelRequest,
                    $_SESSION
                ], $arguments);
                break;
            case "ControllerQuestion":
                $arguments = array_merge([
                    new ModelRequest,
                    $_SESSION
                ], $arguments);
                break;
            case "ControllerSurvey":
                $arguments = array_merge([
                    new ModelRequest,
                    $_SESSION
                ], $arguments);
                break;
            case "ControllerFeedback":
                $idSurvey = $_POST['idSurvey'];
                $surveyVoteHandler = new SurveyVoteHandler($idSurvey, new FileHandler($idSurvey), new FolderHandler($idSurvey), new StatsHandler());
                $arguments = array_merge([
                    new ModelRequest,
                    $_SESSION,
                    $surveyVoteHandler, 
                    $idSurvey]);
                    break;
            case "ControllerLogout":
                $arguments = array_merge([
                    new ModelRequest,
                    $_SESSION
                ], $arguments);
                break;
            default:
                throw new Exception("Unknown class $className");
                break;
        }
        $newInstance = new $className(...$arguments);
        return $newInstance;
    }
}

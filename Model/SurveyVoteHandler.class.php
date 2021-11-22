<?php

class SurveyVoteHandler
{
    private $folderHandler;
    private $fileHandler;
    private $statsHandler;
    private $idSurvey;

    public function __construct($idSurvey, AbstractFileHandler $fileHandler, AbstractFolderHandler $folderHandler, AbstractStats $statsHandler)
    {
        $this->fileHandler = $fileHandler;
        $this->folderHandler = $folderHandler;
        $this->statsHandler = $statsHandler;
        $this->idSurvey = $idSurvey;
    }


    public function save($data)
    {
        $fileName = date('Y-m-d') . ".json";
        $this->fileHandler->create($fileName);
        $this->fileHandler->save($data);
    }

    public function renderStats()
    {
        $data = $this->folderHandler->getData($this->idSurvey);
        $result  = [];
        if (!empty($data)) {
            $result = $this->statsHandler->getStats($data);
        } 
        return $result;
    }
}

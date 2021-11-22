<?php

class FolderHandler extends AbstractFolderHandler
{

    private $directoryName;
    private $directoryNameFolderPath;

    public function __construct($directoryName)
    {
        parent::__construct();
        $this->directoryName = $directoryName;
        $this->directoryNameFolderPath = $this->baseLocationFolder . "/" . $this->directoryName . "/";
        $this->create();
    }

    public function create()
    {
        $this->createBaseFolder();
        $this->createDirectoryNameFolder();
    }

    private function createBaseFolder()
    {
        if (!is_dir($this->baseLocationFolder)) {
            mkdir($this->baseLocationFolder);
        }
    }

    private function createDirectoryNameFolder()
    {
        if (!is_dir($this->directoryNameFolderPath)) {
            mkdir($this->directoryNameFolderPath);
        }
    }

    public function removeFilesFromFolder($arrayOfFoldersToClear)
    {
        foreach ($arrayOfFoldersToClear as $folder) {
            $folderToScan = $this->baseLocationFolder . "/" . $folder['idSurvey'];
            $filesInFolder = scandir($folderToScan);

            if ($filesInFolder != false) {

                $fieldsToRemove = array("." => ".", ".." => "..", ".DS_Store" => ".DS_Store");
                $filesInFolder = $this->removeFieldsInData($filesInFolder, $fieldsToRemove);

                foreach ($filesInFolder as $file) {
                    unlink($folderToScan . "/" . $file);
                }
            }
        }
    }


    public function getData($folder)
    {
        $filesLocation = $this->baseLocationFolder . "/" . $folder;

        $filesList = scandir($filesLocation);
        Log::addLog("scandir : ");
        Log::addLog($filesList);

        $fieldsToRemove = array("." => ".", ".." => "..", ".DS_Store" => ".DS_Store");
        $filesList = $this->removeFieldsInData($filesList, $fieldsToRemove);
        $datas = [];
        foreach ($filesList as $file) {
            $fileContent = json_decode(file_get_contents($filesLocation . "/" . $file), true);
            $datas = array_merge($datas, $fileContent);
        }
        return $datas;
    }

    private function removeFieldsInData(array $data, array $fieldsToRemove)
    {
        foreach ($fieldsToRemove as $field) {
            unset($data[array_search($field, $data)]);
        }
        return $data;
    }
}

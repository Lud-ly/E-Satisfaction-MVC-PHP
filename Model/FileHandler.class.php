<?php

class FileHandler extends AbstractFileHandler
{

    private $directoryName;
    private $folderPath;
    private $filePathAndFile;

    public function __construct($directoryName)
    {
        parent::__construct();
        $this->directoryName = $directoryName;
        $this->folderPath = $this->baseLocationFolder . "/" . $this->directoryName;
    }

    public function create($fileName)
    {
        $filePathAndFile = $this->folderPath . "/" . $fileName;

        $this->filePathAndFile = $filePathAndFile;

        if (!is_file($filePathAndFile)) {
            touch($filePathAndFile);
        }
    }

    public function save($data)
    {
        $fileContent = json_decode(file_get_contents($this->filePathAndFile), true) ?? [];

        $fileContent = array_merge($fileContent, $data);

        file_put_contents($this->filePathAndFile, json_encode($fileContent));
    }
}

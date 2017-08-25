<?php

use \Phalcon\Mvc\Controller;

class GenerateController extends Controller {

    public function indexAction() {        
        $coreAction = new Core();
        User::clearTable();
        $this->view->mainTime = $coreAction->multiCoreRun();
        
    }

    public function generateAction() {
        $step = $this->dispatcher->getParam("step");
        $config = $this->config;
        $this->view->pick("generate/index");

        $fileGenerator = new FileGenerator($config->file->countFileRecord, $config->core->countCore);
        $path = $config->file->pathTmp .
                $config->file->fileName .
                $step .
                $config->file->csvExtent;
        
        
        $startGenetateFile = microtime(1);
        $fileGenerator->saveStringInFile($path, $step);
        $timeGenerateFile = microtime(1) - $startGenetateFile;
        $this->view->timeGenerateFile = round($timeGenerateFile, 3);

        $startCopyRecords = microtime(1);
        User::copyInFileToDB(['name', 'surname', 'age'], $path);
        $timeCopyRecords = microtime(1) - $startCopyRecords;
        $this->view->timeCopyRecords = round($timeCopyRecords, 3);
    }

}

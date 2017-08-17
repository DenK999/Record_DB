<?php

namespace Solveo\Controller;

/**
 * class IndexController 
 */
class IndexController extends \Solveo\Controller {

    /**
     *
     * @var array 
     */
    public $workTime = array();

    /**
     * function show index view
     */
    public function indexAction() {
        
        
//        $user = new \Solveo\Model\User();      
//        $user->fetch('50001 or true LIMIT 100');         
//        echo "Name - ".$user->name; 
        $this->view->generate('indexView.php', 'templateView.php');       
    }   

    /**
     * function to generate and copy data in DB
     * @param type $step
     */
    public function generateAction() {
        $requestArray = explode('/', $_SERVER['REQUEST_URI']);        
        $step = end($requestArray);  
        
        
        try {
            $file = new \Solveo\FileGenerator();  
            $user = new \Solveo\Model\User();

            $path = APP_DIR .
                    \Solveo\Config::get()->file->pathTmp .
                    \Solveo\Config::get()->file->fileName .
                     $step .
                    \Solveo\Config::get()->file->csvExtent;

            $timeStartgenerateFile = microtime(1);
            $file->saveStringInFile($path, $step);
            $timeAddFile = round(microtime(1) - $timeStartgenerateFile, 3);
            $this->workTime[$step]['generateFile'] = $timeAddFile;

            $timeStart = microtime(1);
            $user->copyInFileToDB('users', array('name', 'surname', 'age'), $path);
            $timeCopyToDB = microtime(1) - $timeStart;
            $this->workTime[$step]['copyToDB'] = round($timeCopyToDB, 3);
            $this->view->generate('mainView.php', 'templateView.php', $this->workTime);            
        } catch (Exception $e) {
            throw new PHPErrorException($e->getMessage(), 'Nie może zgenerować lub zapisać plik');
        }
    }

    /**
     * function to clear table to DB
     */
    public function clearTableAction() {
        $user = new \Solveo\Model\User();
        $user->clearTableUsers();
    }


    /**
     * function to start generate and write data
     */
    public function startAction() {
        $core = new \Solveo\Core();
        $this->clearTableAction();
        $this->workTime['main']['all'] = $core->multiCoreRun();        
        $this->view->generate('mainView.php', 'templateView.php', $this->workTime);
    }

}

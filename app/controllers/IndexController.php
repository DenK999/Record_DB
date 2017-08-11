<?php

namespace Solveo;

/**
 * class IndexController 
 */
class IndexController extends \Solveo\Controller {

    /**
     *
     * @var array 
     */
    public $data = array();

    /**
     * function show index view
     */
    public function indexAction() {
        $this->view->generate('indexView.php', 'templateView.php');       
    }

    /**
     * function to show data from DB
     */
    public function showAction() {
        $this->model = new \Solveo\Model\User();

        $data = $this->model->get(10);
        $this->view->generate('showView.php', 'templateView.php', $data);
    }

    /**
     * function to generate and copy data in DB
     * @param type $step
     */
    public function generateAction($step) {
        try {
            $file = new \Solveo\Controller\FileController();

            $config = include $_SERVER['DOCUMENT_ROOT'] . '/app/config/config.php';

            $path = $_SERVER['DOCUMENT_ROOT'] .
                    $config->file->pathTmp .
                    $config->file->fileName .
                    $step .
                    $config->file->csvExtent;

            $timeStartgenerateFile = microtime(1);
            $file->saveRowAction($path, $step);
            $timeAddFile = round(microtime(1) - $timeStartgenerateFile, 3);
            $this->data[$step]['generateFile'] = $timeAddFile;

            $timeStart = microtime(1);
            $this->model->copy('users', array('name', 'surname', 'age'), $path);
            $timeCopyToDB = microtime(1) - $timeStart;
            $this->data[$step]['copyToDB'] = round($timeCopyToDB, 3);           
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * function to clear table to DB
     */
    public function clearTableAction() {
        $this->model->clearTable('users');
    }

    /**
     * function to run action in one core
     */
    public function curlAction() {
        $step = intval($_GET["step"]);
        if ($step == 0) {
            $this->clearTableAction();
        } else {
            $this->generateAction($step);
        }
        $this->view->generate('mainView.php', 'templateView.php', $this->data);
    }

    /**
     * function to start generate and write data
     */
    public function startAction() {
        $core = new \Solveo\Controller\CoreController();
        $core->oneCurlRun();
        $this->data['main']['all'] = $core->MultiRun();
        $this->view->generate('mainView.php', 'templateView.php', $this->data);
    }

}

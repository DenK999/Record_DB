<?php

namespace Solveo;

class IndexController extends \Solveo\Controller {

//    public function indexAction()
//    {
//        $user = new User();
//        $user->fetch(10);
//        $user->parent_id = 10;
//        $user->save();
//    }


    public $data = array();

    public function indexAction() {
        $this->view->generate('mainView.php', 'templateView.php');
    }

    public function getrowAction() {
        $this->model = new \Solveo\Model\User();

        $data = $this->model->get(10);
        $this->view->generate('mainView.php', 'templateView.php', $data);
    }

    public function generateAction($step) {
        try {
            $file = new \Solveo\Controller\FileController();

            $config = include $_SERVER['DOCUMENT_ROOT'] . '/app/config/config.php';

            $path = $_SERVER['DOCUMENT_ROOT'] .
                    $config->file->path_tmp .
                    $config->file->file_name .
                    $step .
                    $config->file->csv_extent;


            $timeStartgenerateFile = microtime(1);
            $file->saveRowAction($path, $step);
            $timeAddFile = round(microtime(1) - $timeStartgenerateFile, 3);
            $this->data[$step]['generateFile'] = $timeAddFile;


            $timeStart = microtime(1);
            $this->model->copy('users', $path);
            $timeCopyToDB = microtime(1) - $timeStart;
            $this->data[$step]['copyToDB'] = round($timeCopyToDB, 3);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function clearTableAction() {
        $this->model->clearTable('users');
    }

    public function curlAction() {
        $step = intval($_GET["step"]);


        if ($step == 0) {
            $this->clearTableAction();
        } else {
            $this->generateAction($step);
        }

        $this->view->generate('mainView.php', 'templateView.php', $this->data);
    }

    public function startAction() {
        $core = new \Solveo\Controller\CoreController();

        $core->oneCurlRun();

        $core->MultiRun();
    }

}

<?php

namespace Solveo;

class PHPErrorException extends \Exception {

    /**
     *
     * @var string 
     */
    protected $errorMessage = "Coś poszło nie tak. Już poprawiamy ten błąd";    

    /**
     * register of error handlers
     */
    public function register() {
        set_error_handler([$this, 'handleError']);
        register_shutdown_function([$this, 'fatalHandleError']);
        set_exception_handler([$this, 'handleException']);
    }

    /**
     * 
     * @param type $errNumb
     * @param type $errorStr
     * @param type $errorFile
     * @param type $errorLine
     * @return boolean
     */
    public function handleError($errNumb, $errorStr, $errorFile, $errorLine) {       
        echo $this->errorMessage;
        $this->writeToLog($errNumb, $errorFile, $errorLine, $errorStr);
        return true;
    }

    /**
     * function handler of fatal error
     */
    public function fatalHandleError() {        
        if ($error = error_get_last()) {            
            $this->writeToLog($error['type'], $error['file'], $error['line'], $error['message']);
            echo $this->errorMessage;            
        }
    }
    
    /**
     * 
     * @param type $e
     * @return boolean
     */
    public function handleException($e){
        echo $e->getMessage();
        $this->writeToLog($e->getCode(), $e->getFile(), $e->getLine(), $e->getMessage());
        
        return true;
    }

    /**
     * function write errors to log file
     * @param type $errNumb
     * @param type $errorFile
     * @param type $errorLine
     * @param type $errorStr
     */
    protected function writeToLog($errNumb, $errorFile, $errorLine, $errorStr) {
        error_log(date("Y.m.d, g:i a") . "\n"
                . "ErrNumb: " . $errNumb . "\n"
                . "File: " . $errorFile . "\n"
                . "Line: " . $errorLine . "\n"
                . "Error: " . $errorStr . "\n", 3, Config::get()->site->defaultErroLog);
    }

}

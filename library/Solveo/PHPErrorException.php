<?php

namespace Solveo;

class PHPErrorException {

    private static $instance = null;

    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * register of error handlers
     */
    public function register() {
        set_error_handler([$this, 'handleError']);
        register_shutdown_function([$this, 'fatalHandleError']);        
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
        $this->writeToLog($errNumb, $errorFile, $errorLine, $errorStr);
        $this->showError();
    }

    /**
     * function handler of fatal error
     */
    public function fatalHandleError() { 
        if ($error = error_get_last()) {            
            $this->writeToLog($error['type'], $error['file'], $error['line'], $error['message']);          
            $this->showError();
        }
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
                . "Error: " . $errorStr . "\n\n", 3, Config::get()->site->pathErrorLog);
    }
    
    public function showError() {
        while (ob_get_level()-1) {
            ob_end_flush();
        }        
        ob_clean();
        
        include APP_DIR . '/app/views/errors/500.phtml';
        die(header("HTTP/1.0 500 internal server error"));
    }

}

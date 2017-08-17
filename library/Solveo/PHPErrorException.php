<?php

namespace Solveo;

class PHPErrorException extends \Exception {

    protected $error;
    protected $message;

    function __construct(string $error = '', string $message = '') {
        $this->error = $error;
        $this->message = $message;
        $this->initSystemHandlers();
    }

    public static function my_error_handler() {
        set_exception_handler(array($this, 'handleException'));
        //set_error_handler(array($this, 'handleError'), error_reporting());
    }

    protected function initSystemHandlers() {
        set_exception_handler(array($this, 'handleException'));
        set_error_handler(array($this, 'handleError'), error_reporting());
    }

    public function handleException($exception) {
        echo '<pre>';
        var_dump($this->error . "\r\n");
        error_log(date("Y.m.d, g:i a") . "\n" .
                $this->error .
                "\r\n", 3, Config::get()->site->test_error_log);
        echo $this->message;
    }

//    public function handleError($exception) {
//        echo '<pre>';
//        var_dump("handleError");
//        die;
//    }

}

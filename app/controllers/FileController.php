<?php

namespace Solveo\Controller;

class FileController {

    /**
     * @var string
     */
    public $stack = "";

    /**
     * random age
     * @var integer
     */
    public $age = 1;

    /**
     * random name
     * @var string
     */
    public $name = "";

    /**
     * [$surname random surname]
     * @var string
     */
    public $surname = "";

    /**
     * $alphabet alphabet for random string
     * @var string
     */
    public $alphabet = "abcdefghijklmnopqrstuvwxyz";

    /**
     * $start start value to random string
     * @var integer
     */
    public $start = 0;

    /**
     * $length lenght to random string
     * @var integer
     */
    public $length = 15;

    /**
     * $countRecords countRecords for add to one file
     * @var integer
     */
    public $countRecords = 12500;

    /**
     * function generate string for write to file
     * 
     * @param int $step
     * @return string
     */
    function randomDataAction(int $step) {
        try {
            for ($i = 0; $i < $this->countRecords; $i++) {
                $id = $i + $step * $this->countRecords;
                $this->age = rand(1, 99);
                $this->name = $this->randomStringAction();
                $this->surname = $this->randomStringAction();
                $this->stack .= "$this->name,$this->surname,$this->age" . "\n";
            }
        } catch (Exception $e) {
            echo($e->getMessage());
        }

        return $this->stack;
    }

    /**
     * 
     * @param string $filepath
     * @param int $step
     * @return float Time for work function
     */
    function saveRowAction(string $filepath, int $step) {
        if (file_exists($filepath) && $step != 0) {
            $file = fopen($filepath, 'w');
            fclose($file);
        }
        if ($step != 0) {
            $file = fopen($filepath, "a");
            fwrite($file, $this->randomDataAction($step));
            fclose($file);
        }
    }

    /**
     * function return random name or surname lenght = 15 symbols
     * @return string
     */
    function randomStringAction() {
        return substr(str_shuffle($this->alphabet), $this->start, $this->length);
    }

}

<?php

namespace Solveo;

class FileGenerator {

    /**
     *
     * @var type string
     */
    public $alphabet = "abcdefghijklmnopqrstuvwxyz";
    
    /**
     * 
     * @param string $filepath
     * @param int $step
     * @return float Time for work function
     */
    function saveStringInFile(string $filepath, int $step) {        
        if (file_exists($filepath) && $step != 0) {
            $file = fopen($filepath, 'w');
            fclose($file);
        }
        if ($step != 0) {
            $file = fopen($filepath, "a");
            fwrite($file, $this->generateRandomString($step));
            fclose($file);
        }
    }

    /**
     * function generate string for write to file
     * 
     * @param int $step
     * @return string
     */
    private function generateRandomString(int $step) {
        $countAllRecords = Config::get()->file->countFileRecord;
        $countCore = Config::get()->core->countCore;
        $countRecords = $countAllRecords / $countCore;
        $stack = "";

        for ($i = 0; $i < $countRecords; $i++) {
            $id = $i + $step * $countRecords;
            $age = rand(1, 99);
            $name = $this->getRandomString();
            $surname = $this->getRandomString();
            $stack .= "$name,$surname,$age\n";
        }


        return $stack;
    }

    /**
     * function return random name or surname lenght = 15 symbols
     * @return string
     */
    private function getRandomString(int $start = 0, int $length = 15) {
        return substr(str_shuffle($this->alphabet), $start, $length);
    }

}

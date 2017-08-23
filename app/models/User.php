<?php

namespace Solveo\Model;

use \Solveo\Db;

/**
 * class User
 */
class User extends \Solveo\Model {

    private $table = 'users';

    /**
     * @var int Id 
     */
    public $id;

    /**
     * @var int Parent id
     */
    public $parent_id;

    /**
     *
     * @var string Name 
     */
    public $name;

    /**
     *
     * @var string Surname 
     */
    public $surname;

    /**
     *
     * @var int Age 
     */
    public $age;

    /**
     *
     * @var int Level
     */
    public $level;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function fetch($id) {


        $res = DB::connect()->prepare('SELECT * FROM users WHERE id = :id');
        $res->bindValue(':id', $id, \PDO::PARAM_INT);
        $res->execute();

        if (!$res->execute()) {
            throw new \Solveo\PHPErrorException('Nie można pobrać takich danych');
        }

        foreach ($res as $row) {
            $this->name = $row['name'];
            $this->surname = $row['surname'];
            $this->age = $row['age'];
            $this->level = $row['level'];
            $this->parent_id = $row['parent_id'];
            return true;
        }

        return false;
    }

    /**
     * 
     * @param string $table
     * @param array $rows
     * @param string $filepath
     */
    public static function copyInFileToDB(string $table, array $rows, string $filepath) {       
        $rowString = implode(',', $rows);
        $copy = DB::connect()->prepare("COPY $table($rowString) FROM '" . $filepath . "' WITH DELIMITER ','");        
        $copy->execute();
    }

    /**
     * 
     * @param string $table
     */
    public static function clearTableUsers() {
        $clear = DB::connect()->prepare("TRUNCATE TABLE users");
        $clear->execute();
    }

}

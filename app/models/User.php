<?php

use \Phalcon\Mvc\Model;

class User extends Model {

    /**
     * Id for user
     * @var int 
     */
    public $id;

    /**
     * Name for user
     * @var string 
     */
    public $name;

    /**
     * Surname for user
     * @var string 
     */
    public $surname;

    /**
     * Age for user
     * @var int 
     */
    public $age;

    /**
     *
     * @var int 
     */
    public $level;

    /**
     *
     * @var int 
     */
    public $parent_id;

    /**
     * 
     */
    public function initialize() {
        $this->setSource("users");
    }

    /**
     * 
     */
    public static function clearTable() {
        $self = new self();
        $self->getDi()->getShared('db')->query("truncate table " . $self->getSource());
    }

    /**
     * 
     * @param string $table
     * @param array $rows
     * @param string $filepath
     */
    public static function copyInFileToDB(array $rows, string $filepath) {
        $self = new self();
        $table = $self->getSource();
        $rowString = implode(',', $rows);
        $self->getDi()->getShared('db')->query("COPY $table($rowString) FROM '" .
                $filepath . "' WITH DELIMITER ','");
    }

}
